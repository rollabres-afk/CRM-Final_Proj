<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\Interaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomerController extends Controller
{
    // Show create form
    public function create() {
        return view('customers.create');
    }

    // Store new customer with Duplicate Check
    public function store(Request $request) {
        // Business Rule: Check for duplicate email or phone
        $exists = Customer::where('email', $request->email)
                          ->orWhere('contact_number', $request->contact_number)
                          ->exists();

        if ($exists) {
            return back()->withInput()->withErrors(['error' => 'Duplicate Record: A customer with this email or phone number already exists.']);
        }

        // Create Customer
        $customer = Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'address' => $request->address,
            'status' => 'Active',
            'staff_id' => Auth::id() // Linked to responsible staff
        ]);

        // Create initial lead entry
        Lead::create([
            'customer_id' => $customer->customer_id,
            'lead_stage' => 'New',
            'last_updated' => Carbon::now()
        ]);

        return redirect('/dashboard')->with('success', 'Customer Created Successfully');
    }

    // View Profile
    public function show($id) {
        $customer = Customer::with(['lead', 'interactions.staff', 'staff'])->findOrFail($id);
        
        // Security check: Staff can only view own, Managers view all
        $user = Auth::user();
        if($user->roles == 'Staff' && $customer->staff_id != $user->staff_id) {
            abort(403, 'Unauthorized access to this record.');
        }

        return view('customers.show', compact('customer'));
    }

    // Log Interaction
    public function storeInteraction(Request $request, $id) {
        Interaction::create([
            'customer_id' => $id,
            'staff_id' => Auth::id(),
            'date_time' => Carbon::now(),
            'interaction_type' => $request->interaction_type,
            'notes' => $request->notes
        ]);

        return back()->with('success', 'Interaction Logged');
    }

    // Update Lead Status
    public function updateStatus(Request $request, $id) {
        $lead = Lead::where('customer_id', $id)->first();
        if($lead) {
            $lead->lead_stage = $request->lead_stage;
            $lead->last_updated = Carbon::now();
            $lead->save();
        }
        return back()->with('success', 'Lead Status Updated');
    }

    // Delete Customer Record
    public function destroy($id) {
        $customer = Customer::findOrFail($id);

        // Security check
        $user = Auth::user();
        if($user->roles == 'Staff' && $customer->staff_id != $user->staff_id) {
            abort(403, 'Unauthorized action.');
        }

        // Delete related records manually since we are not using database cascade
        Lead::where('customer_id', $id)->delete();
        Interaction::where('customer_id', $id)->delete();
        
        // Delete the customer
        $customer->delete();

        return redirect('/dashboard')->with('success', 'Customer record deleted successfully.');
    }
}
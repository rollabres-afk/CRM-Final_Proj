<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Interaction;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();

        if ($user->roles === 'Manager' || $user->roles === 'System Administrator') {
            // Manager View: See all customers
            $customers = Customer::with(['staff', 'lead'])->get();
            
            // FIX: Pinalitan ang latest() ng orderBy('date_time', 'desc')
            $interactions = Interaction::with(['customer', 'staff'])
                                       ->orderBy('date_time', 'desc')
                                       ->take(10)
                                       ->get();

            return view('dashboard_manager', compact('customers', 'interactions'));
        } else {
            // Staff View: See only their own customers
            $customers = Customer::where('staff_id', $user->staff_id)->with('lead')->get();
            return view('dashboard_staff', compact('customers'));
        }
    }
}
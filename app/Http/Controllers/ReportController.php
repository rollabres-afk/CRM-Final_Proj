<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Lead;
use App\Models\Interaction;

class ReportController extends Controller
{
    public function index() {
        // Security Check: Only Managers/Admins can view reports
        if (Auth::user()->roles !== 'Manager' && Auth::user()->roles !== 'System Administrator') {
            abort(403, 'Access Denied: Only Managers can view reports.');
        }

        // Query 1: Lead Status Distribution (Count of customers in each stage)
        $leadStats = Lead::select('lead_stage', DB::raw('count(*) as total'))
                         ->groupBy('lead_stage')
                         ->get();

        // Query 2: Staff Interaction Performance (Count of interactions per staff)
        $staffStats = Interaction::select('staff_id', DB::raw('count(*) as total'))
                                 ->groupBy('staff_id')
                                 ->with('staff') 
                                 ->get();

        return view('reports', compact('leadStats', 'staffStats'));
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Staff;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\Interaction;
use App\Models\ManagerAssignment;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Clear existing data to avoid duplicates
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Staff::truncate();
        Customer::truncate();
        Lead::truncate();
        Interaction::truncate();
        ManagerAssignment::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Create Specific Manager (Roselle)
        $manager = Staff::create([
            'first_name' => 'Roselle',
            'last_name' => 'Manager',
            'roles' => 'Manager',
            'email' => 'roselle@gym.com',
            'password' => Hash::make('roselle123'),
        ]);

        // 3. Create Specific Staff (Rusil)
        $staff = Staff::create([
            'first_name' => 'Rusil',
            'last_name' => 'Staff',
            'roles' => 'Staff',
            'email' => 'rusil@gym.com',
            'password' => Hash::make('rusil123'),
        ]);

        // Assign Rusil to Manager Roselle
        ManagerAssignment::create([
            'manager_id' => $manager->staff_id,
            'staff_id' => $staff->staff_id,
            'date_assign' => Carbon::now(),
        ]);

        // 4. Create Customers, Leads, and Interactions for Rusil
        $leadStages = ['New', 'Contacted', 'Qualified', 'Converted'];
        $interactionTypes = ['Call', 'Email', 'Meeting', 'Walk-in'];

        // Create 5 customers for Rusil
        for ($j = 1; $j <= 5; $j++) {
            
            // Business Rule: Each customer linked to responsible staff
            $customer = Customer::create([
                'first_name' => 'Customer',
                'last_name' => 'Dela Cruz ' . $j,
                'contact_number' => '0917123456' . $j,
                'email' => "client{$j}@mail.com",
                'address' => 'Quezon City, Philippines',
                'status' => 'Active',
                'staff_id' => $staff->staff_id,
            ]);

            // Business Rule: Historical lead data remaining in system
            $currentStage = $leadStages[array_rand($leadStages)];
            Lead::create([
                'customer_id' => $customer->customer_id,
                'lead_stage' => $currentStage,
                'last_updated' => Carbon::now(),
            ]);

            // Business Rule: Interactions tracked
            Interaction::create([
                'customer_id' => $customer->customer_id,
                'staff_id' => $staff->staff_id,
                'date_time' => Carbon::now()->subDays(rand(1, 10)),
                'interaction_type' => $interactionTypes[array_rand($interactionTypes)],
                'notes' => 'Inquired about membership promo.',
            ]);
        }
    }
}
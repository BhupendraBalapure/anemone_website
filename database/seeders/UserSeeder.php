<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 👑 1. Super Admin User
        User::updateOrCreate(
            ['email' => 'admin@anemony.in'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'),
                'role' => 'super_admin',
                'phone' => '+91 95792 14456',
                'is_active' => true,
            ]
        );

        // 🏪 2. Demo Merchant - Sharma Kirana
        $sharma = Tenant::where('slug', 'sharma-kirana')->first();
        if ($sharma) {
            User::updateOrCreate(
                ['email' => 'sharma@anemony.in'],
                [
                    'name' => 'Rajesh Sharma',
                    'password' => Hash::make('password'),
                    'role' => 'merchant',
                    'tenant_id' => $sharma->id,
                    'phone' => '+91 98765 43210',
                    'is_active' => true,
                ]
            );
        }

        // 🏥 3. Demo Merchant - Care Dental
        $dental = Tenant::where('slug', 'care-dental-clinic')->first();
        if ($dental) {
            User::updateOrCreate(
                ['email' => 'care@anemony.in'],
                [
                    'name' => 'Dr. Priya Sharma',
                    'password' => Hash::make('password'),
                    'role' => 'merchant',
                    'tenant_id' => $dental->id,
                    'phone' => '+91 91234 56789',
                    'is_active' => true,
                ]
            );
        }
    }
}

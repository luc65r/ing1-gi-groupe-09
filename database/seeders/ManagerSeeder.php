<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('manager.manager_name')) {
            $user = User::factory()->create([
                'name' => config('manager.manager_name'),
                'email' => config('manager.manager_email'),
                'telephone' => config('manager.manager_telephone'),
                'password' => Hash::make(config('manager.manager_password')),
            ]);
            $user->manager()->create([
                'company' => config('manager.manager_company'),
                'activation_start' => config('manager.manager_start'),
                'activation_end' => config('manager.manager_end'),
            ]);
        }
    }
}

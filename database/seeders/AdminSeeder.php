<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('admin.admin_name')) {
            $user = User::factory()->create([
                'name' => config('admin.admin_name'),
                'email' => config('admin.admin_email'),
                'telephone' => config('admin.admin_telephone'),
                'password' => Hash::make(config('admin.admin_password')),
            ]);
            $user->admin()->create();
        }
    }
}

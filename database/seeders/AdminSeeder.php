<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'super@super.com')->first();
        if ($user) {
            $user->password = Hash::make('khalifah@19912');
        } else {
            $user = new User();
            $user->name = 'super';
            $user->email = 'super@super.com';
            $user->password = Hash::make('khalifah@19912');
            $user->email_verified_at = now();
        }
        $user->save();
    }
}

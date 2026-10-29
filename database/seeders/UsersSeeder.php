<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'Admin@level.com',
            'password' => bcrypt('admin2020'),
            'level' => 'admin'
        ]);

        $officer = User::create([
            'name' => 'Taqim',
            'username' => 'taqim',
            'email' => 'Taqim@gmail.com',
            'password' => bcrypt('officer2020'),
            'level' => 'officer'
        ]);
        
        $user = User::create([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@level.com',
            'password' => bcrypt('user2020'),
            'level' => 'bidder'
        ]);

        // Assuming biddings id 1 exists, add a sample bid
        DB::table('auction_history')->insert([
            'id_bids' => 1,
            'id_user' => $user->id,
            'bid' => 100000,
            'auction_status' => 'delayed',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    
}

<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // Create admin user.
        User::create([
            'name' => 'Admin',
            'email' => 'admin@my.app',
            'type' => 'admin',
            'password' => bcrypt('admin'),
            'email_verified_at' => \Carbon\Carbon::now()->format('Y-m-d h:i:s')
        ]);
        $this->command->info('Admin user created');

        // $this->call(UsersTableSeeder::class);
    }

}

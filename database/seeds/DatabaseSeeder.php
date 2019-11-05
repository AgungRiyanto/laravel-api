<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        App\Project::unguard();
        App\Project::truncate();
        factory(App\Project::class)->create();
        App\Project::reguard();
    }
}

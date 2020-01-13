<?php

use Illuminate\Database\Seeder;
use \App\User;
use \Spatie\Permission\Models\Permission;
use \Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the users table first
        User::truncate();

        $faker = \Faker\Factory::create();

        // Let's make sure everyone has the same password and
        // let's hash it before the loop, or else our seeder
        // will be too slow.
        $password = \Illuminate\Support\Facades\Hash::make('123456');

        $user = User::create([
            'firstName' => 'Administrator',
            'lastName' => '',
            'email' => 'admin@test.com',
            'password' => $password,
        ]);
        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'firstName' => $faker->firstName(),
                'lastName' => $faker->lastName,
                'email' => $faker->email,
                'password' => $password,
            ]);
        }
    }
}

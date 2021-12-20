<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newUser = new User([
            'name'=>"Admin",
            'email'=>"admin@admin.com",
            'password'=> Hash::make('q2Wz3D1337El33Tfff')

        ]);
        $newUser->save();
    }
}

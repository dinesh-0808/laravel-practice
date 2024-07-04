<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // DB::table("users")->insert([
        //     'name' => Str::random(10),
        //     'email'=> Str::random(10)."@one.com",
        //     "password"=> bcrypt("password"),
        // ]);

        User::factory(10)->create();
    }
}

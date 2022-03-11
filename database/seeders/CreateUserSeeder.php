<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->TruncateUserTable();
        User::create([
            'name'=>'Admin',
            'email'=>'admin@app.com',
            'password'=>Hash::make('password'),
        ]);
    }

    public function TruncateUserTable(){
        // this function truncate users table
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
    }
}

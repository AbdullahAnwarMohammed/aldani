<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Admin = Admin::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'showpassword' => '123456',
            'gender' => 1,
            'male_or_female' => [0,1],

        ]);

        $role = Role::create(['name' => 'owner','guard_name' => 'admin']);
   
        $permissions = Permission::pluck('id')->all();
  
        $role->syncPermissions($permissions);
   
         $Admin->assignRole([$role->id]);
    }
}

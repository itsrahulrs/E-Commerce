<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $roleAdmin = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $roleAdmin->syncPermissions($permissions);
        $user->assignRole([$roleAdmin->name]);

        $roleEmployee = Role::create(['name' => 'Employee']);
        $roleEmployee->syncPermissions([
            'products.index','products.create','products.store','products.show','logout','sanctum.csrf-cookie','password.request','password.email','password.reset','password.update','password.confirm'
        ]);

        $roleCustomer = Role::create(['name' => 'Customer']);
        $roleCustomer->syncPermissions([
            'products.index','products.show','cart','addToCart','updateCart','removeFromCart','checkout','placeOrder','myOrders','order.show','logout','sanctum.csrf-cookie','password.request','password.email','password.reset','password.update','password.confirm'
        ]);
    }
}

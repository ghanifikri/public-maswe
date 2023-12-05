<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authorities = config('permission.authorities'); 

        $listPermission = [];
        $superAdminPermissions = [];
        $adminPermissions = [];

        foreach($authorities as $label => $permissions){
            foreach ($permissions as $permission) {
                $listPermission[] =[
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
    
                ];
                //superAdmin
                $superAdminPermissions[] = $permission;
                //admin
                if (in_array($label,['menage_orders','menage_homePage','menage_aboutPage','menage_productPage','menage_galleryPage','menage_messagePage'])) {
                    $adminPermissions[] = $permission;
                }
            }
           
        }

        Permission::insert($listPermission);

        //insert roles
        //superAdmin
        $superAdmin = Role::create([
            'name' => 'SuperAdmin',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //admin
        $admin = Role::create([
            'name' => 'Admin',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $superAdmin->givePermissionTo($superAdminPermissions);
        $admin->givePermissionTo($adminPermissions);

        $userSuperAdmin = User::find(1)->assignRole("SuperAdmin");
    }
}

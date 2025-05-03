<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolesToCreate = ['super-admin', 'admin','user'];

        foreach ($rolesToCreate as $roleName) {
            Role::create(['name' => $roleName]);
        }

        $permissionsAndGroups = [
            'Member' => ['member.view', 'member.add', 'member.update', 'member.delete'],
            'Donation' => ['donation.view', 'donation.add', 'donation.update', 'donation.delete'],
            'NationalDay' => ['nationalday.view', 'nationalday.add', 'nationalday.update', 'nationalday.delete'],
            'Gallery' => ['gallery.view', 'gallery.add', 'gallery.update', 'gallery.delete'],
            'Activities' => ['activities.view', 'activities.add', 'activities.update', 'activities.delete'],
            'settings' => ['settings.view', 'settings.update'],
            
        ];
    
        foreach ($permissionsAndGroups as $groupName => $permissions) {
            foreach ($permissions as $permissionName) {
                Permission::create(['name' => $permissionName, 'group_name' => $groupName]);
            }
        }
    }
}

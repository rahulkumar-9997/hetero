<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [

            [
                'group' => 'Dashboard',
                'permissions' => [
                    'view dashboard',
                    'view daily visitors',
                ]
            ],

            [
                'group' => 'User Management',
                'permissions' => [
                    'view users',
                    'create users',
                    'edit users',
                    'delete users',
                    'change user password',
                    'update user status',
                ]
            ],

            [
                'group' => 'Role Management',
                'permissions' => [
                    'view roles',
                    'create roles',
                    'edit roles',
                    'delete roles',
                ]
            ],

            [
                'group' => 'Permission Management',
                'permissions' => [
                    'view permissions',
                    'create permissions',
                    'edit permissions',
                    'delete permissions',
                ]
            ],

            [
                'group' => 'Profile Management',
                'permissions' => [
                    'view profile',
                    'update profile',
                    'delete profile image',
                ]
            ],

            [
                'group' => 'Banner Management',
                'permissions' => [
                    'view banners',
                    'create banners',
                    'edit banners',
                    'delete banners',
                ]
            ],

            [
                'group' => 'Year Management',
                'permissions' => [
                    'view years',
                    'create years',
                    'edit years',
                    'delete years',
                ]
            ],

            [
                'group' => 'Award Category Management',
                'permissions' => [
                    'view award categories',
                    'create award categories',
                    'edit award categories',
                    'delete award categories',
                ]
            ],

            [
                'group' => 'Award Management',
                'permissions' => [
                    'view awards',
                    'create awards',
                    'edit awards',
                    'delete awards',
                ]
            ],

            [
                'group' => 'News Media Category',
                'permissions' => [
                    'view news media categories',
                    'create news media categories',
                    'edit news media categories',
                    'delete news media categories',
                ]
            ],

            [
                'group' => 'News Media Management',
                'permissions' => [
                    'view news media',
                    'create news media',
                    'edit news media',
                    'delete news media',
                    'update news room',
                    'delete news room',
                ]
            ],

            [
                'group' => 'Medicine Category',
                'permissions' => [
                    'view medicine categories',
                    'create medicine categories',
                    'edit medicine categories',
                    'delete medicine categories',
                ]
            ],

            [
                'group' => 'Medicine Management',
                'permissions' => [
                    'view medicines',
                    'create medicines',
                    'edit medicines',
                    'delete medicines',
                ]
            ],

            [
                'group' => 'Cache Management',
                'permissions' => [
                    'clear cache',
                ]
            ],

            [
                'group' => 'Page Management',
                'permissions' => [
                    'view pages',
                    'create pages',
                    'edit pages',
                    'delete pages',
                ]
            ],

            [
                'group' => 'Menu Management',
                'permissions' => [
                    'view menus',
                    'create menus',
                    'edit menus',
                    'delete menus',
                    'view menu items',
                    'create menu items',
                    'edit menu items',
                    'delete menu items',
                    'order menu items',
                ]
            ],

            [
                'group' => 'CKEditor Management',
                'permissions' => [
                    'upload ckeditor images',
                    'view ckeditor images',
                ]
            ],

        ];

        $allPermissions = [];
        foreach ($permissions as $groupData) {
            foreach ($groupData['permissions'] as $perm) {
                $permission = Permission::firstOrCreate(
                    [
                        'name' => $perm,
                        'guard_name' => 'web',
                    ],
                    [
                        'group' => $groupData['group'],
                    ]
                );

                // if group was empty earlier
                if (empty($permission->group)) {
                    $permission->group = $groupData['group'];
                    $permission->save();
                }

                $allPermissions[] = $permission;
            }
        }

        // Roles

        $adminRole = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $adminRole->syncPermissions($allPermissions);

        $editorRole = Role::firstOrCreate([
            'name' => 'Editor',
            'guard_name' => 'web',
        ]);

        $editorRole->syncPermissions([
            'view dashboard',

            'view profile',
            'update profile',

            'view banners',
            'create banners',
            'edit banners',

            'view news media',
            'create news media',
            'edit news media',

            'view pages',
            'edit pages',
        ]);

        $viewerRole = Role::firstOrCreate([
            'name' => 'Viewer',
            'guard_name' => 'web',
        ]);

        $viewerRole->syncPermissions([
            'view dashboard',
            'view profile',
            'view banners',
            'view news media',
            'view pages',
        ]);
    }
}

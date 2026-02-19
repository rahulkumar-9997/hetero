<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();        
        $permissions = [
            'dashboard',
            'users' => [
                'users.list',
                'users.create',
                'users.edit',
                'users.delete',
                'users.change-password',
                'users.update-status',
            ],
            'roles' => [
                'roles.list',
                'roles.create',
                'roles.edit',
                'roles.delete',
            ],
            'permissions' => [
                'permissions.list',
                'permissions.create',
                'permissions.edit',
                'permissions.delete',
            ],
            'profile' => [
                'profile.view',
                'profile.edit',
                'profile.delete-image',
            ],
            'dashboard-module' => [
                'dashboard.view',
                'dashboard.daily-visitors',
            ],
            'manage-banner' => [
                'manage-banner.list',
                'manage-banner.create',
                'manage-banner.edit',
                'manage-banner.delete',
            ],
            'manage-year' => [
                'manage-year.list',
                'manage-year.create',
                'manage-year.edit',
                'manage-year.delete',
            ],
            'manage-award-category' => [
                'manage-award-category.list',
                'manage-award-category.create',
                'manage-award-category.edit',
                'manage-award-category.delete',
            ],
            'manage-awards' => [
                'manage-awards.list',
                'manage-awards.create',
                'manage-awards.edit',
                'manage-awards.delete',
            ],
            'manage-news-media-category' => [
                'manage-news-media-category.list',
                'manage-news-media-category.create',
                'manage-news-media-category.edit',
                'manage-news-media-category.delete',
            ],
            'manage-news-media' => [
                'manage-news-media.list',
                'manage-news-media.create',
                'manage-news-media.edit',
                'manage-news-media.delete',
                'news-room.update',
                'news-room.delete',
            ],
            'medicine-category' => [
                'medicine-category.list',
                'medicine-category.create',
                'medicine-category.edit',
                'medicine-category.delete',
            ],
            'manage-medicine' => [
                'manage-medicine.list',
                'manage-medicine.create',
                'manage-medicine.edit',
                'manage-medicine.delete',
            ],
            'cache' => [
                'cache.clear',
            ],
            'pages' => [
                'pages.list',
                'pages.create',
                'pages.edit',
                'pages.delete',
            ],
            'menus' => [
                'menus.list',
                'menus.create',
                'menus.edit',
                'menus.delete',
                'menus.items.view',
                'menus.items.create',
                'menus.items.edit',
                'menus.items.delete',
                'menus.items.order',
            ],
            'ckeditor' => [
                'ckeditor.upload',
                'ckeditor.image-list',
            ],
            'frontend' => [
                'frontend.home',
                'frontend.news',
                'frontend.medicine',
                'frontend.contact',
                'sitemap.view',
            ],
        ];

        // Create all permissions
        foreach ($permissions as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $permission) {
                    Permission::firstOrCreate([
                        'name' => $permission,
                        'guard_name' => 'web'
                    ]);
                }
            } else {
                Permission::firstOrCreate([
                    'name' => $value,
                    'guard_name' => 'web'
                ]);
            }
        }        
        $allPermissions = Permission::pluck('name')->toArray();
        $userPermissions = Permission::whereIn('name', [
            'users.list', 'users.create', 'users.edit', 'users.delete', 
            'users.change-password', 'users.update-status'
        ])->pluck('name')->toArray();
        
        $rolePermissions = Permission::whereIn('name', [
            'roles.list', 'roles.create', 'roles.edit', 'roles.delete'
        ])->pluck('name')->toArray();
        
        $permissionManagePermissions = Permission::whereIn('name', [
            'permissions.list', 'permissions.create', 'permissions.edit', 'permissions.delete'
        ])->pluck('name')->toArray();
        
        $bannerPermissions = Permission::whereIn('name', [
            'manage-banner.list', 'manage-banner.create', 'manage-banner.edit', 'manage-banner.delete'
        ])->pluck('name')->toArray();
        
        $yearPermissions = Permission::whereIn('name', [
            'manage-year.list', 'manage-year.create', 'manage-year.edit', 'manage-year.delete'
        ])->pluck('name')->toArray();
        
        $awardCategoryPermissions = Permission::whereIn('name', [
            'manage-award-category.list', 'manage-award-category.create', 
            'manage-award-category.edit', 'manage-award-category.delete'
        ])->pluck('name')->toArray();
        
        $awardPermissions = Permission::whereIn('name', [
            'manage-awards.list', 'manage-awards.create', 'manage-awards.edit', 'manage-awards.delete'
        ])->pluck('name')->toArray();
        
        $newsCategoryPermissions = Permission::whereIn('name', [
            'manage-news-media-category.list', 'manage-news-media-category.create',
            'manage-news-media-category.edit', 'manage-news-media-category.delete'
        ])->pluck('name')->toArray();
        
        $newsPermissions = Permission::whereIn('name', [
            'manage-news-media.list', 'manage-news-media.create', 'manage-news-media.edit',
            'manage-news-media.delete', 'news-room.update', 'news-room.delete'
        ])->pluck('name')->toArray();
        
        $medicineCategoryPermissions = Permission::whereIn('name', [
            'medicine-category.list', 'medicine-category.create', 
            'medicine-category.edit', 'medicine-category.delete'
        ])->pluck('name')->toArray();
        
        $medicinePermissions = Permission::whereIn('name', [
            'manage-medicine.list', 'manage-medicine.create', 
            'manage-medicine.edit', 'manage-medicine.delete'
        ])->pluck('name')->toArray();
        
        $pagePermissions = Permission::whereIn('name', [
            'pages.list', 'pages.create', 'pages.edit', 'pages.delete'
        ])->pluck('name')->toArray();
        
        $menuPermissions = Permission::whereIn('name', [
            'menus.list', 'menus.create', 'menus.edit', 'menus.delete',
            'menus.items.view', 'menus.items.create', 'menus.items.edit',
            'menus.items.delete', 'menus.items.order'
        ])->pluck('name')->toArray();
        
        $ckeditorPermissions = Permission::whereIn('name', [
            'ckeditor.upload', 'ckeditor.image-list'
        ])->pluck('name')->toArray();
        
        $frontendPermissions = Permission::whereIn('name', [
            'frontend.home', 'frontend.news', 'frontend.medicine',
            'frontend.contact', 'sitemap.view'
        ])->pluck('name')->toArray();
        
        $viewPermissions = [
            'dashboard',
            'profile.view',
            'dashboard.view',
            'dashboard.daily-visitors',
            'cache.clear',
        ];
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        $adminRole->syncPermissions($allPermissions);
        $editorRole = Role::firstOrCreate([
            'name' => 'editor',
            'guard_name' => 'web'
        ]);
        
        $editorRole->syncPermissions(array_merge(
            $bannerPermissions,
            $yearPermissions,
            $awardCategoryPermissions,
            $awardPermissions,
            $newsCategoryPermissions,
            $newsPermissions,
            $medicineCategoryPermissions,
            $medicinePermissions,
            $pagePermissions,
            $menuPermissions,
            $ckeditorPermissions,
            $frontendPermissions,
            ['dashboard', 'dashboard.view', 'dashboard.daily-visitors', 'profile.view', 'profile.edit', 'profile.delete-image']
        ));
        $viewerRole = Role::firstOrCreate([
            'name' => 'viewer',
            'guard_name' => 'web'
        ]);
        
        $viewerRole->syncPermissions(array_merge(
            ['dashboard', 'dashboard.view', 'dashboard.daily-visitors', 'profile.view'],
            ['users.list', 'roles.list', 'permissions.list'],
            ['manage-banner.list', 'manage-year.list', 'manage-award-category.list', 'manage-awards.list'],
            ['manage-news-media-category.list', 'manage-news-media.list'],
            ['medicine-category.list', 'manage-medicine.list'],
            ['pages.list', 'menus.list', 'menus.items.view'],
            ['ckeditor.image-list'],
            $frontendPermissions
        ));
        $adminUser = User::where('email', 'admin@admin.com')->first();
        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Super Admin',
                'user_id' => 'ADMIN' . time(),
                'email' => 'admin@admin.com',
                'phone_number' => '1234567890',
                'password' => Hash::make('password'),
                'profile_img' => null,
                'status' => '1',
            ]);
        }
        $adminUser->syncRoles(['admin']);
        $editorUser = User::where('email', 'editor@example.com')->first();
        if (!$editorUser) {
            $editorUser = User::create([
                'name' => 'Content Editor',
                'user_id' => 'EDITOR' . time(),
                'email' => 'editor@example.com',
                'phone_number' => '1234567891',
                'password' => Hash::make('password'),
                'profile_img' => null,
                'status' => '1',
            ]);
        }
        $editorUser->syncRoles(['editor']);
        $viewerUser = User::where('email', 'viewer@example.com')->first();
        if (!$viewerUser) {
            $viewerUser = User::create([
                'name' => 'Regular Viewer',
                'user_id' => 'VIEWER' . time(),
                'email' => 'viewer@example.com',
                'phone_number' => '1234567892',
                'password' => Hash::make('password'),
                'profile_img' => null,
                'status' => '1',
            ]);
        }
        $viewerUser->syncRoles(['viewer']);

        $this->command->info('=================================');
        $this->command->info('✅ Permissions Seeded Successfully!');
        $this->command->info('=================================');
        $this->command->info('📧 Admin Email: admin@admin.com');
        $this->command->info('🔑 Admin Password: password');
        $this->command->info('📧 Editor Email: editor@example.com');
        $this->command->info('🔑 Editor Password: password');
        $this->command->info('📧 Viewer Email: viewer@example.com');
        $this->command->info('🔑 Viewer Password: password');
        $this->command->info('=================================');
    }
}

<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile')->unique();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // OOOOOOOOOOOOOOOO============---------------============OOOOOOOOOOOOOOOO
        // OOOOOOOOOOOOOOOO============---------------============OOOOOOOOOOOOOOOO
        // OOOOOOOOOOOOOOOO============---------------============OOOOOOOOOOOOOOOO
        // OOOOOOOOOOOOOOOO============---------------============OOOOOOOOOOOOOOOO

        // Create super admin
        $user = User::create([
            'name' => 'admin',
            'mobile' => '09924533026',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);
        $testUser = User::create([
            'name' => 'admin2',
            'mobile' => '0992453302',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);

        $superAdmin = Role::create([
            'name' => 'Super Admin',
            'label' => 'فوق ادمین'
        ]);
        $user->assignRole($superAdmin);
        
        $admin = Role::create([
            'name' => 'Admin',
            'label' => 'ادمین'
        ]);
        $testUser->assignRole($admin);

        $doctor = Role::create([
            'name' => 'Doctor',
            'label' => 'دکتر'
        ]);

        // Create permissions for user`s page
        $viewUser = Permission::create([
            'name' => 'view user',
            'label' => 'بازدید کاربران',
        ]);
        $admin->givePermissionTo($viewUser);

        $createUser = Permission::create([
            'name' => 'create user',
            'label' => 'ساخت کاربر',
        ]);
        $admin->givePermissionTo($createUser);

        $updateUser = Permission::create([
            'name' => 'update user',
            'label' => 'ویرایش کاربر',
        ]);
        $admin->givePermissionTo($updateUser)
        ;
        $deleteUser = Permission::create([
            'name' => 'delete user',
            'label' => 'حذف کاربر',
        ]); 
        $admin->givePermissionTo($deleteUser);


        // OOOOOOOOOOOOOOOO============---------------============OOOOOOOOOOOOOOOO
        // OOOOOOOOOOOOOOOO============---------------============OOOOOOOOOOOOOOOO
        // OOOOOOOOOOOOOOOO============---------------============OOOOOOOOOOOOOOOO
        // OOOOOOOOOOOOOOOO============---------------============OOOOOOOOOOOOOOOO
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

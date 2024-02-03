<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    use \App\Traits\HasPermission;


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

        // Create roles
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

        $roles = [
            'Super Admin' => 'مدیر ارشد',
            'Admin' => 'مدیر',
            'Doctor' => 'دکتر',
        ];

        foreach ($roles as $name => $label) {
            $role = new Role();
            $role->label = $label;
            $role->name = $name;
            $role->save();
        }

        $user->assignRole('Super Admin');

        // Create permissions for users
        $permissions = [
            'view users' => 'نمایش کاربران',
            'create users' => 'ایجاد کاربران',
            'edit users' => 'ویرایش کاربران',
            'delete users' => 'حذف کاربران',
        ];

        $permissionNames = $this->createPermissions($permissions);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

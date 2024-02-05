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
            $table->string('mobile', 20)->unique();
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
            if($name = 'Admin') {
                $admin = $role;
            }
        }

        $user->assignRole('Super Admin');
        $testUser->assignRole('Admin');

        // Create permissions for users
        $permissions = [
            'view users' => 'نمایش کاربران',
            'create users' => 'ایجاد کاربران',
            'edit users' => 'ویرایش کاربران',
            'delete users' => 'حذف کاربران',

            'view doctors' => 'نمایش دکتر ها',
            'create doctors' => 'ایجاد دکتر ها',
            'edit doctors' => 'ویرایش دکتر ها',
            'delete doctors' => 'حذف دکتر ها',
            
            'view doctor_roles' => 'نمایش نقش دکتر ها',
            'create doctor_roles' => 'ایجاد نقش دکتر ها',
            'edit doctor_roles' => 'ویرایش نقش دکتر ها',
            'delete doctor_roles' => 'حذف نقش دکتر ها',

            'view specialities' => 'نمایش تخصص ها',
            'create specialities' => 'ایجاد تخصص ها',
            'edit specialities' => 'ویرایش تخصص ها',
            'delete specialities' => 'حذف تخصص ها',
            
            'view operations' => 'نمایش عمل ها',
            'create operations' => 'ایجاد عمل ها',
            'edit operations' => 'ویرایش عمل ها',
            'delete operations' => 'حذف عمل ها',
            
            'view insurances' => 'نمایش بیمه ها',
            'create insurances' => 'ایجاد بیمه ها',
            'edit insurances' => 'ویرایش بیمه ها',
            'delete insurances' => 'حذف بیمه ها',
            
        ];

        $permissionNames = $this->createPermissions($permissions);
        $rolePermissions = $this->assignPermissions($permissions, 'Admin');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

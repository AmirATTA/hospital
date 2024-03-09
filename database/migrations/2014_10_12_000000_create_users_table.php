<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            'name' => 'مدیر',
            'mobile' => '09924533026',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);

        $roles = [
            'Super Admin' => 'مدیر ارشد',
            'Admin' => 'مدیر',
            'Doctor' => 'دکتر',
            'Perms' => 'مجوز ها',
        ];

        foreach ($roles as $name => $label) {
            $role = new Role();
            $role->label = $label;
            $role->name = $name;
            $role->save();
            if($name = 'Perms') {
                $admin = $role;
            }
        }

        $user->assignRole('Super Admin');

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
            
            'view doctor-roles' => 'نمایش نقش دکتر ها',
            'create doctor-roles' => 'ایجاد نقش دکتر ها',
            'edit doctor-roles' => 'ویرایش نقش دکتر ها',
            'delete doctor-roles' => 'حذف نقش دکتر ها',

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
            
            'view surguries' => 'نمایش عمل جراحی ها',
            'create surguries' => 'ایجاد عمل جراحی ها',
            'edit surguries' => 'ویرایش عمل جراحی ها',
            'delete surguries' => 'حذف عمل جراحی ها',

            'view doctor-surgeries' => 'نمایش پرداخت پزشک ها',
            'create doctor-surgeries' => 'ایجاد پرداخت پزشک ها',
            'edit doctor-surgeries' => 'ویرایش پرداخت پزشک ها',
            'delete doctor-surgeries' => 'حذف پرداخت پزشک ها',

            'view payments' => 'نمایش پرداختي ها',
            'create payments' => 'ایجاد پرداختي ها',
            'edit payments' => 'ویرایش پرداختي ها',
            'delete payments' => 'حذف پرداختي ها',
            
            'view activity-logs' => 'نمایش گزارش فعالیت ها',
            'delete activity-logs' => 'حذف گزارش فعالیت ها',
                        
            'view settings' => 'نمایش تنظیمات ها',
            'delete settings' => 'حذف تنظیمات ها',
                        
            'view invoices' => 'نمایش صورت حساب ها',
            'edit doctor-surgeries' => 'ویرایش صورت حساب ها',
            'delete invoices' => 'حذف صورت حساب ها',

            'view notifications' => 'نمایش اعلانات ها',
        ];

        $permissionNames = $this->createPermissions($permissions);
        $rolePermissions = $this->assignPermissions($permissions, 'Perms');

        Activity::truncate();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

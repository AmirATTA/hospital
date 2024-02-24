<?php

namespace App\Http\Controllers\admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SettingUpdateRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::all();
        return view('admin.setting.index')->with([
            'setting' => $setting
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $group)
    {
        $settingTypes = Setting::query()->where('group', $group)->get()->groupBy('type');
        if($group == 'general') {
            $title = 'عمومی';
        } else {
            $title = 'مجازی';
        }
        return view('admin.setting.edit')->with([
            'settingTypes' => $settingTypes,
            'title' => $title
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $inputs = $request->except(['_token', '_method']);
        foreach ($inputs as $name => $value) {
            if ($setting = Setting::Where('name', $name)->first()) {
                if ($request->file($name)) {
                    $image = $request->file($name);
                    if($setting->value){
                        Storage::delete($setting->value);
                    }
                    
                    $path = $image->store('public/setting');
                    $value = basename($path);
                }
                $setting->update(['value' => $value]);
            }
        }

        return redirect()->route('settings.index')->with('success', 'تنظیمات با موفقیت بروزرسانی شد');
    }
}
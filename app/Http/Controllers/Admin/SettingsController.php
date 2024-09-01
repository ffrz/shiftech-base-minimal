<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AclResource;
use App\Models\Setting;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function __construct()
    {
        ensure_user_can_access(AclResource::SETTINGS);
    }
    
    public function edit(Request $request)
    {
        return view('admin.settings.edit');
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required'
        ], [
            'company_name.required' => 'Nama Perusahaan harus diisi.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $oldValues = Setting::values();

        DB::beginTransaction();

        // app
        Setting::setValue('company.name', $request->post('company_name', ''));
        Setting::setValue('company.address', $request->post('company_address', ''));
        Setting::setValue('company.phone', $request->post('company_phone', ''));
        DB::commit();

        $data = [
            'Old Value' => $oldValues,
            'New Value' => Setting::values(),
        ];

        UserActivity::log(UserActivity::SETTINGS, 'Change Settings', 'Pengaturan telah diperbarui.', $data);

        return redirect('admin/settings')->with('info', 'Pengaturan telah disimpan.');
    }
}

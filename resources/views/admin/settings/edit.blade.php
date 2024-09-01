<?php use App\Models\Setting; ?>

@extends('admin._layouts.default', [
    'title' => 'Pengaturan',
    'menu_active' => 'system',
    'nav_active' => 'settings',
])
@section('content')
  <form method="POST" action="{{ url('admin/settings/save') }}">
    @csrf
    <div class="card card-light">
      <div class="card-header" style="padding:0;border-bottom:0;">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="company-profile-tab" data-toggle="tab" href="#company-profile" role="tab"
              aria-controls="company-profile" aria-selected="false">Profil Perusahaan</a>
          </li>
        </ul>
      </div>
      <div class="tab-content card-body" id="myTabContent">
        <div class="tab-pane fade show active" id="company-profile" role="tabpanel" aria-labelledby="company-profile-tab">
          <div class="form-horizontal">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="company_name">Nama Perusahaan</label>
                <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name"
                  placeholder="Nama Usaha" name="company_name"
                  value="{{ Setting::value('company.name', 'Madrasah...') }}">
                @error('company_name')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="company_phone">No. Telepon</label>
                <input type="text" class="form-control @error('company_phone') is-invalid @enderror"
                  id="company_phone" placeholder="Nomor Telepon / HP" name="company_phone"
                  value="{{ Setting::value('company.phone') }}">
                @error('company_phone')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="company_address">Alamat</label>
                <textarea class="form-control" id="company_address" name="company_address">{{ Setting::value('company.address') }}</textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i> Simpan</button>
      </div>
    </div>
  </form>
@endSection

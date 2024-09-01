<?php $title = (!$user->id ? 'Tambah' : 'Edit') . ' Pengguna'; ?>
@extends('admin._layouts.default', [
    'title' => $title,
    'menu_active' => 'system',
    'nav_active' => 'user',
])

@section('content')
  <div>
    <div class="card card-primary">
      <form class="form-horizontal quick-form" method="POST" action="{{ url('/admin/user/edit/' . (int) $user->id) }}">
        @csrf
        <input type="hidden" name="id" value="{{ (int) $user->id }}">
        <div class="card-body">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="username">Username</label>
              <input type="text" class="form-control @error('username') is-invalid @enderror" autofocus id="username"
                placeholder="Username" name="username" {{ $user->id ? 'readonly' : '' }}
                value="{{ old('username', $user->username) }}">
              @if (!$user->id)
                <div class="text-muted">Setelah disimpan username tidak bisa diganti.</div>
                @error('username')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              @endif
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="fullname">Nama Lengkap</label>
              <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname"
                placeholder="Nama Lengkap" name="fullname" value="{{ old('fullname', $user->fullname) }}">
              @error('fullname')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="role">Role</label>
              <select class="custom-select select2" id="role" name="role">
                <option value="" {{ !$user->role ? 'selected' : '' }}>-- Pilih Grup Pengguna --</option>
                @foreach ($roles as $roleId => $roleName)
                  <option value="{{ $roleId }}" {{ old('role', $user->role) == $roleId ? 'selected' : '' }}>
                    {{ $roleName }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="password">Kata Sandi</label>
              <input type="text" class="form-control @error('password') is-invalid @enderror" id="password"
                placeholder="Kata Sandi" name="password" value="{{ old('password') }}">
              <div class="text-muted">Isi untuk mengganti kata sandi.</div>
              @error('password')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input " id="active" name="is_active" value="1"
                  {{ old('is_active', $user->is_active) ? 'checked="checked"' : '' }}>
                <label class="custom-control-label" for="active" title="Akun aktif dapat login">Aktif</label>
              </div>
              <div class="text-muted">Akun aktif dapat login.</div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
          <a class="btn btn-default ml-2" href="/admin/user"><i class="fas fa-cancel mr-1"></i> Batal</a>
        </div>
      </form>
    </div>
  </div>
@endSection

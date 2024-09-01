@extends('admin._layouts.default', [
    'title' => 'Profil Saya',
    'nav_active' => 'profile',
])

@section('content')
  <div class="card card-light">
    <form class="form-horizontal quick-form" method="POST" action="{{ url('admin/user/profile') }}">
      <div class="card-body">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="username">ID Pengguna</label>
            <input type="text" class="form-control @error('username') 'is-invalid' @enderror" id="username" readonly
              value="{{ $user->username }}">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="fullname">Nama Lengkap</label>
            <input type="text" class="form-control @error('fullname') 'is-invalid' @enderror" autofocus id="fullname"
              placeholder="Nama Lengkap" name="fullname" value="{{ old('fullname', $user->fullname) }}">
            @error('fullname')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="current_password">Kata Sandi Saat Ini</label>
            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
              id="current_password" placeholder="Kata Sandi sekarang" name="current_password"
              value="{{ old('current_password') }}">
            @error('current_password')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="password">Kata Sandi <span class="text-muted">(Isi untuk mengganti kata sandi.)</span></label>
            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
            @error('password')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="password_confirmation">Ulangi Kata Sandi<span class="text-muted"></span></label>
            <input type="password" class="form-control @error('password_confirmation') 'is-invalid' @enderror"
              id="password_confirmation" placeholder="Kata Sandi" name="password_confirmation"
              value="{{ old('password_confirmation') }}">
            @error('password_confirmation')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="group_id">Grup Pengguna</label>
            <input type="text" class="form-control" id="group" name="group"
              value="{{ $user->group ? $user->group->name : '' }}" readonly>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <div class="custom-control custom-checkbox">
              <input disabled type="checkbox" class="custom-control-input " id="active"
                {{ $user->is_active ? 'checked="checked"' : '' }}>
              <label class="custom-control-label" for="active">Akun Aktif</label>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <div class="custom-control custom-checkbox">
              <input disabled type="checkbox" class="custom-control-input " id="is_admin"
                {{ $user->is_admin ? 'checked="checked"' : '' }}>
              <label class="custom-control-label" for="is_admin">Hak Akses Administrator</label>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
  </div>
@endsection

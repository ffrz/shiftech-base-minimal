<?php $title = ($item->id ? 'Edit' : 'Tambah') . ' Grup Pengguna'; ?>
@extends('admin._layouts.default', [
    'title' => $title,
    'menu_active' => 'system',
    'nav_active' => 'user-group',
])

@section('content')
  <div class="card card-primary">
    <form class="form-horizontal quick-form" method="POST" action="{{ url('admin/user-group/edit/' . (int) $item->id) }}">
      @csrf
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="name">Nama Grup</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" autofocus id="name"
              placeholder="Masukkan Nama Grup" name="name" value="{{ old('name', $item->name) }}">
            @error('name')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="description">Deskripsi</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
              placeholder="Masukkan deskripsi grup" name="description"
              value="{{ old('description', $item->description) }}">
            @error('description')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
        </div>
        <style>
          custom-control label.acl {
            font-weight: normal;
          }
        </style>
        <div class="form-row col-md-12 mt-4">
          <h5>Hak Akses Grup</h5>
        </div>
        @foreach ($resources as $category => $resource)
          <div style="border: 1px solid #ddd;border-radius:5px;" class="p-2 mt-2 mb-2">
            <h5 class="mb-0">{{ $category }}</h5>
            @foreach ($resource as $name => $label)
              @if (is_array($label))
                <h6 class="mt-3 mb-0">{{ $name }}</h6>
                <div class="d-flex flex-row flex-wrap">
                  @foreach ($label as $subname => $sublabel)
                    <div class="mr-3 custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="{{ $subname }}"
                        name="acl[{{ $subname }}]" value="1"
                        @if (isset($item->acl()[$subname]) && $item->acl()[$subname] == true) {{ 'checked="checked"' }} @endif>
                      <label class="custom-control-label" style="font-weight:normal; white-space: nowrap;"
                        for="{{ $subname }}">{{ $sublabel }}</label>
                    </div>
                  @endforeach
                </div>
              @else
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="{{ $name }}"
                    name="acl[{{ $name }}]" value="1"
                    @if (isset($item->acl()[$name]) && $item->acl()[$name] == true) {{ 'checked="checked"' }} @endif>
                  <label class="custom-control-label" style="font-weight:normal; white-space: nowrap;"
                    for="{{ $name }}">{{ $label }}</label>
                </div>
              @endif
            @endforeach
          </div>
        @endforeach
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
        <a class="btn btn-default ml-2" href="/admin/user-group"><i class="fas fa-cancel mr-1"></i> Batal</a>
      </div>
    </form>
  </div>
@endSection

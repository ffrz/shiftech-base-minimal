@extends('admin._layouts.default', [
    'title' => 'Aktivitas Pengguna',
    'menu_active' => 'system',
    'nav_active' => 'user-activity',
])

@section('content')
  <div class="card card-light">
    <div class="card-body">
      <form action="?" method="GET">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group form-inline">
              <label class="mr-2" for="user_id">Pengguna:</label>
              <select class="form-control custom-select" name="user_id" id="user_id" onchange="this.form.submit();">
                <option value="">Semua</option>
                @foreach ($users as $user)
                  <option value="{{ $user->id }}" {{ $filter['user_id'] == $user->id ? 'selected' : '' }}>
                    {{ $user->username }}</option>
                @endforeach
              </select>
              <label class="ml-4 mr-2" for="type">Tipe:</label>
              <select class="form-control custom-select" name="type" id="type" onchange="this.form.submit();">
                <option value="">Semua</option>
                @foreach ($types as $type => $label)
                  <option value="{{ $type }}" {{ $filter['type'] == $type ? 'selected' : '' }}>
                    {{ $label }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-6 d-flex justify-content-end">
            <div class="form-group form-inline">
              <label class="mr-2" for="search">Cari:</label>
              <input type="text" class="form-control" name="search" id="search" value="{{ $filter['search'] }}"
                placeholder="Cari deskripsi">
            </div>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-md-12">
          <form method="POST" action="{{ url('admin/user-activity/delete') }}"
            onsubmit="return confirm('Hapus rekaman?')">
            @csrf
            <table class="data-table display table table-bordered table-striped table-condensed" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Waktu</th>
                  <th>Pengguna</th>
                  <th>Tipe</th>
                  <th>Aktivitas</th>
                  <th>Deskripsi</th>
                  <th class="text-center" style="max-width:10%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($items as $item)
                  <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->datetime }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->typeFormatted() }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <a href="{{ url("/admin/user-activity/show/$item->id") }}" class="btn btn-default btn-sm"
                          title="Lihat"><i class="fa fa-eye"></i></a>
                        <button href="{{ url('/admin/user-activity/delete') }}" class="btn btn-danger btn-sm"
                          type="submit" title="Hapus"><i class="fa fa-trash"></i></button>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="empty">Belum ada rekaman</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <p class="text-muted">Menampilkan {{ $items->count() }} rekaman dari total {{ $items->total() }} rekaman.</p>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
          {{ $items->withQueryString()->onEachSide(1)->links('admin._components.paginator') }}
        </div>
      </div>
    </div>
  </div>
@endsection

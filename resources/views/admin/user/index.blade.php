@extends('admin._layouts.default', [
    'title' => 'Pengguna',
    'menu_active' => 'system',
    'nav_active' => 'user',
])

@section('right-menu')
  <li class="nav-item">
    <a href="{{ url('/admin/user/edit/0') }}" class="btn plus-btn btn-primary mr-2" title="Baru"><i
        class="fa fa-plus"></i></a>
  </li>
@endsection

@section('content')
  <div class="card card-light">
    <div class="card-body">
      <form action="?" method="GET">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group form-inline">
              <label class="mr-2" for="role">Grup:</label>
              <select class="form-control custom-select mr-4" name="role" id="role" onchange="this.form.submit();">
                <option value="">Semua</option>
                @foreach ($roles as $roleId => $roleName)
                  <option value="{{ $roleId }}" {{ $filter['role'] == $roleId ? 'selected' : '' }}>
                    {{ $roleName }}</option>
                @endforeach
              </select>
              <label class="mr-2" for="type">Jenis Akun:</label>
              <select class="form-control custom-select mr-4" name="type" id="type" onchange="this.form.submit();">
                <option value="-1">Semua</option>
                <option value="1" {{ $filter['type'] == 1 ? 'selected' : '' }}>Administrator</option>
                <option value="0" {{ $filter['type'] == 0 ? 'selected' : '' }}>Pengguna Biasa</option>
              </select>
              <label class="mr-2" for="status">Status:</label>
              <select class="form-control custom-select mr-4" name="status" id="status" onchange="this.form.submit();">
                <option value="-1">Semua</option>
                <option value="1" {{ $filter['status'] == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ $filter['status'] == 0 ? 'selected' : '' }}>Tidak Aktif</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 d-flex justify-content-end">
            <div class="form-group form-inline">
              <label class="mr-2" for="search">Cari:</label>
              <input type="text" class="form-control" name="search" id="search" value="{{ $filter['search'] }}"
                placeholder="Cari pengguna">
            </div>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-md-12">
          <table class="data-table display table table-bordered table-striped table-condensed center-th"
            style="width:100%">
            <thead>
              <tr>
                <th>ID Pengguna</th>
                <th>Nama Lengkap</th>
                <th>Grup</th>
                <th>Status</th>
                <th class="text-center" style="max-width:10%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($items as $item)
                <tr>
                  <td>
                    {{ $item->username }}
                    @if ($item->is_admin)
                      <span class="badge badge-warning">Administrator</span>
                    @endif
                  </td>
                  <td>{{ $item->fullname }}</td>
                  <td>{{ $item->role ? \App\Models\UserRole::getRoles()[$item->role] : '-' }}</td>
                  <td>{{ $item->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                  <td class="text-center">
                    <div class="btn-group">
                      <a href="{{ url("/admin/user/edit/$item->id") }}" class="btn btn-default btn-sm"><i
                          class="fa fa-edit"></i></a>
                      <a href="{{ url("/admin/user/delete/$item->id") }}" class="btn btn-danger btn-sm"><i
                          class="fa fa-trash"></i></a>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="empty">Belum ada rekaman</td>
                </tr>
              @endforelse
            </tbody>
          </table>
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

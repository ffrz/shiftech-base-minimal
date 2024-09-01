@extends('admin._layouts.default', [
    'title' => 'Grup Pengguna',
    'menu_active' => 'system',
    'nav_active' => 'user-group',
])

@section('right-menu')
  <li class="nav-item">
    <a href="<?= url('/admin/user-group/edit/0') ?>" class="btn plus-btn btn-primary mr-2" title="Baru"><i
        class="fa fa-plus"></i></a>
  </li>
@endSection

@section('content')
  <div class="card card-light">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <table class="data-table display table table-bordered table-striped table-condensed center-th"
            style="width:100%">
            <thead>
              <tr>
                <th style="width:30%">Nama Grup</th>
                <th>Deskripsi</th>
                <th style="width:5%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($items as $item)
                <tr>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->description }}</td>
                  <td class="text-center">
                    <div class="btn-group">
                      <a href="<?= url("/admin/user-group/edit/$item->id") ?>" class="btn btn-default btn-sm"><i
                          class="fa fa-edit"></i></a>
                      <a onclick="return confirm('Anda yakin akan menghapus rekaman ini?')"
                        href="<?= url("/admin/user-group/delete/$item->id") ?>" class="btn btn-danger btn-sm"><i
                          class="fa fa-trash"></i></a>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" class="empty">Belum ada rekaman</td>
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
@endSection

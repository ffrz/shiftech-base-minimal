<?php
use App\Models\AclResource;

if (!isset($menu_active)) {
    $menu_active = null;
}

?>
<aside class="main-sidebar sidebar-light-primary elevation-4">
  <a href="{{ url('/admin') }}" class="brand-link">
    <img src="{{ url('dist/img/logo.png') }}" alt="App Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text">{{ env('APP_NAME') }}</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-flat nav-collapse-hide-child" data-widget="treeview"
        role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ url('/admin') }}" class="nav-link {{ $nav_active == 'dashboard' ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        {{-- Report Menu --}}
        @if (Auth::user()->canAccess(AclResource::REPORT_MENU))
          <li class="nav-item {{ $menu_active == 'report' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ $menu_active == 'report' ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-waveform"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#"
                  class="nav-link {{ $nav_active == 'report-1' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-file-waveform"></i>
                  <p>Laporan 1</p>
                </a>
              </li>
            </ul>
          </li>
        @endif
        {{-- End Report Menu --}}

        {{-- System Menu --}}
        @if (Auth::user()->canAccess(AclResource::SYSTEM_MENU))
          <li class="nav-item {{ $menu_active == 'system' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ $menu_active == 'system' ? 'active' : '' }}">
              <i class="nav-icon fas fa-gears"></i>
              <p>
                Sistem
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (Auth::user()->canAccess(AclResource::USER_ACTIVITY))
                <li class="nav-item">
                  <a href="{{ url('/admin/user-activity') }}"
                    class="nav-link {{ $nav_active == 'user-activity' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file-waveform"></i>
                    <p>Log Aktivitas</p>
                  </a>
                </li>
              @endif
              @if (Auth::user()->canAccess(AclResource::USER_MANAGEMENT))
                <li class="nav-item">
                  <a href="{{ url('/admin/user') }}" class="nav-link {{ $nav_active == 'user' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Pengguna</p>
                  </a>
                </li>
              @endif
              @if (Auth::user()->canAccess(AclResource::SETTINGS))
                <li class="nav-item">
                  <a href="{{ url('/admin/settings') }}"
                    class="nav-link {{ $nav_active == 'settings' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-gear"></i>
                    <p>Pengaturan</p>
                  </a>
                </li>
              @endif
            </ul>
          </li>
        @endif
        {{-- End of System  menu --}}

        <li class="nav-item">
          <a href="{{ url('/admin/user/profile/') }}" class="nav-link {{ $nav_active == 'profile' ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>{{ Auth::user()->username }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('admin/logout') }}" class="nav-link">
            <i class="nav-icon fas fa-right-from-bracket"></i>
            <p>Keluar</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>

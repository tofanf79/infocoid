
<div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <div class="navbar-brand m-0">
        <img src="{{ asset('imgprofil/'.Auth::user()->foto) }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">{{ Auth::user()->username }}</span>
      </div>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main" style="height: calc(100vh - 150px);">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/admin">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Beranda</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/admin/jenisiklan">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-scroll text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Jenis Iklan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/admin/iklan">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-newspaper  text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Info Iklan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/admin/user">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-users text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Pelanggan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/admin/profile">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('logout') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-sign-out-alt text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  
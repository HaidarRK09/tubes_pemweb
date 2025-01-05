<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
      <li class="nav-item">
          <a class="nav-link" href="{{ route('dashboard.staff') }}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
          </a>
      </li>
      <li class="nav-item nav-category">Sidebar </li>
      @if ( $user->role === 'superadmin')
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#form-elements"
            aria-expanded="false" aria-controls="form-elements">
            <i class="menu-icon mdi mdi-card-text-outline"></i>
            <span class="menu-title">Super Admin</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('staff')}}">Admin</a></li>
            </ul>
        </div>
    </li>
      @endif
      @if ( $user->role === 'admin' || $user->role === 'superadmin')
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#charts"
            aria-expanded="false" aria-controls="charts">
            <i class="menu-icon mdi mdi-account-key"></i>
            <span class="menu-title">Admin</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="charts">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('pegawai')}}">Staff</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('pasien')}}">Pasien</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reservasi')}}">Reservasi</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('booking')}}">Booking</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('poli')}}">Poliklinik</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('sesi')}}">Sesi</a></li>
            </ul>
        </div>
    </li>
      @endif
      @if ( $user->role === 'admin' || $user->role === 'superadmin' || $user->role === 'dokter gigi' || $user->role === 'dokter umum')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dokter') }}">
            <i class="mdi mdi-heart-pulse menu-icon"></i>
            <span class="menu-title">Dokter</span>
        </a>
    </li>    
      @endif
      @if ( $user->role === 'admin' || $user->role === 'superadmin' || $user->role === 'apoteker')
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#tables"
            aria-expanded="false" aria-controls="tables">
            <i class="menu-icon mdi mdi-hospital"></i>
            <span class="menu-title">Apoteker</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{route('apoteker')}}">Obat</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('apoteker.opasien')}}">Obat Pasien</a></li>
            </ul>
        </div>
    </li>
      @endif
      @if ( $user->role === 'admin' || $user->role === 'superadmin' || $user->role === 'laboratorium')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('laboratorium') }}">
            <i class="mdi mdi-flask-outline menu-icon"></i>
            <span class="menu-title">Laboratorium</span>
        </a>
       </li>
      @endif
      @if ( $user->role === 'admin' || $user->role === 'superadmin' || $user->role === 'radiologi')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('radiologi') }}">
            <i class="mdi mdi-heart-outline menu-icon"></i>
            <span class="menu-title">Radiologi</span>
        </a>
    </li>
      @endif
    <li class="nav-item nav-category">Pengaturan </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#pengaturan"
            aria-expanded="false" aria-controls="form-elements">
            <i class="menu-icon mdi mdi-account-circle"></i>
            <span class="menu-title">Akun</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="pengaturan">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('staff.profile')}}">Profil</a></li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('staff.logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="btn btn-default btn-flat">
                <i class="mdi mdi-logout menu-icon"></i>
                <span class="menu-title">Keluar</span>
                </a>
                <form id="logout-form" action="{{ route('staff.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
    </li>
  </ul>
</nav>
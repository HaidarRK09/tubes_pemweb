<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
      <li class="nav-item">
          <a class="nav-link" href="{{ route('dashboard.pasien') }}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('staff.logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="btn btn-default btn-flat">
                   <i class="mdi mdi-logout menu-icon"></i>
                   <span class="menu-title">Keluar</span>
                </a>
                <form id="logout-form" action="{{ route('pasien.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
    </li>
  </ul>
</nav>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a @if (Session::get('page')=="dashboard" ) style="background: #4B49AC !important; color:white !important" @endif class="nav-link" href="{{ route('dashboardDosen') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (Auth::guard('dosen')->user()->status_koordinator == 1 && Auth::guard('dosen')->user()->program_studi == 'Teknik Pertambangan')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('viewDaftarSidang', 'Teknik Pertambangan') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Daftar Sidang</span>
            </a>
        </li>
        @endif

        @if (Auth::guard('dosen')->user()->status_koordinator == 1 && Auth::guard('dosen')->user()->program_studi == 'Teknik Industri')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('viewDaftarSidang', 'Teknik Industri') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Daftar Sidang</span>
            </a>
        </li>
        @endif

        @if (Auth::guard('dosen')->user()->status_koordinator == 1 && Auth::guard('dosen')->user()->program_studi == 'Perencanaan Wilayah dan Kota')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('viewDaftarSidang', 'Perencanaan Wilayah dan Kota') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Daftar Sidang</span>
            </a>
        </li>
        @endif
    </ul>
</nav>
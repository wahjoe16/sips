<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a @if (Session::get('page')=="dashboard" ) style="background: #4B49AC !important; color:white !important" @endif class="nav-link" href="{{ route('dashboardMahasiswa') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <!-- @if (Auth::guard('mahasiswa')->user()->type == 'admin') -->
        <li class="nav-item" @if(Session::get('page')=="view_admin" || Session::get('page')=="view_subadmin" || Session::get('page')=="view_vendor" || Session::get('page')=="view_all" ) style="background: #4B49AC !important; color:#fff !important;" @endif>
            <a class="nav-link" data-toggle="collapse" href="#ui-admin" aria-expanded="false" aria-controls="ui-admin">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">User Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-admin">
                <ul class="nav flex-column sub-menu" style="background:#fff !important; color:#4B49AC !important;">
                    <li class="nav-item"> <a @if(Session::get('page')=="dosen" ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif class="nav-link" href="{{ route('viewDosen') }}">Dosen</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="mahasiswa" ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif class="nav-link" href="{{ route('viewMahasiswa') }}">Mahasiswa</a></li>
                </ul>
            </div>
        </li>
        <!-- @endif -->

        @if(Auth::guard('mahasiswa')->user()->program_studi == 'Teknik Pertambangan')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('daftarSidang', 'Teknik Pertambangan') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Daftar Sidang</span>
            </a>
        </li>
        @endif

        @if(Auth::guard('mahasiswa')->user()->program_studi == 'Teknik Industri')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('daftarSidang', 'Teknik Industri') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Daftar Sidang</span>
            </a>
        </li>
        @endif

        @if(Auth::guard('mahasiswa')->user()->program_studi == 'Perencanaan Wilayah dan Kota')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('daftarSidang', 'Perencanaan Wilayah dan Kota') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Daftar Sidang</span>
            </a>
        </li>
        @endif

        @if(Auth::guard('mahasiswa')->user()->program_studi == 'Program Profesi Insinyur')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('daftarSidang', 'Program Profesi Insinyur') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Daftar Sidang</span>
            </a>
        </li>
        @endif

        @if(Auth::guard('mahasiswa')->user()->program_studi == 'Magister Perencanaan Wilayah dan Kota')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('daftarSidang', 'Magister Perencanaan Wilayah dan Kota') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Daftar Sidang</span>
            </a>
        </li>
        @endif
    </ul>
</nav>
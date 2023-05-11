<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a @if (Session::get('page')=="dashboard" ) style="background: #4B49AC !important; color:white !important" @endif class="nav-link" href="{{ route('dashboardAdmin') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (Auth::guard('admin')->user()->type == 'admin')
        <li class="nav-item">
            <a @if(Session::get('page')=="dosen" || Session::get('page')=="mahasiswa" || Session::get('page')=="semester" || Session::get('page')=="tahun_ajaran" ) style="background: #4B49AC !important; color:#fff !important;" @endif class="nav-link" data-toggle="collapse" href="#ui-admin" aria-expanded="false" aria-controls="ui-admin">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Data Master</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-admin">
                <ul class="nav flex-column sub-menu" style="background:#fff !important; color:#4B49AC !important;">
                    <li class="nav-item"> <a @if(Session::get('page')=="dosen" ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif class="nav-link" href="{{ route('viewDosen') }}">Dosen</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="mahasiswa" ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif class="nav-link" href="{{ route('viewMahasiswa') }}">Mahasiswa</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="semester" ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif class="nav-link" href="{{ route('viewSemester') }}">Semester</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="tahun_ajaran" ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif class="nav-link" href="{{ route('viewTahunAjaran') }}">Tahun Ajaran</a></li>
                </ul>
            </div>
        </li>
        @endif

        <li class="nav-item">
            <a @if(Session::get('page')=="daftarSidang" ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif class="nav-link" href="{{ route('viewDaftarSidangAll') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Daftar Sidang</span>
            </a>
        </li>
    </ul>
</nav>
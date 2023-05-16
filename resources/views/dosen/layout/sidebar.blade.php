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
            <a @if( Session::get('page')=='viewDaftarSeminar' || Session::get('page')=='rekapDaftarSeminar' ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif class="nav-link" data-toggle="collapse" href="#kolokium-skripsi" aria-expanded="false" aria-controls="kolokium-skripsi">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Kolokium Skripsi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="kolokium-skripsi">
                <ul class="nav flex-column sub-menu" style="background:#fff !important; color:#4B49AC !important;">
                    <li class="nav-item"><a href="{{ route('viewDaftarSeminar', 'Teknik Pertambangan') }}" class="nav-link" @if( Session::get('page')=='viewDaftarSeminar' ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif>Pengajuan</a></li>
                    <li class="nav-item"><a href="{{ route('daftar-seminar.index', 'Teknik Pertambangan') }}" class="nav-link" @if( Session::get('page')=='rekapDaftarSeminar' ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif>Rekapitulasi</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a @if( Session::get('page')=='viewDaftarSidang' || Session::get('page')=='rekapDaftarSidang' ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif class="nav-link" data-toggle="collapse" href="#sidang-skripsi" aria-expanded="false" aria-controls="sidang-skripsi">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Sidang Skripsi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="sidang-skripsi">
                <ul class="nav flex-column sub-menu" style="background:#fff !important; color:#4B49AC !important;">
                    <li class="nav-item"><a href="{{ route('viewDaftarSidang', 'Teknik Pertambangan') }}" class="nav-link" @if( Session::get('page')=='viewDaftarSidang' ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif>Pengajuan</a></li>
                    <li class="nav-item"><a href="{{ route('daftar-sidang.index', 'Teknik Pertambangan') }}" class="nav-link" @if( Session::get('page')=='rekapDaftarSidang' ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif>Rekapitulasi</a></li>
                </ul>
            </div>
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
            <a @if( Session::get('page')=='viewDaftarSeminar' || Session::get('page')=='daftar-seminar.index' ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif class="nav-link" data-toggle="collapse" href="#sidang-pembahasan" aria-expanded="false" aria-controls="sidang-pembahasan">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Sidang Pembahasan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="sidang-pembahasan">
                <ul class="nav flex-column sub-menu" style="background:#fff !important; color:#4B49AC !important;">
                    <li class="nav-item"><a href="{{ route('viewDaftarSeminar', 'Perencanaan Wilayah dan Kota') }}" class="nav-link" @if( Session::get('page')=='viewDaftarSeminar' ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif>Pengajuan</a></li>
                    <li class="nav-item"><a href="{{ route('daftar-seminar.index', 'Perencanaan Wilayah dan Kota') }}" class="nav-link" @if( Session::get('page')=='rekapDaftarSeminar' ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif>Rekapitulasi</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a @if( Session::get('page')=='viewDaftarSidang' || Session::get('page')=='rekapDaftarSidang' ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif class="nav-link" data-toggle="collapse" href="#sidang-skripsi" aria-expanded="false" aria-controls="sidang-skripsi">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Sidang Terbuka</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="sidang-skripsi">
                <ul class="nav flex-column sub-menu" style="background:#fff !important; color:#4B49AC !important;">
                    <li class="nav-item"><a href="{{ route('viewDaftarSidang', 'Perencanaan Wilayah dan Kota') }}" class="nav-link" @if( Session::get('page')=='viewDaftarSidang' ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif>Pengajuan</a></li>
                    <li class="nav-item"><a href="{{ route('daftar-sidang.index', 'Perencanaan Wilayah dan Kota') }}" class="nav-link" @if( Session::get('page')=='rekapDaftarSidang' ) style="background:#4B49AC !important; color:#fff !important;" @else style="background:#fff !important; color:#4B49AC !important;" @endif>Rekapitulasi</a></li>
                </ul>
            </div>
        </li>

        @endif

    </ul>
</nav>
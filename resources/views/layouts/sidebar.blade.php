<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="@if(Request::segment(1)=='admin'){{ route('admin.index') }} @elseif(Request::segment(1)=='peternak'){{ route('peternak.index') }} @elseif(Request::segment(1)=='distributor'){{ route('distributor.index') }}  @endif">Ayam-Ku</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="@if(Request::segment(1)=='admin'){{ route('admin.index') }} @elseif(Request::segment(1)=='peternak'){{ route('peternak.index') }} @elseif(Request::segment(1)=='distributor'){{ route('distributor.index') }}  @endif">AK</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">DASHBOARD</li>
            <li class="@if(Request::fullUrl() == 'http://127.0.0.1:8000/admin' || Request::fullUrl() == 'http://127.0.0.1:8000/peternak' || Request::fullUrl() == 'http://127.0.0.1:8000/distributor') active @endif">
                <a href="@if(Request::segment(1)=='admin'){{ route('admin.index') }} @elseif(Request::segment(1)=='peternak'){{ route('peternak.index') }} @elseif(Request::segment(1)=='distributor'){{ route('distributor.index') }}  @endif" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">FITUR</li>
            @if (Request::segment(1)=='admin')
                <li class="nav-item dropdown @if (Request::segment(1) == 'admin' and Request::segment(2) == 'kecamatan') active @elseif (Request::segment(1) == 'admin' and Request::segment(2) == 'vitamin') active @elseif (Request::segment(1) == 'admin' and Request::segment(2) == 'kategori') active @endif">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i><span>Master Data</span></a>
                    <ul class="dropdown-menu">
                        <li class="@if (Request::segment(1) == 'admin' and Request::segment(2) == 'kecamatan')
                        active @endif"><a class="nav-link" href="{{ route('kecamatan.index') }}">Data Kecamatan</a></li>
                    </ul>
                    <ul class="dropdown-menu">
                        <li class="@if (Request::segment(1) == 'admin' and Request::segment(2) == 'vitamin')
                        active @endif"><a class="nav-link" href="{{ route('vitamin.index') }}">Data Vitamin</a></li>
                    </ul>
                    <ul class="dropdown-menu">
                        <li class="@if (Request::segment(1) == 'admin' and Request::segment(2) == 'kategori')
                        active @endif"><a class="nav-link" href="{{ route('kategori.index') }}">Data Kategori</a></li>
                    </ul>
                </li>
            @endif
            @if (Request::segment(1) == 'admin')
                <li class="@if(Request::segment(1) == 'admin' and Request::segment(2) == 'artikel') active @endif">
                    <a href="{{ route('artikel.index') }}" class="nav-link"><i class="far fa-newspaper"></i><span>Artikel</span></a>
                </li>
            @elseif (Request::segment(1) == 'peternak')
                <li class="@if(Request::segment(1) == 'peternak' and Request::segment(2) == 'artikel') active @endif">
                    <a href="{{ route('artikel.index.peternak') }}" class="nav-link"><i class="far fa-newspaper"></i><span>Artikel</span></a>
                </li>
            @endif
            @if (Request::segment(1) == 'peternak')
                <li class="@if(Request::segment(1) == 'peternak' and Request::segment(2) == 'kandang') active @endif">
                    <a href="{{ route('kandang.index') }}" class="nav-link"><i class="fas fa-home"></i><span>Kandang</span></a>
                </li>
                <li class="@if(Request::segment(1) == 'peternak' and Request::segment(2) == 'progress') active @endif">
                    <a href="{{ route('progress.index') }}" class="nav-link"><i class="fas fa-home"></i><span>Progress</span></a>
                </li>
                <li class="@if(Request::segment(1) == 'peternak' and Request::segment(2) == 'panen') active @endif">
                    <a href="{{ route('panen.index') }}" class="nav-link"><i class="fas fa-home"></i><span>Panen</span></a>
                </li>
                <li class="@if(Request::segment(1) == 'peternak' and Request::segment(2) == 'produk') active @endif">
                    <a href="{{ route('produk.index.peternak') }}" class="nav-link"><i class="fas fa-home"></i><span>Produk</span></a>
                </li>
            @endif
            @if (Request::segment(1) == 'admin')
                <li class="@if(Request::segment(1) == 'admin' and Request::segment(2) == 'dataAkun') active @endif">
                    <a href="{{ route('admin.akun') }}" class="nav-link"><i class="far fa-user"></i><span>Data Akun</span></a>
                </li>
            @endif
        </ul>      
    </aside>
</div>
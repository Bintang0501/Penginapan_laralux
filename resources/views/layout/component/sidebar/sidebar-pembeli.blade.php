<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu">
            <li class="sidebar-toggler-wrapper">
                <div class="sidebar-toggler">
                </div>
                <div class="clearfix">
                </div>
            </li>
            <li class="sidebar-search-wrapper">
                <form class="search-form" role="form" action="index.html" method="get">
                    <div class="input-icon right">
                        <i class="icon-magnifier"></i>
                        <input type="text" class="form-control" name="query" placeholder="Search...">
                    </div>
                </form>
            </li>
            <li class="{{ Request::segment(1) == 'dashboard' ? 'start active' : '' }}">
                <a href="{{ url('/dashboard') }}">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="{{ Request::segment(1) == "rekomendasi-hotel" ? 'start active' : '' }}">
                <a href="{{ url('rekomendasi-hotel') }}">
                    <i class="icon-bar-chart"></i>
                    <span class="title">
                        Daftar Hotel
                    </span>
                </a>
            </li>
            <li class="{{ Request::segment(1) == "riwayat-transaksi-saya" ? 'start active' : '' }}">
                <a href="{{ route('pages.riwayat-transaksi-saya.index') }}">
                    <i class="icon-bar-chart"></i>
                    <span class="title"> Riwayat Transaksi Saya </span>
                </a>
            </li>
        </ul>
    </div>
</div>

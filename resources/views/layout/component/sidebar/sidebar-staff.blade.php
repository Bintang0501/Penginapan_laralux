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
            <li class="start active ">
                <a href="{{ url('dashboard') }}">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li>
                <a href="{{ url('tipe-hotel') }}">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Tipe Hotel</span>
                </a>
            </li>
            <li>
                <a href="{{ url('hotel') }}">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Daftar Hotel</span>
                </a>
            </li>
            <li>
                <a href="{{ url('tipe-produk') }}">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Tipe Produk</span>
                </a>
            </li>
            <li>
                <a href="{{ url('produk') }}">
                    <i class="fa fa-book"></i>
                    <span class="title">Produk</span>
                </a>
            </li>
            <li>
                <a href="{{ url('fasilitas') }}">
                    <i class="fa fa-book"></i>
                    <span class="title">Fasilitas</span>
                </a>
            </li>
            <li class="{{ Request::segment(1) == 'member' ? 'start active' : '' }}">
                <a href="{{ url('/member') }}">
                    <i class="fa fa-user"></i>
                    <span class="title">Member</span>
                </a>
            </li>
            <li>
                <a href="{{ url('laporan') }}">
                    <i class="fa fa-book"></i>
                    <span class="title">Laporan Transaksi</span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>

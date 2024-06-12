<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('home.index') }}" class="waves-effect">
                        <i class="bx bxs-dashboard"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-data"></i>
                        <span key="t-master">Master</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('satuan.index') }}" key="t-satuan">Satuan</a></li>
                        <li><a href="{{ route('produk.index') }}" key="t-produk">Produk</a></li>
                        <li><a href="{{ route('supplier.index') }}" key="t-supplier">Supplier</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('pembelian.index') }}" class="waves-effect">
                        <i class="bx bx-cart-alt"></i>
                        <span key="t-pembelian">Pembelian</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('penjualan.index') }}" class="waves-effect">
                        <i class="bx bx-money"></i>
                        <span key="t-penjualan">Penjualan</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-laporan">Laporan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('arus_stok.index') }}" key="t-arus-stok">Arus Stok</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

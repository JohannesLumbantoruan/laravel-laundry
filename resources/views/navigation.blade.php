<nav class="navbar navbar-expand-md bg-dark navbar-dark mb-5">
    <div class="container">
        <!-- Brand -->
        <a href="{{ route('dashboard') }}" class="navbar-brand">LAUNDRY</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link"><i class="fa fa-home"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('pelanggan') }}" class="nav-link"><i class="fa fa-user"></i> Pelanggan</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transaksi') }}" class="nav-link"><i class="fa fa-exchange-alt"></i> Transaksi</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan') }}" class="nav-link"><i class="fa fa-book"></i> Laporan</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('harga') }}" class="nav-link"><i class="fa fa-dollar-sign"></i> Harga</a>            
                </li>
            </ul>

            <div class="dropdown ml-auto">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    Hai, {{ Auth::guard('admin')->user()->username }}
                </button>
                <div class="dropdown-menu">
                    <a href="{{ route('gantiPassword') }}" class="dropdown-item"><i class="fa fa-lock"></i> Ganti Password</a>
                    <a href="{{ route('logout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>
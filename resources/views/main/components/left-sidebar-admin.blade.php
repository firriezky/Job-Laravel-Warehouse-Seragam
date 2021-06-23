<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{ URL('/home') }}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">Dashboard</span></a></li>
                <li class="list-divider"></li>

                @if (Auth::user()->role != 2)

                <li class="nav-small-cap"><span class="hide-menu">Manage Karyawan</span></li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ URL('karyawan/tambah') }}" aria-expanded="false">
                            <i data-feather="tag" class="feather-icon"></i>
                            <span class="hide-menu">Tambah Karyawan
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ URL('karyawan/manage') }}" aria-expanded="false">
                            <i data-feather="tag" class="feather-icon"></i>
                            <span class="hide-menu">Manage/Edit Karyawan
                            </span>
                        </a>
                    </li>
                @endif


                @if (Auth::user()->role != 2)


                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu">Manage Supplier</span></li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ URL('supplier/tambah') }}" aria-expanded="false">
                            <i data-feather="tag" class="feather-icon"></i>
                            <span class="hide-menu">Tambah Supplier
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ URL('supplier/manage') }}" aria-expanded="false">
                            <i data-feather="tag" class="feather-icon"></i>
                            <span class="hide-menu">Manage/Edit Supplier
                            </span>
                        </a>
                    </li>
                @endif


                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Manage Barang Toko</span></li>

                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ URL('barang/tambah') }}" aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Tambah Barang
                        </span>
                    </a>
                </li>
                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ URL('barang/manage') }}" aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Manage/Edit Barang
                        </span>
                    </a>
                </li>

                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ URL('barang/masuk') }}" aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Barang Masuk
                        </span>
                    </a>
                </li>

                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ URL('barang/keluar') }}" aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Barang Keluar
                        </span>
                    </a>
                </li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Jadwal Piket</span></li>

                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ URL('/jadwal-piket') }}" aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Jadwal Piket
                        </span>
                    </a>
                </li>



                <li class="list-divider"></li>


                <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();  document.getElementById('logout-form').submit();"
                        aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                            class="hide-menu">Logout</span></a></li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

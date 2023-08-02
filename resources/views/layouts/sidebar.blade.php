@php
    $setting = DB::table('settings')->first();
@endphp
<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo text-center">
                    <a href="{{ route('dashboard') }}">Perpus</a>
                </div>
                <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                    <svg class="iconify iconify--system-uicons" role="img" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                            <g transform="translate(-210 -1)">
                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                </path>
                            </g>
                        </g>
                    </svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input me-0" id="toggle-dark" type="checkbox" style="cursor: pointer" />
                        <label class="form-check-label"></label>
                    </div>
                    <svg class="iconify iconify--mdi" role="img" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                        </path>
                    </svg>
                </div>
                <div class="sidebar-toggler x">
                    <a class="sidebar-hide d-xl-none d-block" href="#"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard') }}">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-title">Master Data</li>

                <li class="sidebar-item {{ request()->is('buku*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('buku.index') }}">
                        <i class="bi bi-book"></i>
                        <span>Data Buku</span>
                    </a>
                </li>
                @hasrole(['staff', 'kepsek', 'admin'])
                    <li class="sidebar-item {{ request()->is('kategori*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('kategori.index') }}">
                            <i class="bi bi-list"></i>
                            <span>Data Kategori</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->is('kelas*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('kelas.index') }}">
                            <i class="bi bi-building"></i>
                            <span>Data Kelas</span>
                        </a>
                    </li>
                    <li class="sidebar-item has-sub {{ request()->is('member*') || request()->is('staff*') ? 'active submenu-open' : '' }}">
                        <a class="sidebar-link" href="#">
                            <i class="bi bi-person"></i>
                            <span>Data User</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item {{ request()->is('member*') ? 'active' : '' }}">
                                <a class="submenu-link " href="{{ route('member.index') }}">Member</a>
                            </li>
                            @hasrole('admin')
                                <li class="submenu-item {{ request()->is('staff*') ? 'active' : '' }}">
                                    <a class="submenu-link" href="{{ route('staff.index') }}">Staff</a>
                                </li>

                                <li class="submenu-item {{ request()->is('kepsek*') ? 'active' : '' }}">
                                    <a class="submenu-link" href="{{ route('kepsek.index') }}">Kepsek</a>
                                </li>
                            @endhasrole
                        </ul>
                    </li>
                @endhasrole

                @hasrole('staff')
                    <li class="sidebar-title">Transaksi</li>
                    <li class="sidebar-item {{ request()->is('pinjam*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('pinjam.index') }}">
                            <i class="bi bi-file-earmark-medical-fill"></i>
                            <span>Peminjaman Buku</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->is('pengembalian*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('pengembalian.index') }}">
                            <i class="bi bi-file-earmark-medical-fill"></i>
                            <span>Pengembalian Buku</span>
                        </a>
                    </li>
                @endhasrole
                @hasrole(['staff', 'kepsek'])
                    <li class="sidebar-title">Laporan</li>
                    <li class="sidebar-item {{ request()->is('laporan') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('laporan.index') }}">
                            <i class="bi bi-file"></i>
                            <span>Laporan Peminjaman</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->is('laporan-pengunjung') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('pengunjung.laporan') }}">
                            <i class="bi bi-clipboard2-check"></i>
                            <span>Pengunjung</span>
                        </a>
                    </li>
                @endhasrole

                @hasrole('siswa')
                    <li class="sidebar-title">Riwayat</li>
                    <li class="sidebar-item {{ request()->is('riwayat-member') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('riwayat.index') }}">
                            <i class="bi bi-clock-history"></i>
                            <span>Riwayat Peminjaman</span>
                        </a>
                    </li>
                @endhasrole

                <li class="sidebar-title">Lainnya</li>

                @hasrole(['staff', 'kepsek', 'admin'])
                    <li class="sidebar-item {{ request()->is('setting*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('setting.index') }}">
                            <i class="bi bi-gear"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                @endhasrole
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('about') }}">
                        <i class="bi bi-exclamation-circle"></i>
                        <span>About</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Menu</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?= base_url('admin'); ?>">Dashboard</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-list"></i> Data Master <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?= base_url('admin/jabatan'); ?>">Jabatan</a></li>
                    <li><a href="<?= base_url('admin/pegawai'); ?>">Pegawai</a></li>
                    <li><a href="<?= base_url('admin/shift'); ?>">Shift</a></li>
                    <li><a href="<?= base_url('admin/jadwal'); ?>">Jadwal Shift</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-book"></i> Data Rekap <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?= base_url('admin/presensi'); ?>">Presensi</a></li>
                    <li><a href="<?= base_url('admin/rekap'); ?>">Rekap Bulanan</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->
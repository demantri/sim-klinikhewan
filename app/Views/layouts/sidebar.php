<ul class="sidebar-menu">
    <li><a class="nav-link" href="<?= base_url('dashboard') ?>"><i class="fa-solid fa-house"></i> <span>Dashboard</span></a></li>

    <?php if (session()->get('role_name') == 'admin') { ?>
        <li class="dropdown">
            <a class="nav-link has-dropdown" href="#">
                <i class="fa-solid fa-house"></i> <span>Masterdata</span>
            </a>
            <ul class="dropdown-menu">
                <!-- <li>
                    <a class="nav-link" href="<?= base_url('masterdata/dokter') ?>">Dokter</a>
                </li>
                <li>
                    <a class="nav-link" href="<?= base_url('masterdata/pemilik') ?>">Pemilik</a>
                </li>
                <li>
                    <a class="nav-link" href="<?= base_url('masterdata/kategori') ?>">Kategori</a>
                </li>
                <li>
                    <a class="nav-link" href="<?= base_url('masterdata/spesies') ?>">Spesies</a>
                </li>
                <li>
                    <a class="nav-link" href="<?= base_url('masterdata/ras') ?>">Ras</a>
                </li> -->
                <li>
                    <a class="nav-link" href="<?= base_url('masterdata/hewan') ?>">Hewan</a>
                </li>
                <li>
                    <a class="nav-link" href="<?= base_url('masterdata/obat') ?>">Obat</a>
                </li>
                <li>
                    <a class="nav-link" href="<?= base_url('masterdata/user') ?>">User</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="nav-link" href="<?= base_url('pendaftaran') ?>"><i class="fa-solid fa-book"></i> <span>Pendaftaran Baru</span></a>
        </li>
        <li>
            <a class="nav-link" href="<?= base_url('daftar-booking') ?>"><i class="fa-solid fa-book"></i> <span>Data Booking</span></a>
        </li>
        <li class="dropdown">
            <a class="nav-link has-dropdown" href="#">
                <i class="fa-solid fa-gear"></i> <span>Pengaturan</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="<?= base_url('setting/profile') ?>">Profile</a>
                </li>
            </ul>
        </li>
    <?php } ?>


    <?php if (session()->get('role_name') == 'dokter') { ?>
        <li class="dropdown">
            <a class="nav-link has-dropdown" href="#">
                <i class="fa-solid fa-house"></i> <span>Masterdata</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="<?= base_url('masterdata/obat') ?>">Obat</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="nav-link" href="<?= base_url('daftar-booking') ?>"><i class="fa-solid fa-book"></i> <span>Data Booking</span></a>
        </li>
        <li class="dropdown">
            <a class="nav-link has-dropdown" href="#">
                <i class="fa-solid fa-book"></i> <span>Rekam Medis</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="<?= base_url('rekam-medis/input') ?>">Input Rekam Medis</a>
                </li>
                <li>
                    <a class="nav-link" href="<?= base_url('rekam-medis/view') ?>">List Rekam Medis</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="nav-link has-dropdown" href="#">
                <i class="fa-solid fa-gear"></i> <span>Pengaturan</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="<?= base_url('setting/profile') ?>">Profile</a>
                </li>
            </ul>
        </li>
    <?php } ?>

    <?php if (session()->get('role_name') == 'kasir') { ?>
        <li class="dropdown">
            <a class="nav-link has-dropdown" href="#">
                <i class="fa-solid fa-book"></i> <span>Rekam Medis</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="<?= base_url('rekam-medis/pembayaran') ?>">Pembayaran</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="nav-link has-dropdown" href="#">
                <i class="fa-solid fa-gear"></i> <span>Pengaturan</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="<?= base_url('setting/profile') ?>">Profile</a>
                </li>
            </ul>
        </li>
    <?php } ?>

    <?php if (session()->get('role_name') == 'customer') { ?>
        <li><a class="nav-link" href="<?= base_url('form-booking') ?>"><i class="fa-solid fa-house"></i> <span>Form Booking</span></a></li>

        <li class="dropdown">
            <a class="nav-link has-dropdown" href="#">
                <i class="fa-solid fa-gear"></i> <span>Pengaturan</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="<?= base_url('setting/profile') ?>">Profile</a>
                </li>
            </ul>
        </li>
    <?php } ?>
</ul>
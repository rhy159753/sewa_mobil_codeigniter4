<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-car"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sewa Mobil</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item <?= $data == 'dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    
    
    <?php if ($level == 'admin') { ?>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Master Mobil
    </div>
        <li class="nav-item <?= $data == 'merk' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('merk') ?>">
            <i class="fas fa-fw fa-columns"></i>
            <span>Data Merk</span>
        </a>
    </li>
    <li class="nav-item <?= $data == 'mobil' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('mobil') ?>">
            <i class="fas fa-fw fa-car-alt"></i>
            <span>Data Mobil</span>
        </a>
    </li>
    
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Master User
    </div>

    <li class="nav-item <?= $data == 'user' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('user') ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Data User</span>
        </a>
    </li>
    
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Master Pesanan
    </div>

    <li class="nav-item <?= $data == 'pesanan' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('pesanan') ?>">
            <i class="fas fa-fw fa-receipt"></i>
            <span>Data Pesanan</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Lain - Lain
    </div>

    <li class="nav-item <?= $data == 'jenis_bayar' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('jenis_bayar') ?>">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Jenis Pembayaran</span>
        </a>
    </li>
    <?php } else { ?>

    <li class="nav-item <?= $data == 'mobil' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('mobil') ?>">
            <i class="fas fa-fw fa-car-alt"></i>
            <span>Data Mobil</span>
        </a>
    </li>
    
    
    <li class="nav-item <?= $data == 'pesanan' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('riwayat_pesanan') ?>">
            <i class="fas fa-fw fa-receipt"></i>
            <span>Riwayat Pesanan</span>
        </a>
    </li>
    <?php } ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Penjualan Sepatu</div> 
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Looping Menu-->
    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('member/sepatu/'); ?>">
            <i class="fa fa-fw fa-store"></i>
            <span>Data Sepatu</span></a>
    </li>    
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('member/kategori'); ?>">
            <i class="fa fa-fw fa-tags"></i>
            <span>Data Kategori Sepatu</span></a>
    </li>    
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('size/showOrAddSize'); ?>">
            <i class="fa fa-fw fa-shoe-prints"></i>
            <span>Data Ukuran Sepatu</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('anggota/index'); ?>">
            <i class="fa fa-fw fa-users"></i>
            <span>Data Anggota</span></a>
    </li>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider mt-3">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -- >
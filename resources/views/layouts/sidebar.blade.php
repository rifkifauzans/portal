<!-- Move the inline styles to a separate CSS file or <style> block -->
<style>
    .fixedstyle {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9;
    }
    #content-wrapper {
        margin-left: 14rem;
    }
    .bg-gradient-primarys {
        background-color: #fff;
        background-image: linear-gradient(180deg, #4e73df 10%, #4e73df 100%);
        background-size: cover;
    }
    .sidebar-dark .nav-item .nav-link, .sidebar-dark .nav-item .nav-link i, .sidebar-dark .sidebar-brand {
        color: #fff!important;
    }
    .sidebar-dark .nav-item .nav-link:hover, .sidebar-dark .nav-item .nav-link i:hover {
        color: #1cc88a!important;
    }
    .sidebar-dark .nav-item.active .nav-link, .sidebar-dark .nav-item.active .nav-link i {
        color: #1cc88a!important;
    }
    .sidebar-dark hr.sidebar-divider {
        border-top: 1px solid rgba(0, 0, 0, .15);
        margin-bottom: 0;
    }
    .topbar {
        /* height: 4.375rem; */
        position: fixed;
        right: 0;
        left: 0;
        top: 0;
        z-index: 1;
    }
    .container-fluid {
        margin-top: 5.5rem;
    }
</style>
<?php 
    use \App\Http\Controllers\UserController;
    $userid = auth()->user()->id;
    $datauser  =  UserController::getdatausers($userid);
    $role = $datauser[0]->NAMAROLE;
?>
<ul class="fixedstyle navbar-nav bg-gradient-primarys sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}/">
        <div class="sidebar-brand-icon" style="width: 30%;">
            <img src="{{url('/')}}/ptpn.png" alt="Logo" style="width: 100%;">
        </div>
        <div class="sidebar-brand-text">
            Regional 2
        </div>
    </a>

    <!-- Divider -->
    <!-- Divider
    <hr class="sidebar-divider">
    <li class="nav-item <?php echo Request::is('dash/stakeholder') ? 'active' : ''; ?>">
        <a class="nav-link" href="{{url('/')}}/dash/stakeholder">
            <i class="fas fa-fw fa-book"></i>
            <span>Master Data Karyawan</span>
        </a>
    </li>
    
    <hr class="sidebar-divider">
    <li class="nav-item <?php echo Request::is('dash/a') ? 'active' : ''; ?>">
        <a class="nav-link" href="{{url('/')}}/dash/a">
            <i class="fas fa-fw fa-list"></i>
            <span>Teh Relasi</span>
        </a>
    </li>
    
    <hr class="sidebar-divider">
    <li class="nav-item <?php echo Request::is('dash/b') ? 'active' : ''; ?>">
        <a class="nav-link" href="{{url('/')}}/dash/b">
            <i class="fas fa-fw fa-map-pin"></i>
            <span>Perjalanan Dinas</span>
        </a>
    </li>-->
    <!-- Divider 
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-box"></i>
        <span>Dokumen</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{url('/')}}/dokumen/perizinan"><i class="fas fa-fw fa-file"></i> Perizinan</a>
                <a class="collapse-item" href="{{url('/')}}/dokumen/sertifikasi"><i class="fas fa-fw fa-certificate"></i> Sertifikasi</a>
                <a class="collapse-item" href="{{url('/')}}/dokumen/perjanjiankerjasama"><i class="fas fa-fw fa-table"></i> Perjanjian Kerjasama</a>
                <a class="collapse-item" href="{{url('/')}}/dokumen/mou"><i class="fas fa-fw fa-newspaper"></i> Nota Kesepahaman</a>
            </div>
        </div>
    </li>           
    -->
    <!-- Divider -->
    
    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterData"
        aria-expanded="true" aria-controls="collapseMasterData">
        <i class="fas fa-fw fa-bars"></i>
        <span>Teh Relasi</span>
        </a>
        <div id="collapseMasterData" class="collapse" aria-labelledby="headingMasterData" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            @if( $role=="TehRelasiPengajuan")
                <a class="collapse-item" href="{{url('/')}}/tehrelasi/pengajuan"><i class="fas fa-fw fa-folder"></i> Pengajuan</a>
                <a class="collapse-item" href="{{url('/')}}/tehrelasi/daftarpengajuan"><i class="fas fa-fw fa-folder"></i> Daftar Pengajuan</a>
            @endif
            @if( $role=="TehRelasiPengajuan_Sekper")
                <a class="collapse-item" href="{{url('/')}}/tehrelasi/pengajuan"><i class="fas fa-fw fa-folder"></i> Pengajuan</a>
                <a class="collapse-item" href="{{url('/')}}/tehrelasi/verifikasi"><i class="fas fa-fw fa-folder"></i> Verifikasi</a>
                <a class="collapse-item" href="{{url('/')}}/tehrelasi/daftarpengajuan"><i class="fas fa-fw fa-folder"></i> Data Pengajuan</a>
            @endif
            </div>
        </div>
    </li>       

     <!-- Divider -->

     <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
        aria-expanded="true" aria-controls="collapseUser">
        <i class="fas fa-fw fa-bars"></i>
        <span>User Management</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingMasterData" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{url('/')}}/user/indexUsers"><i class="fas fa-fw fa-folder"></i> User Management</a>
            </div>
        </div>
    </li> 

    <hr class="sidebar-divider">
    <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReferensi"
        aria-expanded="true" aria-controls="collapseReferensi">
        <i class="fas fa-fw fa-bars"></i>
        <span>Referensi</span>
    </a>
    <div id="collapseReferensi" class="collapse" aria-labelledby="headingMasterData" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{url('/')}}/referensi/bagian"><i class="fas fa-fw fa-folder"></i> Bagian</a>
            <a class="collapse-item" href="{{url('/')}}/referensi/urusan"><i class="fas fa-fw fa-folder"></i> Urusan</a>
            <a class="collapse-item" href="{{url('/')}}/referensi/role"><i class="fas fa-fw fa-folder"></i> Role</a>
        </div>
    </div>
</li>



    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item <?php echo Request::is('func_logout') ? 'active' : ''; ?>">
        <a class="nav-link" href="{{url('/')}}/func_logout">
            <i class="fas fa-sign-out-alt"></i>
            <span>Keluar aaa</span>
        </a>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Nav Item - Utilities Collapse Menu -->


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->


    <!-- Nav Item - Pages Collapse Menu -->


    <!-- Nav Item - Charts -->


    <!-- Nav Item - Tables -->


    <!-- Divider -->

    <!-- Sidebar Message -->
    <?php 
        $membercount = DB::table('users_login')
        ->where('hakakses','like','%member%')
        ->count();
        $admincount = DB::table('users_login')
        ->where('hakakses','like','%admin%')
        ->count();
    ?>
    <div class="sidebar-card d-none d-lg-flex" style="margin-top: 1rem; background-color: rgb(41 236 58 / 38%);">
        <p class="text-center mb-2" style="font-size:1.1em; color:#000; margin-bottom: 0 !important;"><strong >Team Member<br>{{$membercount}}</strong></p>
    </div>
    @if(Auth::user()->hakakses =='Admin')
    <div class="sidebar-card d-none d-lg-flex" style="background-color: rgb(229 41 236 / 38%);">
        <p class="text-center mb-2" style="font-size:1.1em; color:#000; margin-bottom: 0 !important;"><strong >Admin<br>{{$admincount}}</strong></p>
    </div>
    @endif
</ul>
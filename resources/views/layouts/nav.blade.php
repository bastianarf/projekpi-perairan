<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <h4 align="center" style="color: white">{{ $user->role }}</h4>
    <hr style="border: 1px solid white; width:100%">
    <a class="nav-link text-white{{ request()->is('Dashboard') ? ' active' : '' }}" href="{{ Route('Dashboard') }}"
        role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-th"></i>&nbsp; Dashboard</a>
    

    <!-- ROLE UNTUK OPSI DATA PEGAWAI -->
    @if ($user->role_check(['Staff','Kepala Bidang', 'Kepala Seksi']))

    <a class="nav-link text-white{{ request()->is('Pegawai') ? ' active' : '' }}" href="{{ Route('Pegawai') }}"
        role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-users"></i>&nbsp; Pegawai</a>
    @endif
    
    <!-- ROLE UNTUK OPSI DATA SURAT YANG TELAH DIBUAT -->
    @if ($user->role_check(['Kepala Bidang']))
    <a class="nav-link text-white{{ request()->is('Surat') ? ' active' : '' }}" href="{{ Route('Surat') }}"
        role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-envelope"></i>&nbsp; Surat </a>
    @endif
    
    <!-- ROLE UNTUK OPSI SPPD -->
    @if($user->role_check(['Staff', 'Kepala Seksi', 'Admin', 'Sekretaris Bidang']))
    
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse" data-target="#SPPD"
        aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-envelope"></i>&nbsp; SPPD</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('SPPD/Entry') ? ' show' : '' }}{{ request()->is('SPPD') ? ' show' : '' }}" id="SPPD">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('SPPD/Entry') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('EntrySPPD') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-users"></i>
                        &nbsp; Tambah SPPD
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('SPPD') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('SPPD') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-envelope"></i>
                        &nbsp; SPPD
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
 
    <!--
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse" data-target="#Kwitansi"
        aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-envelope"></i>&nbsp; Kwitansi</a> 
        <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Kwitansi/Entry') ? ' show' : '' }}{{ request()->is('Kwitansi') ? ' show' : '' }}" id="Kwitansi">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Kwitansi/Entry') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('EntryKwitansi') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-users"></i>
                        &nbsp; Tambah Kwitansi
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Kwitansi') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Kwitansi') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-envelope"></i>
                        &nbsp; Kwitansi
                    </a>
                </div>
            </div>
        </div>
    </div>       -->

    <!-- ROLE UNTUK OPSI ADMINISTRATOR -->
    @if ($user->role_check(['Admin']))

    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Administrator" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-key"></i>&nbsp;
        Administrator</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Admin/Show') ? ' show' : '' }} {{ request()->is('Admin/Setting') ? ' show' : '' }} {{ request()->is('Admin/SPPD') ? ' show' : '' }}"
                id="Administrator">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Admin/Show') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-users"></i>
                        &nbsp; Data Users
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/SPPD') ? ' bg-white' : ' text-white' }}" href="{{ Route('AdminSPPD') }}"
                        role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <i class="fa fa-envelope"></i>
                        &nbsp; Data SPPD
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Setting') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Setting') }}" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <i class="fa fa-cog"></i>
                        &nbsp; Pengaturan
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
    <a class="nav-link text-white{{ request()->is('Users/Profile') ? ' active' : '' }}"
        href="{{ Route('Users/Profile') }}" role="tab" aria-controls="v-pills-home" aria-selected="true"><i
            class="fa fa-user">
        </i>
        &nbsp; Profile
    </a>
</div>
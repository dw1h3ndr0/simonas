<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ asset(route('home', [], false)) }}">
        <div class="sidebar-brand-icon">
          {{-- <i class="fab fa-watchman-monitoring"></i> --}}
          <img class="img-profile " src="{{asset('assets/img/simonas.png')}}">
        </div>
        <div class="sidebar-brand-text mx-3">Simonas</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{ asset(route('home', [], false)) }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Menu Petugas
      </div>

      <!-- Nav Item - Listing Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseListing" aria-expanded="true" aria-controls="collapseListing">
          <i class="fas fa-clipboard-list "></i>
          <span>Listing</span>
        </a>
        <div id="collapseListing" class="collapse" aria-labelledby="headingListing" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Listing Rumah Tangga</h6>
            <a class="collapse-item" href="{{ asset(route('listing.progres', [], false)) }}">Progres</a>
            <a class="collapse-item" href="{{ asset(route('listing.input', [], false)) }}">Input</a>
            <a class="collapse-item" href="{{ asset(route('listing', [], false)) }}">Daftar Listing</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pencacahan Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePencacahan" aria-expanded="true" aria-controls="collapsePencacahan">
          <i class="fas fa-address-book"></i>
          <span>Pencacahan</span>
        </a>
        <div id="collapsePencacahan" class="collapse" aria-labelledby="headingPencacahan" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Sampel Rumah Tangga</h6>
            <a class="collapse-item" href="{{ asset(route('sampel.progres', [], false)) }}">Progres</a>
            <a class="collapse-item" href="{{ asset(route('sampel.input', [], false)) }}">Input</a>
            <a class="collapse-item" href="{{ asset(route('sampel', [], false)) }}">Daftar Pencacahan</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pemasukan Dokumen Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDokumen" aria-expanded="true" aria-controls="collapseDokumen">
          <i class="fas fa-file"></i>
          <span>Dokumen</span>
        </a>
        <div id="collapseDokumen" class="collapse" aria-labelledby="headingDokumen" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pemasukan Dokumen</h6>
            <a class="collapse-item" href="{{ asset(route('dokumen.progres', [], false)) }}">Progres</a>
            <a class="collapse-item" href="{{ asset(route('dokumen.input', [], false)) }}">Input</a>
            <a class="collapse-item" href="{{ asset(route('dokumen', [], false)) }}">Daftar Dokumen</a>
          </div>
        </div>
      </li>


      @if(auth()->user()->role == 'admin')  

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Menu Admin
      </div>

      <!-- Nav Item - Petugas Collapse Menu -->
      {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePetugas" aria-expanded="true" aria-controls="collapsePetugas">
          <i class="fas fa-users"></i>
          <span>Petugas</span>
        </a>
        <div id="collapsePetugas" class="collapse" aria-labelledby="headingPetugas" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pengelolaan Petugas</h6>
            <a class="collapse-item" href="{{ asset(route('supervisor', [], false)) }}">Supervisor</a>
            <a class="collapse-item" href="{{ asset(route('petugas', [], false)) }}">Petugas</a>          
          </div>
        </div>
      </li> --}}
      
      <!-- Nav Item - Petugas -->
      <li class="nav-item">
        <a class="nav-link" href="{{ asset(route('petugas', [], false)) }}">
          <i class="fas fa-users fa-fw"></i>
          <span>Petugas</span></a>
      </li>

      <!-- Nav Item - DSBS Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDSBS" aria-expanded="true" aria-controls="collapseDSBS">
          <i class="fas fa-file-alt"></i>
          <span>DSBS</span>
        </a>
        <div id="collapseDSBS" class="collapse" aria-labelledby="headingDSBS" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Daftar Sampel Blok Sensus</h6>
            <a class="collapse-item" href="{{ asset(route('dsbs.tambah', [], false)) }}">Input</a>
            <a class="collapse-item" href="{{ asset(route('dsbs', [], false)) }}">Daftar DSBS</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Alokasi Petugas Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAlokasi" aria-expanded="true" aria-controls="collapseAlokasi">
          <i class="fas fa-file-alt"></i>
          <span>Alokasi</span>
        </a>
        <div id="collapseAlokasi" class="collapse" aria-labelledby="headingAlokasi" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Alokasi Petugas</h6>
            <a class="collapse-item" href="{{ asset(route('alokasi.tambah', [], false)) }}">Input</a>
            <a class="collapse-item" href="{{ asset(route('alokasi', [], false)) }}">Daftar Alokasi</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Rekap Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRekap" aria-expanded="true" aria-controls="collapseRekap">
          <i class="fas fa-fw fa-folder"></i>
          <span>Rekap</span>
        </a>
        <div id="collapseRekap" class="collapse" aria-labelledby="headingRekap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Rekapitulasi</h6>
            <a class="collapse-item" href="{{ asset(route('rekap.listing', [], false)) }}">Listing</a>
            <a class="collapse-item" href="{{ asset(route('rekap.sampel', [], false)) }}">Pencacahan</a>
            <a class="collapse-item" href="{{ asset(route('rekap.dokumen', [], false)) }}">Dokumen</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pesan -->
      <li class="nav-item">
        <a class="nav-link" href="{{ asset(route('pesan', [], false)) }}">
          <i class="fas fa-envelope fa-fw"></i>
          <span>Pesan</span></a>
      </li>

      @endif

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
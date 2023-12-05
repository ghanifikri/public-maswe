<ul class="navbar-nav bg-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @can('menage_orders')
    <li class="nav-item {{ Request::is('dashboard/order*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('order.index') }}">
            <i class="fas fa-fw fa-wallet"></i>
            <span>Order</span></a>
    </li>
    @endcan


    <!-- Divider -->
    <hr class="sidebar-divider">
    @can('menage_homePage')
    <!-- Heading -->
        <div class="sidebar-heading">
            Home Page
        </div>

        <!-- Nav Item - Video header -->
        <li class="nav-item {{ Request::is('dashboard/header-video*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('header-video.index') }}">
                <i class="fas fa-fw fa-video"></i>
                <span>Header video</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item {{ Request::is('dashboard/abouts*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('about.index') }}">
                <i class="fas fa-fw fa-briefcase"></i>
                <span>About</span></a>
        </li>

        <li class="nav-item {{ Request::is('dashboard/news*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#news" aria-expanded="true"
                aria-controls="news">
                <i class="fas fa-fw fa-newspaper"></i>
                <span>News</span>
            </a>
            <div id="news" class="collapse {{ Request::is('dashboard/news*') ? 'show' : '' }}" aria-labelledby="headingTwo"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Request::is('dashboard/news/title*') ? 'active' : '' }}"
                        href="{{ route('title.index') }}">Title</a>
                    <a class="collapse-item {{ Request::is('dashboard/news/categories*') ? 'active' : '' }}"
                        href="{{ route('categories.index') }}">Kategori</a>
                    <a class="collapse-item {{ Request::is('dashboard/news/post*') ? 'active' : '' }}"
                        href="{{ route('post.index') }}">Post</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{ Request::is('dashboard/area*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('aboutKaligandu.index') }}">
                <i class="fas fa-fw fa-building"></i>
                <span>About Area</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
    @endcan

    @can('menage_aboutPage')
        <!-- Heading -->
        <div class="sidebar-heading">
            About us Page
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ Request::is('dashboard/aboutPage/history*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#history" aria-expanded="true"
                aria-controls="history">
                <i class="fas fa-fw fa-history"></i>
                <span>History</span>
            </a>
            <div id="history" class="collapse {{ Request::is('dashboard/aboutPage/history*') ? 'show' : '' }}"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Request::is('dashboard/aboutPage/history/heroSection*') ? 'active' : '' }}"
                        href="{{ route('heroHistory.index') }}">Hero Section</a>
                    <a class="collapse-item {{ Request::is('dashboard/aboutPage/history/aboutMaswe*') ? 'active' : '' }}"
                        href="{{ route('aboutMaswe.index') }}">About Maswe</a>
                    <a class="collapse-item {{ Request::is('dashboard/aboutPage/history/longHistories*') ? 'active' : '' }}"
                        href="{{ route('longHistory.index') }}">Long History</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item {{ Request::is('dashboard/aboutPage/valuesAndPeople*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-university"></i>
                <span>Values & People</span>
            </a>
            <div id="collapseUtilities"
                class="collapse {{ Request::is('dashboard/aboutPage/valuesAndPeople*') ? 'show' : '' }}"
                aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Request::is('dashboard/aboutPage/valuesAndPeople/heroSection*') ? 'active' : '' }}"
                        href="{{ route('valuesPeople.index') }}">Hero Section</a>
                    <a class="collapse-item {{ Request::is('dashboard/aboutPage/valuesAndPeople/sectionHeader*') ? 'active' : '' }}"
                        href="{{ route('headerPeople.index') }}">Header Section</a>
                    <a class="collapse-item {{ Request::is('dashboard/aboutPage/valuesAndPeople/founder*') ? 'active' : '' }}"
                        href="{{ route('founder.index') }}">Founder - CoFounder</a>
                    <a class="collapse-item {{ Request::is('dashboard/aboutPage/valuesAndPeople/people*') ? 'active' : '' }}"
                        href="{{ route('people.index') }}">People</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{ Request::is('dashboard/aboutPage/field*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#field" aria-expanded="true"
                aria-controls="field">
                <i class="fas fa-fw fa-swatchbook"></i>
                <span>Our Field</span>
            </a>
            <div id="field" class="collapse  {{ Request::is('dashboard/aboutPage/field*') ? 'show' : '' }}"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Request::is('dashboard/aboutPage/field/heroSection*') ? 'active' : '' }}"
                        href="{{ route('heroField.index') }}">Hero Section</a>
                    <a class="collapse-item {{ Request::is('dashboard/aboutPage/field/sectionHeaderFasilitas*') ? 'active' : '' }}"
                        href="{{ route('headerFieldFasilitas.index') }}">Header Fasilitas Produksi</a>
                    <a class="collapse-item {{ Request::is('dashboard/aboutPage/field/fasilitasProduksi*') ? 'active' : '' }}"
                        href="{{ route('fasilitasProduksi.index') }}">Fasilitas Produksi</a>
                    <a class="collapse-item {{ Request::is('dashboard/aboutPage/field/kapasitasProduksi*') ? 'active' : '' }}"
                        href="{{ route('kapasitasProduksi.index') }}">Kapitas Produksi</a>
                    <a class="collapse-item {{ Request::is('dashboard/aboutPage/field/sectionHeaderTeam*') ? 'active' : '' }}"
                        href="{{ route('headerTeam.index') }}">Header Team</a>
                    <a class="collapse-item {{ Request::is('dashboard/aboutPage/field/teams*') ? 'active' : '' }}"
                        href="{{ route('teams.index') }}">Teams</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{ Request::is('dashboard/aboutPage/research*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#research" aria-expanded="true"
                aria-controls="research">
                <i class="fas fa-fw fa-search"></i>
                <span>Research</span>
            </a>
            <div id="research" class="collapse {{ Request::is('dashboard/aboutPage/research*') ? 'show' : '' }}"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Request::is('dashboard/aboutPage/research/heroSection*') ? 'active' : '' }}"
                        href="{{ route('heroResearch.index') }}">Hero Section</a>
                    <a class="collapse-item {{ Request::is('dashboard/aboutPage/research/headerResearch*') ? 'active' : '' }}"
                        href="{{ route('headerResearch.index') }}">Header Research</a>
                    <a class="collapse-item {{ Request::is('dashboard/aboutPage/research/dataResearch*') ? 'active' : '' }}"
                        href="{{ route('dataResearch.index') }}">Data Research</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
    @endcan
    
    @can('menage_productPage')
          <!-- Heading -->
        <div class="sidebar-heading">
            Product Page
        </div>
        <!-- Nav Item - Charts -->
        <li class="nav-item {{ Request::is('dashboard/productPage/heroSection*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('productHero.index') }}">
                <i class="fas fa-fw fa-link"></i>
                <span>Hero Section</span></a>
        </li>
        <!-- Nav Item - Charts -->
        <li class="nav-item {{ Request::is('dashboard/productPage/attribute*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('attribute.index') }}">
                <i class="fas fa-fw fa-link"></i>
                <span>Atribut</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item {{ Request::is('dashboard/productPage/product*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('prod.index') }}">
                <i class="fas fa-fw fa-box"></i>
                <span>Produk</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
    @endcan
  
    @can('menage_galleryPage')
        <!-- Heading -->
        <div class="sidebar-heading">
            Gallery Page
        </div>
        <!-- Nav Item - Charts -->
        <li class="nav-item {{ Request::is('dashboard/galleryPage/hero*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('galleryHero.index') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Hero Section</span></a>
        </li>
        <li class="nav-item {{ Request::is('dashboard/galleryPage/gallery*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dataGallery.index') }}">
                <i class="fas fa-fw fa-images"></i>
                <span>Gallery</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

    @endcan

    @can('menage_messagePage')
        <!-- Heading -->
        <div class="sidebar-heading">
            Message Page
        </div>
        <li class="nav-item {{ Request::is('dashboard/messagePage/heroSection*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('messageHero.index') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Hero Section</span></a>
        </li>
        <li class="nav-item {{ Request::is('dashboard/messagePage/message*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('message.index') }}">
                <i class="fas fa-fw fa-envelope"></i>
                <span>Message</span></a>
        </li>

        <hr class="sidebar-divider">
    @endcan

    <!-- Heading -->
    <div class="sidebar-heading">
        Settings
    </div>

    @can('menage_roles')
    <li class="nav-item {{ Request::is('dashboard/permissionPage/role*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('role.index') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Role</span></a>
    </li>
    @endcan

    @can('menage_users')
    <li class="nav-item {{ Request::is('dashboard/permissionPage/user*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>User</span></a>
    </li>

    
    @endcan

    <li class="nav-item">
        <a class="nav-link" href="{{ route('file-manager') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>File Manager</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

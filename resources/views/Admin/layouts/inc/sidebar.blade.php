<!-- ========== App Menu ========== -->

<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{route('admin.index')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{get_file(setting()->logo_header)}}" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="{{get_file(setting()->logo_header)}}" alt="" height="40">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="{{route('admin.index')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{get_file(setting()->logo_header)}}" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="{{get_file(setting()->logo_header)}}" alt="" height="40">
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('admin.index')}}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                        </a>
                    </li> <!-- end Dashboard Menu -->



                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('admins.index')}}">
                        <i class="fa fa-user-secret"></i> <span data-key="t-dashboards">Admins</span>
                    </a>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('settings.index')}}">
                        <i class="fa fa-cog" aria-hidden="true"></i> <span data-key="t-dashboards">Setting </span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('category_rents.index')}}">
                        <i class="fa fa-list-alt"></i> <span data-key="t-dashboards">Category Rents</span>
                    </a>
                </li> <!-- end Dashboard Menu -->



                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('expense_categories.index')}}">
                        <i class="fa fa-usd"></i> <span data-key="t-dashboards"> Expense Categories</span>
                    </a>
                </li> <!-- end Dashboard Menu -->




                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('roomsfeatures.index')}}">
                        <i class="fa-solid fa-hotel"></i> <span data-key="t-dashboards">Rooms Features</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('roomcategory.index')}}">
                        <i class="fa-solid fa-hotel"></i> <span data-key="t-dashboards">Rooms Category</span>
                    </a>
                </li> <!-- end Dashboard Menu -->



                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('governorates.index')}}">
                        <i class="fa fa-map"></i> <span data-key="t-dashboards"> Governorates</span>
                    </a>
                </li> <!-- end Dashboard Menu -->



                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('rent_places.index')}}">
                        <i class="fa fa-map-marker"></i> <span data-key="t-dashboards"> Rent Places</span>
                    </a>
                </li> <!-- end Dashboard Menu -->










                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('clients.index')}}">
                        <i class="fa fa-user"></i> <span data-key="t-dashboards"> Clients</span>
                    </a>
                </li> <!-- end Dashboard Menu -->








                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('hotels.index')}}">
                        <i class="fa-solid fa-hotel"></i> <span data-key="t-dashboards">Hotels</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('rooms.index')}}">
                        <i class="fa-solid fa-hotel"></i> <span data-key="t-dashboards"> Rooms</span>
                    </a>
                </li> <!-- end Dashboard Menu -->



                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('booking.index')}}">
                        <i class="fa fa-ticket"></i> <span data-key="t-dashboards"> Booking</span>
                    </a>
                </li> <!-- end Dashboard Menu -->




                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('expenses.index')}}">
                        <i class="fa fa-usd"></i> <span data-key="t-dashboards"> Expenses</span>
                    </a>
                </li> <!-- end Dashboard Menu -->




            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>



<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        @php
            $settings = DB::table('settings')->first();
        @endphp
        <img src="{{ asset($settings->favicon) }}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://www.w3schools.com/w3images/avatar6.png" class="img-circle elevation-2">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false" id="navabar-menu">
                <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item" id="category">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Category
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('subcategory.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('childcategory.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Child Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('brand.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Brand</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('warehouse.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Warehouse</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" id="product">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Product
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" id="offer">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Offer
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('coupon.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Coupon</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('campaign.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>E Campaign</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" id="order">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Orders
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('order.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Orders</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" id="pickup_point">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Pickup Point
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pickup.point.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pickup Point</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" id="ticket">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Ticket
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('ticket.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ticket</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" id="settings">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('seo.setting') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SEO Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('website.setting') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Website Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('page.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Page Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('smtp.setting') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SMTP Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('payment.gateway') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payment Gateway</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">PROFILE</li>
                <li class="nav-item">
                    <a href="{{ route('admin.password.change') }}" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">Password Change</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

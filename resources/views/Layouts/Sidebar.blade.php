<div class="app-sidebar colored">
    <div class="sidebar-header" style="background-color: #ffffff;">
        <a class="header-brand" href="">
            <div class="logo-img">
                <img src="{{ asset('uploads/Logo/Scoto.png') }}" alt="Logo" style="max-width: 200px;">
            </div>
        </a>
    </div>

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item active">
                    <a href=""><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                </div>
                <div class="nav-item has-sub">
                    <a href="javascript:void(0)"><i class="ik ik-grid"></i><span>Master</span></a>
                    <div class="submenu-content">
                        <a href="{{ route('category.index') }}" class="menu-item">Add Category</a>
                        <a href="{{ route('Product_Type.View_Pro_Type') }}" class="menu-item">Add Product Type</a>
                        <a href="{{ route('Item.View_Item') }}" class="menu-item">Add Item</a>
                        <a href="{{ route('Supplier.View_Supplier') }}" class="menu-item">Add Supplier</a>
                        <!-- <a href="{{ route('Current_Rate.View_Current_Rate') }}" class="menu-item">Add Current Rate</a> -->
                    </div>
                </div>
                <div class="nav-item has-sub">
                    <a href="javascript:void(0)"><i class="ik ik-repeat"></i><span>Transaction</span></a>
                    <div class="submenu-content">
                        <a href="{{ route('Stock.Stock_Inward')}}" class="menu-item">Stock Inward</a>
                        <a href="{{ route('Stock.Stock_Purchase') }}" class="menu-item">
                            Purchase Ornaments
                        </a>
                    </div>
                </div>
                <!-- <div class="nav-item">
                            <a href=""><i class="ik ik-menu"></i><span>Contact</span></a>
                        </div>

                        <div class="nav-item">
                            <a href=""><i class="ik ik-menu"></i><span>Admin User</span></a>
                        </div> -->


                <!-- <div class="nav-item has-sub">
                            <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Assign Follow Person</span></a>
                            <div class="submenu-content">
                                <a href="" class="menu-item">Assign Follow Up Person</a>
                                <a href="" class="menu-item">Assign Follow Up Lead</a>
                            </div>
                        </div>

                        <div class="nav-item has-sub">
                            <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Events</span></a>
                            <div class="submenu-content">
                                <a href="" class="menu-item">Create Event</a>
                                <a href="" class="menu-item">Event Order Add</a>
                                <a href="" class="menu-item">Event Order Payments</a>
                                <a href="" class="menu-item">Event Order Update</a>
                            </div>
                        </div> -->

                <!-- <div class="nav-item has-sub">
                            <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Follow Up</span></a>
                            <div class="submenu-content">
                                <a href="" class="menu-item">Follow Calls</a>
                                <a href="" class="menu-item">Follow Meeting</a>

                            </div>
                        </div> -->

                <div class="nav-item has-sub">
                    <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Reports</span></a>
                    <div class="submenu-content">
                        <!-- <a href="" class="menu-item">Follow Calls</a>
                                <a href="" class="menu-item">Follow Meeting</a> -->

                    </div>
                </div>

            </nav>
        </div>
    </div>
</div>
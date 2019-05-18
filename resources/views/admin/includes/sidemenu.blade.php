@php
$url = \Request::path();
$exp = explode('/', $url);
$menu = $exp[0];
@endphp
<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset ( 'public/plugins/Themes/AdminLTE/dist/img/user2-160x160.jpg' ) }}" class="img-circle" alt="">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="javascript:void(0);"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li <?= $menu == '' ? 'class="active"' : '' ?>>
                <a href="{{ url ( '/' ) }}">
                    <i class="fa fa-th"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green"></small>
                    </span>
                </a>
            </li>
            <li <?= $menu == 'dealers' || $menu == 'dealer' ? 'class="active"' : '' ?>>
                <a href="{{ url('/dealers') }}">
                    <i class="fa fa-users" aria-hidden="true"></i> <span>Dealers</span>
                </a>
            </li>
            <li class="treeview <?= $menu == 'products' || $menu == 'products' || $menu == 'categories' || $menu == 'sub_categories' || $menu == 'variations' || $menu == 'category' || $menu == 'sub_category' || $menu == 'variation' ? 'active menu-open' : '' ?>">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" <?= $menu == 'products' || $menu == 'products' || $menu == 'categories' || $menu == 'sub_categories' || $menu == 'variations' || $menu == 'category' || $menu == 'sub_category' || $menu == 'variation' ? 'style="display:block;"' : '' ?>>
                    <li <?= $menu == 'products' || $menu == 'products' ? 'class="active"' : '' ?>><a href="{{ url('/products') }}"><i class="fa fa-circle-o text-red"></i>Manage</a></li>
                    <li <?= $menu == 'categories' || $menu == 'category' ? 'class="active"' : '' ?>><a href="{{ url('/categories') }}"><i class="fa fa-circle-o text-red"></i>Categories</a></li>
                    <li <?= $menu == 'sub_categories' || $menu == 'sub_category' ? 'class="active"' : '' ?>><a href="{{ url('/sub_categories') }}"><i class="fa fa-circle-o text-aqua"></i> Warranty</a></li>
                </ul>
            </li>

            <li <?= $menu == 'battery_analysis' || $menu == 'battery_analysis' ? 'class="active"' : '' ?>>
                <a href="{{ url('/battery_analysis') }}"><i class="fa fa-battery-half" aria-hidden="true"></i> <span>Battery Analysis</span>
                </a>
            </li>
            <li <?= $menu == 'battery_complaints' || $menu == 'battery_complaint' ? 'class="active"' : '' ?>>
                <a href="{{ url('/battery_complaints') }}"><i class="fa fa-battery-empty" aria-hidden="true"></i> <span>Battery Complaint</span>
                </a>
            </li>
            <li <?= $menu == 'orders' || $menu == 'order' ? 'class="active"' : '' ?>>
                <a href="{{ url('/orders') }}"><i class="fa fa-first-order" aria-hidden="true"></i> <span>Orders</span>
                </a>
            </li>

            <li <?= $menu == 'points' || $menu == 'point' ? 'class="active"' : '' ?>>
                <a href="{{ url('/points') }}"><i class="fa fa-cubes" aria-hidden="true"></i> <span>Points Management</span>
                </a>
            </li>
            <li <?= $menu == 'promotions' || $menu == 'promotion' ? 'class="active"' : '' ?>>
                <a href="{{ url('/promotions') }}"><i class="fa fa-book"></i> <span>Promotions</span>
                </a>
            </li>
            <li <?= $menu == 'targets' || $menu == 'target' ? 'class="active"' : '' ?>>
                <a href="{{ url('/targets') }}"><i class="fa fa-handshake-o" aria-hidden="true"></i> <span>Targets</span>
                </a>
            </li>
        </ul>
    </section>
</aside>




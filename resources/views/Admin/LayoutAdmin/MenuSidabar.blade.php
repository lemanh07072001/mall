@php
use App\Helper\FormatFunction;

    $getAllCategory = FormatFunction::getCategory();
    $countCategory = count($getAllCategory);
@endphp

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('dashboard.index') }}"
                class="nav-link {{ request()->routeIs('dashboard.*')?'active':''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard

                </p>
            </a>

        </li>
        <li class="nav-item ">
            <a href="pages/widgets.html" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Widgets
                    <span class="right badge badge-danger">New</span>
                </p>
            </a>
        </li>
        <li class="nav-item {{request()->routeIs('category.*')?'menu-open':''}}">
            <a href="#" class="nav-link {{request()->routeIs('category.*')?'active':''}}">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Quản lý danh mục
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">{{$countCategory}}</span>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item ">
                    <a href="{{ route('category.index') }}"
                        class="nav-link {{request()->routeIs(['category.index','category.create','category.edit'])?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Danh sách danh mục</p>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item {{request()->routeIs('slide.*')?'menu-open':''}}">
            <a href="#" class="nav-link {{request()->routeIs('slide.*')?'active':''}}">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Quản lý slide
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item ">
                    <a href="{{ route('slide.index') }}"
                       class="nav-link {{request()->routeIs(['slide.index','slide.create','slide.edit'])?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Danh sách danh mục</p>
                    </a>
                </li>

            </ul>
        </li>
    </ul>
</nav>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Nhân viên </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Thông kê</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{route('user.reader.barcode')}}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Mượn sách</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{route('user.reader.barcode')}}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Trả sách</span>
        </a>
    </li>
</ul>

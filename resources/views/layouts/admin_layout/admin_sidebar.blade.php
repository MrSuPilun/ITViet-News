<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a class="collapsed" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Bảng điều khiển</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item {{ request()->is('admin/base*') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Bài viết</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('admin/base*') ? 'show' : '' }}" id="base">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('admin/base/new-post') ? 'active' : '' }}">
                                <a href="{{ route('admin.newPost') }}">
                                    <span class="sub-item">Tạo bài viết mới</span>
                                </a>
                            </li>
                            @if (request()->is('admin/base/update-post'))
                                <li class="active">
                                    <a href="{{ route('admin.newPost') }}">
                                        <span class="sub-item">Tạo bài viết mới</span>
                                    </a>
                                </li>
                            @endif
                            <li class="{{ request()->is('admin/base/show-post') ? 'active' : '' }}">
                                <a href="{{ route('admin.showPost') }}">
                                    <span class="sub-item">Tất cả bài viết</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-th-list"></i>
                        <p>Tùy chỉnh giao diện</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#">
                                    <span class="sub-item">Sidebar Style 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Bảng dữ liệu</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#">
                                    <span class="sub-item">Thẻ bài viết</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Người dùng</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Quản lý</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>Thống kê</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#">
                                    <span class="sub-item">Chart Js</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Sparkline</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

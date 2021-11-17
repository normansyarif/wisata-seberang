<div class="sidebar-wrapper">
    <ul class="nav">
        
        @can('see-dashboard')
        <li class="{{ (Request::is('dashboard*') ? 'active' : '') }} ">
            <a href="{{ route('dashboard') }}">
                <i class="fa fa-dashboard"></i>
                <p>Dashboard</p>
            </a>
        </li>
        @endcan

        @can('manage-koleksi')
        <li class="{{ (Request::is('koleksi*') ? 'active' : '') }}">
            <a href="{{ route('koleksi.index') }}">
                <i class="fa fa-list"></i>
                <p>Koleksi</p>
            </a>
        </li>
        @endcan

        @can('manage-konten')
        <li class="{{ (Request::is('konten*') ? 'active' : '') }}">
            <a href="{{ route('konten.index') }}">
                <i class="fa fa-list"></i>
                <p>Konten</p>
            </a>
        </li>
        @endcan

        <li class="{{ (Request::is('news*') ? 'active' : '') }}">
            <a href="{{ route('news.index') }}">
                <i class="fa fa-newspaper-o"></i>
                <p>Berita</p>
            </a>
        </li>
    </ul>

    <ul class="nav">
        @can('manage-role')
        <li class="{{ (Request::is('role*') ? 'active' : '') }} ">
            <a href="{{ route('role.index') }}">
                <i class="fa fa-users"></i>
                <p>Role</p>
            </a>
        </li>
        @endcan

        @can('manage-user')
        <li class="{{ (Request::is('user*') ? 'active' : '') }}">
            <a href="{{ route('user.index') }}">
                <i class="fa fa-user"></i>
                <p>Pengguna</p>
            </a>
        </li>
        @endcan
        
    </ul>
</div>

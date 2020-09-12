<aside id="sidebar-wrapper" class="mb-5">
  <div class="sidebar-brand">
    <a href="/">Gudang APP</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="/">APP</a>
  </div>
  <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="{{ Request::route()->getName() == 'dashboard.index' ? ' active' : '' }}"><a class="nav-link" href="{{route('dashboard.index')}}"><i class="fas fa-columns"></i> <span>Dashboard</span></a></li>
  </ul>
  <ul class="sidebar-menu">
    <li class="{{ Request::route()->getName() == 'users.index' ? ' active' : '' }}">
      <a href="{{route('users.index')}}" class="nav-link"><i class="fas fa-users"></i> <span>Users</span></a>
    </li>
  </ul>
</aside>

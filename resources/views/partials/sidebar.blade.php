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
  @if (Auth::user()->role == 'owner')
  <ul class="sidebar-menu">
    <li class="{{ Request::route()->getName() == 'users.index' ? ' active' : '' }}">
      <a href="{{route('users.index')}}" class="nav-link"><i class="fas fa-users"></i> <span>Users</span></a>
    </li>
  </ul>
  @endif
  <ul class="sidebar-menu">
    <li class="{{ Request::route()->getName() == 'gudang.index' ? ' active' : '' }}">
      <a href="{{route('gudang.index')}}" class="nav-link"><i class="fas fa-building"></i> <span>Gudang</span></a>
    </li>
  </ul>
  <ul class="sidebar-menu">
    <li class="{{ Request::route()->getName() == 'barang.index' ? ' active' : '' }}">
      <a href="{{route('barang.index')}}" class="nav-link"><i class="fas fa-box"></i> <span>Barang</span></a>
    </li>
  </ul>
  <ul class="sidebar-menu">
    <li class="{{ Request::route()->getName() == 'transaksi.index' ? ' active' : '' }}">
      <a href="{{route('transaksi.index')}}" class="nav-link"><i class="fas fa-shopping-cart"></i> <span>Transaksi</span></a>
    </li>
  </ul>
</aside>

<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">Logistik-Hanief</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">GL</a>
    </div>
    <ul class="sidebar-menu">
      @if (Auth::user()->role == 'Manager')
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::is('/') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fire"></i>
            <span>Dashboard</span>
          </a>
        </li>
      @endif
      <li class="menu-header">Master Data</li>
      <li class="{{ Request::is('barang-masuk*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/barang-masuk') }}">
          <i class="fas fa-id-badge"></i>
          <span>Barang Masuk</span>
        </a>
      </li>
      <li class="{{ Request::is('barang-keluar*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/barang-keluar') }}">
          <i class="fas fa-id-badge"></i>
          <span>Barang Keluar</span>
        </a>
      </li>
      <li class="{{ Request::is('stok-barang*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/stok-barang') }}">
          <i class="fas fa-book"></i>
          <span>Stok Barang</span>
        </a>
      </li>
    </ul>
  </aside>
</div>

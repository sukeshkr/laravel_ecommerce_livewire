<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item {{Request::is('admin/dashboard') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('admin/category*') ? 'active' : ''}}">
        <a class="nav-link" data-bs-toggle="collapse" href="#category" aria-expanded="{{Request::is('admin/category*') ? 'true' : 'false'}}" aria-controls="ui-basic">
            <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">Category</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{Request::is('admin/category*') ? 'show' : ''}}" id="category">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('admin.category')}}">Add Category</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('admin.category')}}">View Category</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{Request::is('admin/product*') ? 'active' : ''}}">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-product" aria-expanded="false" aria-controls="ui-product">
            <i class="mdi mdi mdi-calendar-plus menu-icon"></i>
          <span class="menu-title">Products</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-product">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('admin.product')}}">Add Products</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('admin.product')}}">View Products</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{Request::is('admin/brands') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('brands')}}">
          <i class="mdi mdi-apple-finder menu-icon"></i>
          <span class="menu-title">Brands</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('admin/colors*') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('colors')}}">
          <i class="mdi mdi-apple-finder menu-icon"></i>
          <span class="menu-title">Colors</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('admin/slider*') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('admin.slider')}}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Home Slider</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('admin/orders*') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('admin.orders')}}">
          <i class="mdi mdi-emoticon menu-icon"></i>
          <span class="menu-title">Orders</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('admin/users*') ? 'active' : ''}}">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">User Settings</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('user')}}"> Add User </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> View User </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{Request::is('admin/site-settings') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('site.settings')}}">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Site Settings</span>
        </a>
      </li>
    </ul>
  </nav>

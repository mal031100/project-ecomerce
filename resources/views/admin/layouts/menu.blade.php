<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('amin')}}">
      <div class="sidebar-brand-icon">
        <img src="{{ asset('admin/img/logo/logo2.png')}}">
      </div>
      <div class="sidebar-brand-text mx-3">MalAdmin</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
      <a class="nav-link" href="{{url('amin')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Features
    </div> 
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
        aria-expanded="true" aria-controls="collapseBootstrap">
        <i class="far fa-fw fa-window-maximize"></i>
        <span>Product</span>
      </a>
      <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header"></h6>
          <a class="collapse-item" href="{{url('amin/product')}}">List</a>
          <a class="collapse-item" href="{{url('amin/product/add-product')}}">Add</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
        aria-controls="collapseForm">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>Category</span>
      </a>
      <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header"></h6>
          <a class="collapse-item" href="{{route('admin.category.list')}}">List Category</a>
          <a class="collapse-item" href="{{route('admin.category.add')}}">Add Category</a>
        </div>
      </div>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Examples
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true"
        aria-controls="collapsePage">
        <i class="fas fa-fw fa-columns"></i>
        <span>Account</span>
      </a>
      <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header"></h6>
          <a class="collapse-item" href="{{route('admin.user.list')}}">list</a>
          <a class="collapse-item" href="404.html">404 Page</a>
          <a class="collapse-item" href="blank.html">Blank Page</a>
        </div>
      </div>
    </li>
    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
  </ul>
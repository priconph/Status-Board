<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('dashboard') }}" class="brand-link">
    <img src="{{ asset('public/images/pricon_logo2.png') }}"
         alt="CNPTS"
         class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Status Board System</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">Admin</li>
        @if (Auth::user()->user_classification_id == 1)
        <li class="nav-item">
          <a href="{{ route('engineering_content') }}" class="nav-link">
            <i class="fas fa-cogs"></i>
            <p> 
              Non-Conforming Products
            </p>
          </a>
        </li>
        @endif
        @if (Auth::user()->user_classification_id == 2)
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-list-alt"></i>
              <p>
              QC Content
              </p>
            <i class="fas fa-angle-left right"></i>
          </a>

        <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('qc_content_lot_out_defects') }}" class="nav-link">
              <i class="fa fa-exclamation-triangle nav-icon"></i>
            <p>Lot-out Defects</p>
          </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('qc_content_customer_claim') }}" class="nav-link">
              <i class="far fa-comment nav-icon"></i>
            <p>Customer Claim</p>
          </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('qc_content_list_of_documents') }}" class="nav-link">
              <i class="fa fa-list-alt nav-icon"></i>
            <p>List of Documents</p>
          </a>
        </li>        
        </ul>

        </li>
        @endif
        @if (Auth::user()->user_classification_id == 3)
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-microchip"></i>
              <p>
              Production Content
              </p>
            <i class="fas fa-angle-left right"></i>
          </a>

        <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('production_content_monthly_best_performer') }}" class="nav-link">
            <i class="fa fa-star"></i>
              <p>Monthly Best Performers</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('production_content_prod_line_eff_monitoring') }}" class="nav-link">
            <i class="fa fa-list-alt"></i>
              <p>Production Line Efficiency</p>
              <br>
              <p>Monitoring</p>
          </a>
        </li>
        </ul>
        </li>
        @endif
        <li class="nav-item">
          <a href="{{ route('display_content') }}" class="nav-link">
            <i class="fa fa-desktop"></i>
            <p>
              Display Content
            </p>
          </a>
        </li>       
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
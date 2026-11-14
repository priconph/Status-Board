@php $layout = 'layouts.super_user_layout'; @endphp
@auth
  @php
    if(Auth::user()->user_level_id == 1){
      $layout = 'layouts.super_user_layout';
    }
    else if(Auth::user()->user_level_id == 2){
      $layout = 'layouts.admin_layout';
    }
    else if(Auth::user()->user_level_id == 3){
      $layout = 'layouts.user_layout';
    }
  @endphp
@endauth

@auth
  @extends($layout)

  @section('title', 'Dashboard')

  @section('content_page')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li> -->
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              @if(Auth::user()->user_level_id == 1)
                <div class="card-header">
                  <h3 class="card-title">ADMINISTRATOR MODULES</h3>
                </div>

                <!-- Start Page Content -->
                <div class="card-body">
                  <div class="row">
                    @if(Auth::user()->user_level_id == 1)
                      <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-success">
                          <div class="inner">
                            <h3 id="h3TotalNoOfUsers">0</h3>
                            <p>User</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-users"></i>
                          </div>
                          <a href="{{ route('user') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div>   

                      <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-primary">
                          <div class="inner">
                            <h3 id="h3TotalNoOfNonConformingProducts">0</h3>
                            <p>Non-Conforming Products</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-table"></i>
                          </div>
                          <a href="{{ route('engineering_content') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div>
                      <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-warning">
                          <div class="inner">
                            <h3 id="h3TotalNoOfLotOutDefects">0</h3>

                            <p>Lot Out Defects</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-table"></i>
                          </div>
                          <a href="{{ route('qc_content_lot_out_defects') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div> 
                      <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-warning">
                          <div class="inner">
                            <h3 id="h3TotalNoOfCustomerClaims">0</h3>

                            <p>Customer Claim</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-table"></i>
                          </div>
                          <a href="{{ route('qc_content_customer_claim') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div>   
                      <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-warning">
                          <div class="inner">
                            <h3 id="h3TotalNoOfListofDocuments">0</h3>

                            <p>List of Documents</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-table"></i>
                          </div>
                          <a href="{{ route('qc_content_list_of_documents') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div>
                      <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-orange">
                          <div class="inner">
                            <h3 id="h3TotalNoOfMonthlyBestPerformers">0</h3>

                            <p>Monthly Best Performers</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-table"></i>
                          </div>
                          <a href="{{ route('production_content_monthly_best_performer') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div>
                      <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-orange">
                          <div class="inner">
                            <h3 id="h3TotalNoOfListofProdLineEffMonitoring">0</h3>
                            <p>Line Efficiency Monitoring</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-table"></i>
                          </div>
                          <a href="{{ route('production_content_prod_line_eff_monitoring') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div>                                               
                    @endif
                  </div>
                  <!-- /.row -->
                </div>
                <!-- !-- End Page Content -->
                <div class="card-header">                  
                </div>
                @endif
                @if (Auth::user()->user_level_id == 2 || Auth::user()->user_level_id == 3)
                <div class="row">
                @if (Auth::user()->user_classification_id == 1)
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-primary">
                      <div class="inner">
                        <h3 id="h3TotalNoOfNonConformingProducts">0</h3>
                        <p>Non-Conforming Products</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-table"></i>
                      </div>
                      <a href="{{ route('engineering_content') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                 @endif
                 @if (Auth::user()->user_classification_id == 2)
                 <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <h3 id="h3TotalNoOfLotOutDefects">0</h3>

                        <p>Lot Out Defects</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-table"></i>
                      </div>
                      <a href="{{ route('qc_content_lot_out_defects') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div> 
                 <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <h3 id="h3TotalNoOfCustomerClaims">0</h3>

                        <p>Customer Claim</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-table"></i>
                      </div>
                      <a href="{{ route('qc_content_customer_claim') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>   
                 <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <h3 id="h3TotalNoOfListofDocuments">0</h3>

                        <p>List of Documents</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-table"></i>
                      </div>
                      <a href="{{ route('qc_content_list_of_documents') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>  
                  @endif
                  @if (Auth::user()->user_classification_id == 3)                                  
                  <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-orange">
                      <div class="inner">
                        <h3 id="h3TotalNoOfMonthlyBestPerformers">0</h3>

                        <p>Monthly Best Performers</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-table"></i>
                      </div>
                      <a href="{{ route('production_content_monthly_best_performer') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-orange">
                      <div class="inner">
                        <h3 id="h3TotalNoOfListofProdLineEffMonitoring">0</h3>
                        <p>Line Efficiency Monitoring</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-table"></i>
                      </div>
                      <a href="{{ route('production_content_prod_line_eff_monitoring') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div> 
                  @endif                   
                </div>                                  
                @endif 
                </div>
                <!-- /.row -->

                <!-- <center>
                  <iframe width="653" height="490" src="https://www.youtube.com/embed/KWhajPXrhDs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </center> -->
              </div>
              <!-- !-- End Page Content -->
            </div>
            <!-- /.card -->
          </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection

  @section('js_content')
  <script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();
      CountUserByStatForDashboard(1);
      CountNonConformingProductsByStatForDashboard(2);
      CountLotOutDefectsByStatForDashboard(2);
      CountCustomerClaimByStatForDashboard(2);
      CountListOfDocumentsByStatForDashboard(2);
      CountMonthlyBestPerformersByStatForDashboard(2);
      CountProdLineEffMonitoringByStatForDashboard(2);
    });
  </script>
  @endsection
@endauth
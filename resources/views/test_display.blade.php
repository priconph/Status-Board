<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Status Board System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @include('shared.css_links.css_links')
</head></head>
<body>
  <!-- /.card-header -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active" data-interval="5000">
          <img class="d-block w-55" src="{{ asset('public/images/plain_white_bg.jpg') }}" alt="First slide">
          <div class="carousel-caption" style="top: 0%; transform: translateY(-0%); bottom: 0%; margin: 0%; padding: 5px; position: absolute; left: 1%; right: 1%;">
            <div style="background-color: #055C9D; width: 100%;">
              <p style="font-size: 40px; font-family: 'Roboto'; text-align: left; font-weight: bold; ">&nbsp;<img src="{{ asset('public/images/Box.png') }}" width="30" height="30" alt="Warning!"> Engineering Status Board</p>              
            </div>
            <div style="background-color: #68BBE3; width: 100%; height: 15px; margin-top: 15px;"></div>
            <p style="text-align: left; font-family: 'Roboto'; font-size: 40px; font-weight: bold; color: #002242; margin-top: 20px;"><u>Non-Conforming Products Monitoring Board</u></p>
            <table class="left" id="" style="width: 100%">
              <thead>
                <tr>
                  <th scope="col" style="border: 1px solid black; color: black; font-size: 24px; background-color: #B1D4E0;">Date</th>
                  <th scope="col" style="border: 1px solid black; color: black; font-size: 24px; background-color: #B1D4E0;">Product Name</th>
                  <th scope="col" style="border: 1px solid black; color: black; font-size: 24px; background-color: #B1D4E0;">PO Number</th>
                  <th scope="col" style="border: 1px solid black; color: black; font-size: 24px; background-color: #B1D4E0;">Problem</th>
                  <th scope="col" style="border: 1px solid black; color: black; font-size: 24px; background-color: #B1D4E0;">PTIS / NG Report Number</th>
                  <th scope="col" style="border: 1px solid black; color: black; font-size: 24px; background-color: #B1D4E0;">Status / Disposition</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>   
        </div>
        <div class="carousel-item">
          <img class="d-block w-55" src="{{ asset('public/images/plain_white_bg.jpg') }}" alt="Second slide">
          <div class="carousel-caption" style="top: 0%; transform: translateY(-0%); bottom: 0%; margin: 0%; padding: 5px; position: absolute; left: 1%; right: 1%;">
            <div style="background-color: #59981A; width: 100%;">
              <p style="font-size: 40px; font-family: 'Roboto'; text-align: left; font-weight: bold; ">&nbsp;<img src="{{ asset('public/images/Box.png') }}" width="30" height="30" alt="Warning!"> QC Status Board</p>              
            </div>
            <div style="background-color: #59981A; width: 100%; height: 15px; margin-top: 15px;"></div>
            <p style="text-align: left; font-family: 'Roboto'; font-size: 36px; font-weight: bold; color: #002242; margin-top: 5px;"><u>Lot Out Defects</u></p>
            <div class="row" id=""> 
              <div class="col-sm-6">
                <div class="row justify-content-md-center">
                  <div class="col-sm-11" style="border: 4px solid black; border-color: #050A30; margin: 5px 5px;">
                    <div class="row">
                      <div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">
                      Device Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                      </div>
                      <div class="col-sm-4" style="text-align: center; border-bottom: 1px solid black; font-size: 26px; color: black;"></div>
                    </div>
                    <div class="row">           
                      <div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Mode of Defect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>
                      <div class="col-sm-4" style="text-align: center; border-bottom: 1px solid black; font-size: 26px; color: black;"></div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Contributing Line &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>
                      <div class="col-sm-4" style="text-align: center; border-bottom: 1px solid black; font-size: 26px; color: black;"></div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6" style="text-align: left; font-size: 26px; color: black; font-weight: bold; margin-left: 40px">Date Detected&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div>
                      <div class="col-sm-4" style="text-align: center; border-bottom: 1px solid black; font-size: 26px; color: black;"></div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-sm-5" style="text-align: left; font-size: 26px; color: black; margin-left: 40px">Illustration of Actual Defect</div>
                      <div class="col-sm-4" style="text-align: center; margin-left: 70px">
                        <img style="border: 2px solid black; border-color: #050A30; width: 250px; max-height: 225px; min-height: 80px" src="{{ asset('public/images/Defect.png') }}">
                      </div>
                    </div>
                    <br>
                  </div>
                </div>  
              </div>                                        
            </div>
            <p style="text-align: left; font-family: 'Roboto'; font-size: 36px; font-weight: bold; color: #002242; margin-top: 5px;"><u>Customer Claim</u></p>
            <div class="row" id="">
                                 
            </div>
          </div>  
        </div>
        <div class="carousel-item" data-interval="5000">
          <img class="d-block w-55" src="{{ asset('public/images/plain_white_bg.jpg') }}" alt="Third slide">
          <div class="carousel-caption" style="top: 0%; transform: translateY(-0%); bottom: 0%; margin: 0%; padding: 5px; position: absolute; left: 1%; right: 1%;">
            <div style="background-color: #59981A; width: 100%;">
              <p style="font-size: 40px; font-family: 'Roboto'; text-align: left; font-weight: bold; ">&nbsp;<img src="{{ asset('public/images/Box.png') }}" width="30" height="30" alt="Warning!"> QC Status Board</p>              
            </div>
            <div style="background-color: #59981A; width: 100%; height: 15px; margin-top: 15px;"></div>
            <p style="text-align: left; font-family: 'Roboto'; font-size: 40px; font-weight: bold; color: #002242; margin-top: 20px;"><u>List of New Documents</u></p>
            <p style="text-align: left; font-family: 'Roboto'; font-size: 36px; font-weight: bold; color: #BA0F30; margin-top: 20px;">Work Instruction</p>
            <table class="left" id="" style="width: 100%">
              <thead>
                <tr>
                  <th scope="col" style="border: 1px solid black; color: black; font-size: 24px; background-color: #B2D2A4">Document Number</th>
                  <th scope="col" style="border: 1px solid black; color: black; font-size: 24px; background-color: #B2D2A4">Document Title</th>
                  <th scope="col" style="border: 1px solid black; color: black; font-size: 24px; background-color: #B2D2A4">Revision Details</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>   
        </div>        
        <div class="carousel-item">
          <img class="d-block w-55" src="{{ asset('public/images/plain_white_bg.jpg') }}" alt="Fourth Slide">
          <div class="carousel-caption" style="top: 0%; transform: translateY(-0%); bottom: 0%; margin: 0%; padding: 5px; position: absolute; left: 1%; right: 1%;">
            <div style="background-color: #003060; width: 100%;">
              <p style="font-size: 40px; font-family: 'Roboto'; text-align: left; font-weight: bold; ">&nbsp;<img src="{{ asset('public/images/Box.png') }}" width="30" height="30" alt="Warning!"> Production Status Board</p>              
            </div>
            <div style="background-color: #000C66; width: 100%; height: 15px; margin-top: 15px;"></div>
            <div class="row">
              <div class="col-sm-6" style="float: left; text-align: left; width: 50%;">
              <span style="font-family: 'Roboto'; font-size: 40px; font-weight: bold; color: #002242; margin-top: 20px;"><u>Monthly Best Performers</u></span> </div>
              <div class="col-sm-6" style="float: right; text-align: right; width: 50%;">
              <span style="font-family: 'Roboto'; font-size: 40px; font-weight: bold; color: #000C66; margin-top: 20px;">Month : <u>April 2021</u></span> 
              </div>              
            </div>
            <div style="margin-left:-5px; margin-right:-5px;">
            <div style="float:left; width:50%; padding: 5px"> 
              <table style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="MthlyBestPerfs8">
                <thead>
                  <tr>
                    <th style="border: 1px solid black; color: black; font-size: 22px; font-weight: bold;">Category</th>
                    <th colspan="2" style="border: 1px solid black; color: black; font-size: 22px; font-weight: bold;">Name / Photo</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="border: 1px solid black; width: 35%; color: black; font-size: 22px;">Best Operator</td>
                    <td style="border: 1px solid black; border-right-style: none; width: 25%; color: black; font-size: 18px;">Rymar John A. Genovea</td>              
                    <td style="border: 1px solid black; border-left-style: none; width: 25%; margin-left: 100px; padding: 5px;"><img style="width: 150px; max-height: 125px; min-height: 80px; border: 3px solid black; border-color: #145DA0;" src="{{ asset('public/images/Defect.png') }}"></td>
                  </tr>
                </tbody>
              </table>              
            </div>
            <div style="float:left; width:50%; padding: 5px"> 
              <table style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="">
                <thead>
                  <tr>
                    <th scope="col" style="border: 1px solid black; color: black;">Category</th>
                    <th scope="col" style="border: 1px solid black; color: black;">Name / Photo</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>              
            </div>
            </div>                  
          </div> 
        </div>
        <div class="carousel-item">
          <img class="d-block w-55" src="{{ asset('public/images/plain_white_bg.jpg') }}" alt="Fifth Slide">
          <div class="carousel-caption" style="top: 0%; transform: translateY(-0%); bottom: 0%; margin: 0%; padding: 5px; position: absolute; left: 1%; right: 1%;">
            <div style="background-color: #003060; width: 100%;">
              <p style="font-size: 40px; font-family: 'Roboto'; text-align: left; font-weight: bold; ">&nbsp;<img src="{{ asset('public/images/Box.png') }}" width="30" height="30" alt="Warning!"> Production Status Board</p>              
            </div>
            <div style="background-color: #000C66; width: 100%; height: 15px; margin-top: 15px;"></div>
            <span style="font-family: 'Roboto'; font-size: 40px; font-weight: bold; color: #002242; margin-top: 20px;"><u>Product Line Efficiency Monitoring</u></span>
            <div class="row">
              <div class="col-sm-6" style="float: left; text-align: left; width: 50%;">
                <span style="font-family: 'Roboto'; font-size: 40px; font-weight: bold; color: black; margin-top: 20px;">Month : <u style="color: #000C66;">April 2021</u></span> 
              </div>
              <div class="col-sm-6" style="float: right; text-align: right; width: 50%;">
                <span style="font-family: 'Roboto'; font-size: 40px; font-weight: bold; color: black; margin-top: 20px;">Target Efficiency : <u style="color: #0000FF;">100%</u></span> 
              </div>              
            </div>
                  <table style="width:100%;" id="ProdLineEffMon">
                    <thead>
                      <tr>
                        <th>&nbsp;</th>
                      </tr>                       
                      <tr>
                        <th scope="col" style="border: 1px solid black; font-size: 44px; font-weight: bold; color: black; background-color: #EEB5EB;">Line</th>
                        <th scope="col" style="border: 1px solid black; font-size: 44px; font-weight: bold; color: black; background-color: #EEB5EB;">Actual Efficiency</th>
                        <th scope="col" style="border: 1px solid black; font-size: 44px; font-weight: bold; color: black; background-color: #EEB5EB;">Result</th>
                      </tr>                        
                    </thead>
                    <tbody>
                       <tr>
                        <td style="width:15%; border: 1px solid black; font-size: 44px; color: black;"></td>
                        <td style="width:15%; border: 1px solid black; font-size: 44px; color: black;"></td>
                        <td style="width:15%; border: 1px solid black; font-size: 44px; color: black;"></td>                                                                            
                      </tr>                        
                    </tbody>
                  </table>         
                </div>                    
              </div>
            </div>                   
          </div>  
        </div>        
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  <!-- /.card-body -->
</body>

@include('shared.js_links.js_links')
<script type="text/javascript">

</script>
</html>
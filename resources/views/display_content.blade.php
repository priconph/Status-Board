<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Status Board System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @include('shared.css_links.css_links')
</head>
<body>
 <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
<!--     <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
 -->
  </ol>
  <div class="carousel-inner">
<!--     <div class="carousel-item active" data-interval="5000">
      <img class="d-block w-55" src="{{ asset('public/images/white_bg.jpg') }}" alt="First slide">
      <div class="carousel-caption" style="top: 5%; transform: translateY(-5%); bottom: 0; margin: 0; padding: 5px; position: absolute; left: 1%; right: 1%;">
        <div style="border: 1px solid black; color: black; background-color: orange; color: black; font-size: 28px; font-weight: bold;">Engineering Status Board Content</div>
        <br>
        <table class="left" id="NonConfProds" style="width: 100%">
          <thead>
            <tr>
              <th colspan="6" scope="colgroup" style="border: 1px solid black; background-color: yellow; color: black; font-size: 30px;">NonConforming Products Monitoring Board</th>
            </tr>
            <tr>
              <th scope="col" style="border: 1px solid black; color: black; font-size: 24px;">Date</th>
              <th scope="col" style="border: 1px solid black; color: black; font-size: 24px;">Product Name</th>
              <th scope="col" style="border: 1px solid black; color: black; font-size: 24px;">PO Number</th>
              <th scope="col" style="border: 1px solid black; color: black; font-size: 24px;">Problem</th>
              <th scope="col" style="border: 1px solid black; color: black; font-size: 24px;">PTIS / NG Report Number</th>
              <th scope="col" style="border: 1px solid black; color: black; font-size: 24px;">Status / Disposition</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div> -->
<!--     <div class="carousel-item" data-interval="5000">
      <img class="d-block w-55" src="{{ asset('public/images/white_bg.jpg') }}" alt="Second slide">
      <div class="carousel-caption" style="top: 5%; transform: translateY(-5%); bottom: 0; margin: 0; padding: 5px; position: absolute; left: 1%; right: 1%;">
        <div style="border: 1px solid black; color: black; background-color: orange; color: black; font-size: 28px; font-weight: bold;">QC Status Board Content</div>
        <br>
        <div style=" border: 1px solid black; background-color: yellow; color: black;"><h2>Lot Out Defects</h2></div>
        <div class="row" id="DivLotOutDefects">

        </div>
        <br>
        <div style=" border: 1px solid black; background-color: #145DA0; color: white;"><h2>Customer Claim</h2></div>
        <div class="row" id="DivCustomerClaim">

        </div>
      </div>
    </div> -->
<!--     <div class="carousel-item" data-interval="5000">
      <img class="d-block w-55" src="{{ asset('public/images/white_bg.jpg') }}" alt="Third slide">
      <div class="carousel-caption" style="top: 5%; transform: translateY(-5%); bottom: 0; margin: 0; padding: 5px; position: absolute; left: 1%; right: 1%;">
        <div style="border: 1px solid black; color: black; background-color: orange; color: black; font-size: 28px; font-weight: bold;">QC Status Board Content</div>
        <br>
        <table style="width:100%;" id="ListofDocsWI">
          <thead>
            <tr>
              <th colspan="2" scope="colgroup" style="text-align: center; background-color: #145DA0; color: white; font-size: 28px; ">List of Documents</th>
            </tr>
            <tr>
              <th scope="col" style="font-size: 22px; border: 1px solid black; color: black;">Document #</th>
              <th scope="col" style="font-size: 22px; border: 1px solid black; color: black;">Document Title</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>

        <table style="width:100%;" id="ListofDocsPP">
          <tbody>
          </tbody>
        </table>

        <table style="width:100%;" id="ListofDocsPQS">
          <tbody>
          </tbody>
        </table>
      </div>
    </div> -->
<!--     <div class="carousel-item" data-interval="5000">
      <img class="d-block w-55" src="{{ asset('public/images/white_bg.jpg') }}" alt="Fourth slide">
      <div class="carousel-caption" style="top: 5%; transform: translateY(-5%); bottom: 0; margin: 0; padding: 5px; position: absolute; left: 1%; right: 1%;">
        <div style="border: 1px solid black; color: black; background-color: orange; color: black; font-size: 28px; font-weight: bold;">Production Status Board Content</div>
        <br>
        <table class="center" style="float:left; width:50%;" id="MthlyBestPerfs8">
          <thead>
            <tr>
              <th colspan="2" scope="colgroup" style="text-align: right; background-color: #145DA0; color: white; font-size: 28px; ">Monthly Best</th>
            </tr>
            <tr>
              <th scope="col" style="border: 1px solid black; color: black;">Category</th>
              <th scope="col" style="border: 1px solid black; color: black;">Name / Photo</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
        <table class="center" style="float:left; width:50%;" id="MthlyBestPerfs16">
          <thead>
            <tr>
              <th colspan="2" scope="colgroup" style="text-align: left;  background-color: #145DA0; color: white; font-size: 28px;">&nbsp;Performers</th>
            </tr>
            <tr>
              <th scope="col" style="border: 1px solid black; color: black;">Category</th>
              <th scope="col" style="border: 1px solid black; color: black;">Name / Photo</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div> -->
<!--     <div class="carousel-item" data-interval="5000">
      <img class="d-block w-55" src="{{ asset('public/images/white_bg.jpg') }}" alt="Fifth slide">
      <div class="carousel-caption" style="top: 5%; transform: translateY(-5%); bottom: 0; margin: 0; padding: 5px; position: absolute; left: 1%; right: 1%;">
        <div style="border: 1px solid black; color: black; background-color: orange; color: black; font-size: 28px; font-weight: bold;">Production Status Board Content</div>
        <br>
        <table style="width:100%; margin-left: auto; margin-right: auto;" id="ProdLineEffMon">
          <thead>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div> -->
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</body>

@include('shared.js_links.js_links')

<?php
function isMobile() {
    return preg_match("/(android|diordnA|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

// Use the function
if(isMobile()){
  echo "<script type='text/javascript'>document.body.style.zoom = '68%';</script>";
}
else {
    echo "<script type='text/javascript'>document.body.style.zoom = '101%';</script>";
}
?>

<script type="text/javascript">
  $(document).ready(function(){
    DisplayEnggContent();
    DisplayQCContentLotOutDefects();
    // DisplayQCContentCustomerClaim();
    DisplayQCContentListOfDocumentsWI();
    DisplayQCContentListOfDocumentsPP();
    DisplayQCContentListOfDocumentsPQS();
    DisplayProdContentMthlyBestPerformer(); //Display Category 1,2,3 (Left) & 10,11,12 (Right)
    DisplayProdContentMthlyBestPerformer6(); //Display Category 4,5,6 (Left) & 13,14,15 (Right)
    DisplayProdContentMthlyBestPerformer9(); //Display Category 7,8,9 (Left) & 16,17,18 (Right) - 18 Not Used (for new category)
    DisplayProdContentMthlyBestPerformerNew(); //Display Category 19,20,21 (Left) & 22,23,24 (Right) 19 - 24 Not Used (for new category)
    DisplayProdContentProdLineEffMon();

    var totalItems = $('.carousel-item').length;
    var currentIndex = $('div.carousel-item.active').index();
    // console.log('totalItems', totalItems);

    // Auto Refresh function (needs improvement)
    $('#carouselExampleIndicators').on('slide.bs.carousel', function () {
      currentIndex = $('div.carousel-item.active').index();
      // alert(currentIndex);
        if($('.carousel-inner .carousel-item:last').hasClass('active')) {
          location.reload();
        }
    })

  });
</script>
</body>
</html>

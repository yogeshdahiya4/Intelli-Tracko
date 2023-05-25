<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Intelli-Tracko</title>
    <!--
Template 2109 The Card
http://www.tooplate.com/view/2109-the-card
-->
    <!-- load CSS -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600"
    />
    <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="slick/slick.css" />
    <link rel="stylesheet" href="slick/slick-theme.css" />
    <link rel="stylesheet" href="css/magnific-popup.css" />
    <link rel="stylesheet" href="css/tooplate-style.css" />
    <!-- Templatemo style -->
    <script type="text/javascript" src="gmaps.js"></script>
    <style type="text/css">
      .container {
        height: 450px;
      }
      #map {
        width: 60%;
        height: 75%;
        border: 1px solid blue;
      }
      
    </style>
  </head>

  <body>
    <!-- Loader -->
    <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>

    <div class="tm-main-container">
      <div class="tm-top-container">
        <!-- Menu -->
        <nav id="tmNav" class="tm-nav">
          <p class="tm-navbar-menu">Menu</p>
          <ul class="tm-nav-links">
            <li class="tm-nav-item active">
              <a href="#" data-linkid="0" data-align="right" class="tm-nav-link">Real-Time location</a>
            </li>
            <li class="tm-nav-item">
              <a href="#" data-linkid="1" data-align="right" class="tm-nav-link">Trip Record</a>
            </li>
            <li class="tm-nav-item">
              <a
                href="#"
                data-linkid="2"
                data-align="middle"
                class="tm-nav-link">Work</a>
            </li>
            <li class="tm-nav-item">
              <a href="#" data-linkid="3" data-align="left" class="tm-nav-link">Contact</a>
            </li>
            <li class="tm-nav-item">
              <a
                rel="nofollow" href="https://fb.com/tooplate"
                class="tm-nav-link external">External</a>
            </li>
          </ul>
        </nav>

        <!-- Site header -->
        <header class="tm-site-header-box tm-bg-dark">
          <h1 class="tm-site-title">Intelli-Tracko</h1>
          <p class="mb-0 tm-site-subtitle">Real-Time Location</p>
        </header>
      </div>
      <!-- tm-top-container -->

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Site content -->
            <div class="tm-content">
              <!-- Section 0 Introduction -->
              <section class="tm-section tm-section-0">
    	<div id="mySidenav" class="sidenav">
	<a class="active" href="location.php" id="Realtime"><i class="fa fa-fw fa-bus"></i>Realtime Location</a>
	<a href="Trip_record.php" id="Trip"><i class="fa fa-fw fa-book"></i>Trip Record</a>
	<a href="student.php" id="Student"><i class="fa fa-fw fa-user"></i>Student Dashboard</a>
	<a href="week.php" id="Week"><i class="fa fa-fw fa-pie-chart"></i> Weekly Data Analysis</a>
	</div>
  <br>
  <br>
<div class="container">
   <center><h1>Bus Trip Record </h1></center>
   <br>
   <div id="date"></div>


<form method="POST">
  <label for="Date">Enter Date to See the trip Records:</label>
  <input type="date" id="date" name="date">
  <input type="submit">
</form>
<br>
<br>

<?php
       //error_reporting(E_ALL ^ E_WARNING);
       $date = $_POST['date'];
		
        $day= date('l', strtotime($date));
        $D=date('d', strtotime($date));
        $month= date('F', strtotime($date));

		include("config.php");
		$con=$db;
		if (!$con) {
		die("yy " );
		}

		

		$row = mysqli_query($con,"SELECT * FROM data WHERE Date='$D' AND Month='$month' AND Day= '$day'");
		
        if (mysqli_num_rows( $row )==0) {
          //die(" ");
		   $rows="<br> Sorry,No Bus Trip Record found on this Date. ";
		}
		//$rows = mysqli_fetch_array($row);
        else {
            $rows= mysqli_fetch_all($row, MYSQLI_ASSOC);
            
            $stops=array();
            $stops[0]='Stop';
            $i=1;
            foreach($rows as $data){
             
              $la=$data['Latitude'];
              $lo=$data['Longitude'];
            $stop = mysqli_query($con,"SELECT Stop_Name FROM stop_name WHERE Latitude= $la AND Longitude= $lo ");
            if (!$stop) {
              die("Could not connect: " . mysqli_error($stop));
              }
            $s = mysqli_fetch_array($stop);
            $stops[$i]=$s['Stop_Name'];
            $i++; 
          }
        }
        
        ?>
    
    <div class="card mb-4 mb-lg-0 ">
        <div class="card-body">
    <div class="row">
   <div class="col-sm-8">
       <div class="card-body text-center">
    
    <div class="table-responsive">
      <table class="table table-bordered">
       <thead><tr><th>S.N</th>
         <th>Stop Name</th>
         <th>Time</th>
         <th>Date</th>
         <th>Month</th>
         <th>Day</th>
         
    </thead>
    <tbody>
  <?php
      if(is_array($rows)){      
      $sn=1;
      foreach($rows as $data){
    ?>
      <tr>
      <td><?php echo $sn; ?></td>

      <td><?php echo $stops[$sn]??''; ?></td>
      <td><?php echo $data['Time']??''; ?></td>
      <td><?php echo $data['Date']??''; ?></td>
      <td><?php echo $data['Month']??''; ?></td>
      <td><?php echo $data['Day']??''; ?></td>
     </tr>
     <?php
      $sn++;}}else{ ?>
      <tr>
        <td colspan="8">
    <?php echo $rows; ?>
  </td>
    <tr>
    <?php
    }?>
    </tbody>
     </table>
   </div>
</div>
</div>
</div>
</div>
</div>
</div>
     
              </section>

            </div>
          </div>
        </div>
      </div>

      <div class="tm-bottom-container">
        
      </div>
    </div>

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/background.cycle.js"></script>
    <script src="slick/slick.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script>
      let slickInitDone = false;
      let previousImageId = 0,
        currentImageId = 0;
      let pageAlign = "right";
      let bgCycle;
      let links;
      let eachNavLink;

      window.onload = function() {
        $("body").addClass("loaded");
      };

      function navLinkClick(e) {
        if ($(e.target).hasClass("external")) {
          return;
        }

        e.preventDefault();

        if ($(e.target).data("align")) {
          pageAlign = $(e.target).data("align");
        }

        // Change bg image
        previousImageId = currentImageId;
        currentImageId = $(e.target).data("linkid");
        bgCycle.cycleToNextImage(previousImageId, currentImageId);

        // Change menu item highlight
        $(`.tm-nav-item:eq(${previousImageId})`).removeClass("active");
        $(`.tm-nav-item:eq(${currentImageId})`).addClass("active");

        // Change page content
        $(`.tm-section-${previousImageId}`).fadeOut(function(e) {
          $(`.tm-section-${currentImageId}`).fadeIn();
          // Gallery
          if (currentImageId === 2) {
            setupSlider();
          }
        });

        adjustFooter();
      }

      $(document).ready(function() {
        // Set first page
        $(".tm-section").fadeOut(0);
        $(".tm-section-0").fadeIn();

        // Set Background images
        // https://www.jqueryscript.net/slideshow/Simple-jQuery-Background-Image-Slideshow-with-Fade-Transitions-Background-Cycle.html
        bgCycle = $("body").backgroundCycle({
          imageUrls: [
            "img/photo-02.jpg",
            "img/photo-03.jpg",
            "img/photo-04.jpg",
            "img/photo-05.jpg"
          ],
          fadeSpeed: 2000,
          duration: -1,
          backgroundSize: SCALING_MODE_COVER
        });

        eachNavLink = $(".tm-nav-link");
        links = $(".tm-nav-links");

        // "Menu" open/close
        if (links.hasClass("open")) {
          links.fadeIn(0);
        } else {
          links.fadeOut(0);
        }

        $("#tm_about_link").on("click", navLinkClick);
        $("#tm_work_link").on("click", navLinkClick);

        // Each menu item click
        eachNavLink.on("click", navLinkClick);

        $(".tm-navbar-menu").click(function(e) {
          if (links.hasClass("open")) {
            links.fadeOut();
          } else {
            links.fadeIn();
          }

          links.toggleClass("open");
        });

        // window resize
        $(window).resize(function() {
          // If current page is Gallery page, set it up
          if (currentImageId === 2) {
            setupSlider();
          }

          // Adjust footer
          adjustFooter();
        });

        adjustFooter();
      }); // DOM is ready

      function adjustFooter() {
        const windowHeight = $(window).height();
        const topHeight = $(".tm-top-container").height();
        const middleHeight = $(".tm-content").height();
        let contentHeight = topHeight + middleHeight;

        if (pageAlign === "left") {
          contentHeight += $(".tm-bottom-container").height();
        }

        if (contentHeight > windowHeight) {
          $(".tm-bottom-container").addClass("tm-static");
        } else {
          $(".tm-bottom-container").removeClass("tm-static");
        }
      }

      function setupSlider() {
        let slidesToShow = 4;
        let slidesToScroll = 2;
        let windowWidth = $(window).width();

        if (windowWidth < 480) {
          slidesToShow = 1;
          slidesToScroll = 1;
        } else if (windowWidth < 768) {
          slidesToShow = 2;
          slidesToScroll = 1;
        } else if (windowWidth < 992) {
          slidesToShow = 3;
          slidesToScroll = 2;
        }

        if (slickInitDone) {
          $(".tm-gallery").slick("unslick");
        }

        slickInitDone = true;

        $(".tm-gallery").slick({
          dots: true,
          customPaging: function(slider, i) {
            var thumb = $(slider.$slides[i]).data();
            return `<a>${i + 1}</a>`;
          },
          infinite: true,
          prevArrow: false,
          nextArrow: false,
          slidesToShow: slidesToShow,
          slidesToScroll: slidesToScroll
        });

        // Open big image when a gallery image is clicked.
        $(".slick-list").magnificPopup({
          delegate: "a",
          type: "image",
          gallery: {
            enabled: true
          }
        });
      }
    </script>
  </body>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9UrBgu_VcgprSm0PtIkUh4AN7gF1hYqM&callback=loadMap">

</script>

</html>

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
              <a
                rel="nofollow" href="trip.php"
                class="tm-nav-link external">Trip Record</a>
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
                <h2 class="tm-section-title mb-3 font-weight-bold">
                  Map
                </h2>
                <div>
            
	<div class="background">
    <div class="container"  style="margin-left:80px;">
		
		
		<form method="POST" >
		   <header class="tm-site-header-box tm-bg-dark">
          <h1 class="tm-site-title">Select Stop</h1>
		  <label for=""></label>
                                <select name="stop">
                                    <option value="">--Stop Name--</option>
                                    <option value="Manglapuri">Manglapuri</option>
                                    <option value="Dabri Mor">Dabri Mor</option>
									<option value="Janakpuri C-1">Janakpuri C-1</option>
									<option value="Uttam Nagar">Uttam Nagar</option>
									<option value="Janakpuri DC">Janakpuri DC</option>
									<option value="Vikaspuri">Vikaspuri</option>
									<option value="Meera Bagh">Meera Bagh</option>
									<option value="Paschim Vihar">Paschim Vihar</option>
									<option value="Peera Garhi">Peera Garhi</option>
									<option value="Rohini Sec-5">Rohini Sec-5</option>
									<option value="Saraswati Vihar">Saraswati Vihar</option>
									<option value="SRM University">SRM University</option>
                                </select>
								<button type="submit" name="But_submit" id="But_submit"  class="btn btn-primary">Submit</button>
	    </form>
	    </header>
		<div id="map"></div>
         <br>
         <br>
	     <br>
	    <div class="container-fluid">
	    <div class= "tm-textbox tm-bg-dark">
	     <!--<div class="card mb-4">-->
      <!--    <div class="card-body ">-->
		<div id="msg"></div>
		<br>
         
		 
		 
	 <?php
          error_reporting(E_ALL ^ E_WARNING);
          session_start();
           if(isset($_POST['But_submit'])){
          
              $stop = $_POST['stop'];
          }
            else{
		  $stop=$_SESSION['stop'];
            }
         
		include("config.php");
		$con = $db;
		if (!$con) {
		die("Could not connect: " . mysql_error());
		}

		//Check your connection
		if (!$con) {
		die("Could not connect: " . mysql_error());
		}

        
		$row = mysqli_query($con,"SELECT * FROM stop_name WHERE Stop_Name= '$stop'");
		if (!$row) {
		die("Could not connect: " . mysqli_error($con));
		}
		$rows = mysqli_fetch_array($row);

		$lati1=$rows['Latitude'];
		$long1=$rows['Longitude'];
        
        // To disable all notice error:-
		error_reporting(0);
		session_start();
		$_SESSION['lati1'] = $lati1;
		$_SESSION['long1'] = $long1;


		// include("estimate.php");
		include ("gmaps.php");
		  
		   echo "Average time to reach at your Stop on " . date("l") ." is: <b>".$est_time."AM<b>";
        //   echo $_SESSION['uname'];
        //   echo $_SESSION['stop'];
		   ?>	 
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

<!DOCTYPE html>
<html lang="en" dir="ltr">

<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
    
  <meta charset="utf-8">
  <title> Intelli-Tracko</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Alice&family=Nova+Script&display=swap" rel="stylesheet">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!--<script type="text/javascript" src="gmaps.js"></script>-->
	<style type="text/css">
		
		body {
		    background-image: url('images/bg_5.gif');
  background-position: center;
  background-size: cover;
		margin: 0;
		font-family: Arial, Helvetica, sans-serif;
		
		}


		#mySidenav a {
  position: absolute;
  left: -220px;
  transition: 0.3s;
  padding: 15px;
  width: 250px;
  text-decoration: none;
  font-size: 20px;
  color: white;
  border-radius: 0 5px 5px 0;
}

#mySidenav a:hover {
  left: 0;
}

#Realtime {
  top: 20px;
  background-color: #04AA6D;
}

#Trip {
  top: 80px;
  background-color: #2196F3;
}

#Student {
  top: 140px;
  background-color: #f44336;
}

#Week {
  top: 200px;
  background-color: #555;
}
		
		.container {
		    padding : 10px;
		    padding-top: 50px;
			height: 800px;
		}
		#map {
			width: 105%;
			height: 65%;
			top : 50px;
			/*border: 1px solid blue;*/
		}
		
	</style>

</head>
<body >

    <div id="mySidenav" class="sidenav">
	<a class="active" href="location.php" id="Realtime"><i class="fa fa-fw fa-bus"></i>Realtime Location</a>
	<a href="Trip_record.php" id="Trip"><i class="fa fa-fw fa-book"></i>Trip Record</a>
	<a href="student.php" id="Student"><i class="fa fa-fw fa-user"></i>Student Dashboard</a>
	<a href="week.php" id="Week"><i class="fa fa-fw fa-pie-chart"></i> Weekly Data Analysis</a>
	</div>
	<div class="background">
    <div class="container"  style="margin-left:80px;">
		<center><img class="w-32" src="images/logo_2.png"></center>
		
		
		
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

</body>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9UrBgu_VcgprSm0PtIkUh4AN7gF1hYqM&callback=loadMap">

</script>

</html>

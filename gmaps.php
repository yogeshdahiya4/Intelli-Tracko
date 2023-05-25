<?php
//include("developers.php");
session_start();
$latit1=$_SESSION['lati1'];
$longi1=$_SESSION['long1'];

include("config.php");
$db=$db;
$day=date("l");
  $row = mysqli_query($db,"SELECT Time FROM data WHERE Latitude= $latit1 AND Longitude=$longi1 AND Day= '$day' ");
	if (!$row) {
	    //echo $latit1;
		//die("error " );
		}


		$sum=0;
		$time=0;
    while($rows = mysqli_fetch_array($row)) {

        
         $t=str_split($rows['Time'],2);
		 $hour=intval(str_replace(":","",$t[0]));
		 $min=intval($t[1]);
		 $sec=($hour*3600)+($min*60);
		 $sum+=$sec;
		 $time+=1;
        }
	$s=round($sum/($time));
    $avg_min=($s%3600);
    $hour=floor($s/3600);
    $min=round($avg_min/60);
    $est_time=strval($hour).":".strval($min);
    
?>
<script type="text/JavaScript">
function loadMap() {
	var stop2={lat: <?php echo $latit1; ?>, lng: <?php echo $longi1; ?>};
  
  var start_stop={lat:28.5879,lng:77.0841};
  
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 2,
      center: stop2
    });

var marker2 = new google.maps.Marker({
      position: stop2,
      map: map,
      title:"Your Stop",
      icon:"images/bus-stop_user.png",
    });
    
     var marker_start=new google.maps.Marker({
      position: start_stop,
      map: map,
      title:"Starting Point",
      icon:"images/bus-stop1.png",
    });
  

  // For Route and Time:-

  let directionsService_1 = new google.maps.DirectionsService();
    let directionsRenderer_1 = new google.maps.DirectionsRenderer(
    { polylineOptions: {
        strokeColor: "#422727",
        strokeWeight: 4
    },
      suppressMarkers: true
    }  
  );
  directionsRenderer_1.setMap(map); // Existing map object displays directions
  // Create route from existing points used for markers
  const route = {
      origin: start_stop,
      destination: stop2,
      travelMode: 'DRIVING'
  }

  directionsService_1.route(route,
    function(response, status) { // anonymous function to capture directions
      if (status !== 'OK') {
        window.alert('Directions request failed due to ' + status);
        return;
      } else {
        directionsRenderer_1.setDirections(response); // Add route to the map

        //directionsRenderer.MarkerOptions(icon:image)
        // var directionsData = response.routes[0].legs[0]; // Get data about the mapped route
        // if (!directionsData) {
        //   window.alert('Directions request failed');
        //   return;
        // }
        // else {
        //   document.getElementById('msg').innerHTML = " Driving distance is " + directionsData.distance.text + " And time expected to reach your stop:" + directionsData.duration.text ;
        // }
      }
    });
    
    var marker=null;
    //  let directionsService=null;
    //  let directionsRenderer=null;
    
    

     
    //setInterval(route, 13000);
     //route();
     
     function get_data(){
      
       
   //Our AJAX call to get the updated PHP results
  $.get('developers.php', function(result) {
    // Put the results in the div
    //$(out).html(result);
    route_plan(result);
      
      });
      
     }
     
 function route_plan(result){
       


      var cor=result;
      const ar = cor.split(",");
      let la = ar[1].slice(1,8);
       lati=parseFloat(la); 
      
      let lon=ar[0].replace(/"/g, '');
      let lo = lon.replace("[","");
       long=parseFloat(lo);
    
      var stop1= {lat: lati, lng: long}; //stop 1 Marker
      
      
      //updating Marker:-
      if (marker) {
      // Marker already created - Move it
      //marker.setMap(null);
      marker.setPosition(stop1);
    }

    else {

      marker = new google.maps.Marker({
      position: stop1,
      map: map,
      icon:"images/bus-station.png",
      });
    }
     
    


   // for ploting directions:-

    

    
   let directionsService = new google.maps.DirectionsService();
  //  let directionsRenderer = new google.maps.DirectionsRenderer(
  //   { polylineOptions: {
  //       strokeColor: "#3E3AE9",
  //       strokeWeight: 4
  //   },
  //     suppressMarkers: true
  //   }  
  //   );
    //directionsRenderer.setMap(map); // Existing map object displays directions
    // Create route from existing points used for markers
    const route = {
        origin: stop1,
        destination: stop2,
        travelMode: 'DRIVING'
    }

    directionsService.route(route,
      function(response, status) { // anonymous function to capture directions
        if (status !== 'OK') {
          window.alert('Directions request failed due to ' + status);
          return;
        } else {
          //directionsRenderer.setDirections(response); // Add route to the map
          
          
          var directionsData = response.routes[0].legs[0]; // Get data about the mapped route
          if (!directionsData) {
            window.alert('Directions request failed');
            return;
          }
          else {
            document.getElementById('msg').innerHTML = " Driving distance: " + directionsData.distance.text + "<br>"+ "Time expected to reach at your stop in :" + directionsData.duration.text ;
          }
        }
      });
      
      
      map.setCenter(stop1);
      }
    setInterval(get_data, 12000);
    get_data();

  }

  // }
  

</script>
  



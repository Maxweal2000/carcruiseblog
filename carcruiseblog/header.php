<?php
include("./connect_db.php") ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  
  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  
	<script type="text/javascript" 
		src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart'],'language':'ru'}]}">
	</script>
	
	<link rel="stylesheet" type="text/css" href="style/mainstyle.css">
	
	<script type="text/javascript">
		//load api package
		google.load('visualization', '1', {packages: ['corechart']});
	</script>
	
<!-- Styles required for the touch gallery -->
<style>
.touchgallery{
position: relative;
overflow: hidden;
width: 350px; /* default gallery width */
height: 270px; /* default gallery height */
background: #eee;
}
 
.touchgallery ul{
list-style: none;
margin: 0;
padding: 0;
left: 0;
position: absolute;
-moz-transition: all 100ms ease-in-out; /* image transition. Change 100ms to desired transition duration */
-webkit-transition: all 100ms ease-in-out;
transition: all 100ms ease-in-out;
}
 
.touchgallery ul li{
float: left;
display: block;
width: 350px;
text-align: center;
}
 
.touchgallery ul li img{ /* CSS for images within gallery */
max-width: 100%; /* make each image responsive, so its native width can occupy up to 100% of gallery's width, but not beyond */
height: auto;
}
</style>

<!-- Style for the image grid -->
<style>

.row {
  display: -ms-flexbox; /* IE 10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE 10 */
  flex-wrap: wrap;
  padding: 0 4px;
}

/* Create two equal columns that sits next to each other */
.column {
  -ms-flex: 50%; /* IE 10 */
  flex: 50%;
  padding: 0 4px;
}

.column img {
  margin-top: 8px;
  vertical-align: middle;
}

</style>

<!-- Script to handle the touchscreen -->
<script>

function ontouch(el, callback){
 
    var touchsurface = el,
    dir,
    swipeType,
    startX,
    startY,
    distX,
    distY,
    threshold = 150, //required min distance traveled to be considered swipe
    restraint = 100, // maximum distance allowed at the same time in perpendicular direction
    allowedTime = 500, // maximum time allowed to travel that distance
    elapsedTime,
    startTime,
    handletouch = callback || function(evt, dir, phase, swipetype, distance){}
 
    touchsurface.addEventListener('touchstart', function(e){
        var touchobj = e.changedTouches[0]
        dir = 'none'
        swipeType = 'none'
        dist = 0
        startX = touchobj.pageX
        startY = touchobj.pageY
        startTime = new Date().getTime() // record time when finger first makes contact with surface
        handletouch(e, 'none', 'start', swipeType, 0) // fire callback function with params dir="none", phase="start", swipetype="none" etc
        e.preventDefault()
 
    }, false)
 
    touchsurface.addEventListener('touchmove', function(e){
        var touchobj = e.changedTouches[0]
        distX = touchobj.pageX - startX // get horizontal dist traveled by finger while in contact with surface
        distY = touchobj.pageY - startY // get vertical dist traveled by finger while in contact with surface
        if (Math.abs(distX) > Math.abs(distY)){ // if distance traveled horizontally is greater than vertically, consider this a horizontal movement
            dir = (distX < 0)? 'left' : 'right'
            handletouch(e, dir, 'move', swipeType, distX) // fire callback function with params dir="left|right", phase="move", swipetype="none" etc
        }
        else{ // else consider this a vertical movement
            dir = (distY < 0)? 'up' : 'down'
            handletouch(e, dir, 'move', swipeType, distY) // fire callback function with params dir="up|down", phase="move", swipetype="none" etc
        }
        e.preventDefault() // prevent scrolling when inside DIV
    }, false)
 
    touchsurface.addEventListener('touchend', function(e){
        var touchobj = e.changedTouches[0]
        elapsedTime = new Date().getTime() - startTime // get time elapsed
        if (elapsedTime <= allowedTime){ // first condition for awipe met
            if (Math.abs(distX) >= threshold && Math.abs(distY) <= restraint){ // 2nd condition for horizontal swipe met
                swipeType = dir // set swipeType to either "left" or "right"
            }
            else if (Math.abs(distY) >= threshold && Math.abs(distX) <= restraint){ // 2nd condition for vertical swipe met
                swipeType = dir // set swipeType to either "top" or "down"
            }
        }
        // Fire callback function with params dir="left|right|up|down", phase="end", swipetype=dir etc:
        handletouch(e, dir, 'end', swipeType, (dir =='left' || dir =='right')? distX : distY)
        e.preventDefault()
    }, false)
}
 
window.addEventListener('load', function(){
     var el = document.getElementById('swipegallery') // reference gallery's main DIV container
     var gallerywidth = el.offsetWidth
     var ul = el.getElementsByTagName('ul')[0]
     var liscount = ul.getElementsByTagName('li').length, curindex = 0, ulLeft = 0
     ul.style.width = gallerywidth * liscount + 'px' // set width of gallery to parent container's width * total images
 
     ontouch(el, function(evt, dir, phase, swipetype, distance){
        if (phase == 'start'){ // on touchstart
           ulLeft = parseInt(ul.style.left) || 0 // initialize ulLeft var with left position of UL
        }
        else if (phase == 'move' && (dir =='left' || dir =='right')){ //  on touchmove and if moving left or right
            var totaldist = distance + ulLeft // calculate new left position of UL based on movement of finger
            ul.style.left = Math.min(totaldist, (curindex+1) * gallerywidth) + 'px' // set gallery to new left position
        }
        else if (phase == 'end'){ // on touchend
            if (swipetype == 'left' || swipetype == 'right'){ // if a successful left or right swipe is made
                curindex = (swipetype == 'left')? Math.min(curindex+1, liscount-1) : Math.max(curindex-1, 0) // get new index of image to show
            }
            ul.style.left = -curindex * gallerywidth + 'px' // move UL to show the new image
        }
    }) // end ontouch
}, false)

</script>
  
  <title>The Car Cruise Blog </title>
</head>

</head>
<body>

	<div class="container-fluid no-padding"> <!-- containers are 1200px wide with default 15px padding -->
		<div class="row">
		  <div class="col-md-12">

			<img class="img-fluid float-center img-responsive" src="redcar3.jpg" alt="Page header image" width="100%"/>

		  </div> <!-- col -->
		</div> <!-- row -->
	</div><!-- container -->

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="list-group list-group-flush">
	  <?php
	  // Print the user name at the top of the menu list when logged in
	  $cookie_name = "user_id";
	  if(isset($_COOKIE[$cookie_name])) 
	  {
		  echo "<p class=\"list-group-item list-group-item-action bg-light\" style=\"color: Maroon; \">Welcome " . $_COOKIE[$cookie_name] . "</p>" ; 
	  }
	  else
	  {
		  echo "<p class=\"list-group-item list-group-item-action bg-light\" style=\"color: Maroon; \">Site Menu</p>" ; 
	  }
	  ?>
		  <a href="./index.php" class="list-group-item list-group-item-action bg-light" style="color: black; ">Home Page</a>
		  <a href="./scene.php" class="list-group-item list-group-item-action bg-light" style="color: black;">The Scene</a>
		  <a href="./contact.php" class="list-group-item list-group-item-action bg-light" style="color: black;">Contact</a>
		  <a href="./admin.php" class="list-group-item list-group-item-action bg-light" style="color: black;">Administration</a>
		  <a href="./newuser.php" class="list-group-item list-group-item-action bg-light" style="color: black;">Registration</a>
		  <a href="./login.php" class="list-group-item list-group-item-action bg-light" style="color: black;">Login</a>
      <a href="./logout.php" class="list-group-item list-group-item-action bg-light" style="color: black;">Logout</a>
      <a href="./userupd.php" class="list-group-item list-group-item-action bg-light" style="color: black;">Update details</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-danger" id="menu-toggle"> Show/Hide Menu </button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
				aria-controls="navbarSupportedContent" 
				aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" style="color: black;" href="./index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="color: black;" href="./login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="color: black;" href="./logout.php">Logout</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="color: black;" href="./admin.php">Administration</a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <h3 class="mt-4" style="text-align: center; color: Maroon;">The Car Cruise Blog</h3>
		
		<!-- Page content starts here -->
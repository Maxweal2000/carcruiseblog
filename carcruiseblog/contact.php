<?php include("./header.php") ; ?>
<!-- Status message -->
<?php
$message_sent = false;
if(isset($_POST['email']) && $_POST['email'] != '') {

    if( filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){

        //SUBMIT THE FORM
        $userName = $_POST['name'];
        $userEmail = $_POST['email'];
        $messageSubject = $_POST['subject'];
        $message = $_POST['message'];

        $to = "alyssa.maxwell@hotmail.co.uk";
        $body = "";

        $body .= "From: ".$userName. "\r\n";
        $body .= "Email: ".$userEmail. "\r\n";
        $body .= "Message: ".$message. "\r\n";

        //will not use the send email to my email as smtp does not work
        //mail($to,$messageSubject,$body);

        $message_sent = true;

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact form</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
        <form action="submitted.php" method="POST" class="form">
            <div class="form-group">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Jane Doe" tabindex="1" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="jane@doe.com" tabindex="2" required>
            </div>
            <div class="form-group">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Hello There!" tabindex="3" required>
            </div>
            <div class="form-group">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" rows="5" cols="50" id="message" name="message" placeholder="Enter Message..." tabindex="4"></textarea>
            </div>
            <div>
                <button type="submit" class="btn">Send Message!</button>
            </div>
        </form>
    </div>
    <?php
    ?>
</body>

</html>
  <!-- Expanded image -->
  <img id="expandedImg" style="width:100%">	
<div id="googleMap" style="width:100%;height:400px;"></div>

<script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:5,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>
	
<!-- map section -->	

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d36553.41984245614!2d-3.6458321207058764!3d55.06793982364504!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4862b098a2e191d3%3A0xf6ed72c932b2e2a9!2sDumfries!5e0!3m2!1sen!2suk!4v1604263968067!5m2!1sen!2suk" width="900" height="500" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

    <footer id="address">
  <p class="h1">Our location </p>
  <p >The local Theatre Company </p> 
  <p >Dumfries and Galloway </p> 
    <p>DG1 2XX</p>
  

<footer id="contact">
  <p class="h2">Contact us by email or phone below</p>
  <div class="button"><a href = "mailto: 1900187@student.dumgal.ac.uk">thescene@gmail.com</a>
  <div class="button"><a href = "">+44 7485838234</a>




<?php include("./footer.php") ; ?>	
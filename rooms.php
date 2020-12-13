<?php

// Get Parameters 
$roomname = $_GET['roomname'];
//Connecting to database 
include 'db_connect.php';
// Execute sql to check whether the room exists
$sql = "SELECT * FROM `rooms` WHERE roomname = '$roomname'";
$result = mysqli_query($conn, $sql);
if($result)
{
	//Check if room exists
	if(mysqli_num_rows($result) == 0)
		$message = "The room does not exist. Try Creating new one";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/chatroom";';
	echo '</script>';
}
else 
{
	echo "Error : ". mysqli_error($conn);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
      <!-- Custom styles for this template -->
    <link href="css/product.css" rel="stylesheet">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.anyClass {
  height: 350px;
  overflow-y: scroll;
}
</style>
</head>

<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
   <p class="h5 my-0 me-md-auto fw-normal">MyChatroom</p>
  <nav class="my-2 my-md-0 me-md-3">
  </nav>
</div>
<h2>Chat Messages - <?php echo $roomname; ?> </h2>

<div class="container">
	<div class="anyClass">
 <div class="time-right">
  <div class="darker">
  </div>
 </div>
</div>
</div>


<input type="text" class = "form-control" name ="usermsg" id ="usermsg" placeholder = "Add message"><br>
<button class ="btn btn-dark" name ="submitmsg" id ="submitmsg">Send</button>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
 <script type="text/javascript">

  //Check for new msg every second
  setInterval(runFunction, 1000)
  function runFunction()
  {
    $.post("htcont.php", {room:'<?php echo $roomname ?>'},
        function(data, status)
        {
          document.getElementsByClassName('anyClass')[0].innerHTML = data;
        }




      )
  }

  var input = document.getElementById("usermsg");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("submitmsg").click();
  }
});
 	//If user submits the form
 	
 	$("#submitmsg").click(function(){
    var clientmsg = $("#usermsg").val();
  $.post("postmsg.php", {text: clientmsg, room:'<?php echo $roomname ?>', ip :'<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
  function(data, status){
  	document.getElementsByClassName('anyClass')[0].innerHTML = data;});
  $(usermsg).val("");
  	return false;
  });
 </script>  
</body>
</html>

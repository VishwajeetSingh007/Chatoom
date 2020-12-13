<?php
//Getting the value of Post Parameters

$room = $_POST['room'];

// Checking String Size
if(strlen($room)>20 or strlen($room)<2)
{
	$message = "Please choose a name between 2 to 20 characters";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/chatroom";';
	echo '</script>';
}
// Checking whether room name is alphanumeric character
else if(!ctype_alnum($room))
{
	$message = "Please choose an alphanumeric room name";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/chatroom";';
	echo '</script>';
}
else
{
	// Connect to Database
	include 'db_connect.php';
}

//Check if room already exists
$sql = "SELECT * FROM `rooms` WHERE roomname = '$room'";
$result = mysqli_query($conn,$sql);
if($result)
{
	if(mysqli_num_rows($result) > 0)
	{
	$message = "Please choose a different room name .It seems to be already created";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/chatroom";';
	echo '</script>';	
	}
else 
{
 $sql = "INSERT INTO `rooms` ( `roomname`, `stime`) VALUES ('$room', current_timestamp());";
 if(mysqli_query($conn,$sql))
 {
 	$message = "You are all set to Chat ";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/chatroom/rooms.php?roomname=' . $room. '";';
	echo '</script>';	
 }
}
}
else
{
	echo "Error". mysqli_error($conn);
}
mysqli_close($conn);
?>
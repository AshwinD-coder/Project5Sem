<?php

session_start();

if(!isset($_SESSION['access_token'])){
	header("Location: login.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<title>My profile</title>
</head>
<body>
	<!--
<div class="container" style="margin-top: 100px">
	<div class="row justify-content-center">
		<div class="col-md-3">
			<img src="<?php //echo $_SESSION['userData']['picture']['url'] ?>">
		</div>

		<div class="col-md-9">
			<table class="table table-hover table-bordered">
				<tbody>
					<tr>
						<td>ID</td>
						<td><?php //echo $_SESSION['userData']['id'] ?></td>
					</tr>
					<tr>
						<td>First Name</td>
						<td><?php //echo $_SESSION['userData']['first_name'] ?></td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td><?php //echo $_SESSION['userData']['last_name'] ?></td>
					</tr>
					<tr>
						<td>Email</td>
			<td><?php //echo $_SESSION['userData']['email'] ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
 </div> -->
<?php

$_SESSION['username']=$_SESSION['userData']['first_name'];

$fullname=$_SESSION['userData']['first_name'].' '.$_SESSION['userData']['last_name'];

$_SESSION['Email']=$_SESSION['userData']['email'];
$email=$_SESSION['Email'];
include('../connection.php');

$result=mysqli_query($conn,"SELECT * FROM users WHERE fullname='$fullname' AND email='$email'");
$result=mysqli_fetch_row($result);
if($result==null)
{
$query="INSERT INTO users(fullname,email) VALUES('$fullname','$email')";
$update=mysqli_query($conn,"UPDATE users SET verified='1' WHERE email='$email' ");
$insert=mysqli_query($conn,$query);
}
if(isset($_SESSION['id'])){
echo "<script>window.location='../contactinfo.php'</script>";
}
else{
echo 	"<script>window.location='../index.php'</script>";

}
?>



</body>
</html>
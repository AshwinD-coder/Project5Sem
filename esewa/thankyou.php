
 
<?php
session_start();
include '../connection.php';

$nop=$_SESSION['nop'];
$id=$_SESSION['id'];
$query="SELECT * FROM availableflights WHERE id='$id'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$pass=$row['passenger_s'];
$totalseats=$row['Totalseats'];
$user=$_SESSION['username'];
    
$pass=$pass+$nop;
if($pass>0){
    mysqli_query($conn, "UPDATE availableflights SET status='Booking In Progress' WHERE id='$id'");
    }
mysqli_query($conn, "UPDATE availableflights SET passenger_s='$pass' WHERE id='$id'");
$query="UPDATE contact SET BookingStatus='Booked' where user_name='$user'";
   mysqli_query($conn,$query)
              or die (mysqli_error("Error"));
$pop="SELECT * FROM contact WHERE user_name='$user'";
$res=mysqli_query($conn,$pop); 
$col=mysqli_fetch_assoc($res);
$email=$col['Email'];
        mail($email,'Test Subject','Thank you for booking.','From: nepairltd@gmail.com');
    header('location:thankyou2.php');

?>


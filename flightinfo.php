<?php

include('partials/navbar.php');


?>

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<link rel="stylesheet" href="partials/style.css?<?php echo time(); ?>" type="">
<head>

    <style>
        .heading{
            font-family:'Times New Roman', Times, serif;
        padding: 20px;
        text-align: center;
        }
        a{
            padding: 0px;
        }
    </style>
</head>
<body>
<?php
$user=$_SESSION['username'];
?>

<div class="heading">
<h3><?php echo "$user";?>'s Flight Information</h3><hr>
</div><br><br><br>


<?php
$query="SELECT * FROM contact WHERE user_name='$user'";  
$result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)>0){
            echo "<div class='container'>
    <table class='table table-light'>
       <tr>
        <th>Flight NO</th>
        <th>Status</th>
        <th>From</th>
        <th>To</th>
        <th>Departure date</th>
        <th>Departure time</th>
        <th>Passengers</th>
        <th>Cabin</th>
        <th>Booked(Date/Time)</th>
        <th style='text-align:center; '  colspan=2'>Manage Flight</th>


        
        
        
</tr>";
        	while(($row = mysqli_fetch_row($result))!=null)
	{   echo "<tr><td> $row[11] </td><td> $row[0] </td>";
        $f=$row[11];
    $id=trim($f,"NA-");
   
    $query2="SELECT * FROM availableflights WHERE id='$id'";
    $result2=mysqli_query($conn,$query2);
    if(mysqli_num_rows($result2)>0){
        while(($row2 = mysqli_fetch_row($result2))!=null)
{   echo "<td> $row2[1] </td><td> $row2[2] </td><td> $row2[3] </td><td> $row2[9] </td><td> $row[12] </td><td> $row2[5] </td><td>$row[13]</td>";
    $id=$row[11];
  $bookeddatetime=$row[13];
  $nop=$row[12];
    if($row[0]=='Booked')
    {echo "<td><a href='cancel.php?id=$id&&bookeddatetime=$bookeddatetime'><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#exampleModalCenter'>
   Cancel Flight
  </button></a></td>
  <td><a href='toPDF.php?id=$id&&bookeddatetime=$bookeddatetime&&nop=$nop'><button type='button' class='btn btn-success' >
  E-ticket
 </button></a></td>
  ";
}
   if($row[0]=='Cancelled'){
  echo "<td><a href='index.php'><button type='success' class='btn btn-success' data-toggle='modal' data-target='#exampleModalCenter'>
  Reschedule flight
 </button></a></td><td></td> ";
    }

}}}}
else{
    echo "<center>Please book a flight to view your flight information.<br>
    <a href='index.php' style='text-decoration:none; color:Blue;'>BOOK HERE</a></center>";
}
?>

    </table>
</div>
</body>

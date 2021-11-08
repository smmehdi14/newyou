<?php

 
$email= $_POST['email'];


 
global $con;
$con= mysqli_connect('localhost', 'newyou', '12345','newbtl' );

if (!$con) {
die("Connection failed: " . mysqli_connect_error());
}

$res = mysqli_query($con,"SELECT * FROM payment WHERE email = '".$email."' LIMIT 1");
$num_rows = mysqli_num_rows($res);
if ($num_rows == 0) {
     mysqli_query($con,"Insert into payment set email = '".$email."' ");
     $last_id = mysqli_insert_id($con);
    echo json_encode(["id"=>$last_id]);
}else{
    while ( $row = mysqli_fetch_array ( $res ) ){

        echo json_encode(["id"=>$row['id']]);
}
}

// $row = mysqli_fetch_array($res);

// while ( $row = mysqli_fetch_array ( $resss ) ){


// $id=$row['transaction_id'];
// $time=$row['transaction_time'];
// $date=$row['tarnstion_date'];
// }

// mysqli_query($con,"Insert into ewallet_transfer set customer_frm_id='$customer_frm_id' ") ;

?>
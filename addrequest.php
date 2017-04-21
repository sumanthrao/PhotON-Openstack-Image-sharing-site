<?php
 session_start();
 $friend=$_GET['name'];
 var_dump($friend);
    $username=$_SESSION['user'];
    $m = new MongoClient();
   // select a database
   $db = $m->mydb;
    $collection = $db->users;
    //$collection->update(array("uname"=>$username),array('$push' => array("friend_requests",$friend)));
    //$collection->update("uname"=>$username,array('$push' , "friend_request"=>$friend));
    $filter = array('uname'=>$username);
$update = array('$push'=>array('friend_requests'=>$friend));
$collection->update($filter,$update);

header("Location: profile.php");
    
    




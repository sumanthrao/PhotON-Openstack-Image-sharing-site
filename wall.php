<?php

   $m = new MongoClient();
   session_start();
   $user=$_SESSION['user'];
   
   $user='sumanth';
   // select a database
   $db = $m->mydb;
   $gridFS = $db->getGridFS();
   $collection = $db->users ;
  // $res = $collection->find(array('uname' => $user));
 //while($ress = $res->getNext()): 
 //$ress = $res->getNext() ;
 //endwhile;

$fruitQuery = array('uname' => $user);
$s=array('friend_requests'=>$all);
$cursor = $collection->find($fruitQuery);
//var_dump($cursor->);




 
  // var_dump($res);


//var_dump($objects);
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Uploaded Images</title>
<link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
<div id="contentarea">
<div id="innercontentarea">
<h1>Uploaded Images</h1>
<table class="table-list" cellspacing="0"
cellpadding="0">
<thead>
<tr>
<th width="40%">Caption</th>
<th width="30%">Filename</th>
<th width="*">Size</th>
</tr>
</thead>
<tbody>
<?php
foreach ($cursor as $doc) {
    if($doc['friend_requests']!=NULL){
        
        if($doc['friend_requests']!=NULL){
            for($i=1;$i<count($doc['friend_requests']);$i++){
            $user=$doc['friend_requests'][$i];
            $objects = $gridFS->find(array('user' => $user));

 while($object = $objects->getNext()): 
 $object = $objects->getNext() ;?>
<tr>
<td>
<?php echo $object->file['caption'];?>
</td>
<td>

<?php echo $object->file['filename'];
    echo "<img src='image.php?id=".$object->file['_id']."' width='200px'>";

    
    ?>

<?php endwhile;
            }
        }
    }
}
?>
<button onclick="logout.php">Logout</button>
</tbody>
</table>
</div>
</div>
</body>
</html>
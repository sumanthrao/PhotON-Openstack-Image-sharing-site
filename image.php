<?php
$id = $_GET['id'];

 $m = new MongoClient();
	
   
   // select a database
   $db = $m->mydb;
   $gridFS = $db->getGridFS();
//query the file object
$object = $gridFS->findOne(array('_id' => new MongoId($id)));
//set content-type header, output in browser
header('Content-type: '.$object->file['filetype']);
echo $object->getBytes();
?>

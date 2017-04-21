<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SnapShare</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/thumbnail-gallery.css" rel="stylesheet">
<style>
#box {
    width: 90%;
    
    border: 15px solid gray;
    padding: 40px;
    margin: 30px;
    position:relative;
}
.mypic{
   width : 50%;
   height:30%;
   border: 5px solid gray;
    padding: 3px;
    margin: 30px 30px 30px 300px ; 
    background: #D3D3D3;


}
#capt{
  
  float: center;
  margin: 10px 10px 10px 300px;
    width: 50%;
    padding:15px;
      background: #D3D3D3;

}
#name{
  float: center;
  margin: 10px 10px 10px 300px;
    width: 50%;
    padding:15px;
    background: #D3D3D3;

}
</style>
    <body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style="font-size:300%;height:100px;margin-left:-40px;padding:30px 30px;">SnapShare</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="Upload.php" style="font-size:150%;height:100px;padding:30px;" >Home</a>
                    </li>
                    <li>
                        <a href="profile.php"  style="font-size:150%;height:100px;padding:30px;">Profile</a>
                    </li>
                    <li>
                        <a href="#"  style="font-size:150%;height:100px;padding:30px">Contact</a>
                    </li>
                    <li>
                        <a href="logout.php"  style="font-size:150%;height:100px;padding:30px">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <br>
   <br>
   <br>
   <br> 
   <br>
<div id="box">
<?php
  error_reporting(0);
  $m = new MongoClient();
	session_start();
    
   
   // select a database
   $db = $m->mydb;
$action = (isset($_POST['upload']) && $_POST['upload'] === 'Upload') ? 'upload' : 'view';
switch($action) {
case 'upload':
//check file upload success
if($_FILES['image']['error'] !== 0) {
die('Error uploading file. Error code '. $_FILES['image']['error']);
}
//connect to MongoDB sevrer

//get a MongoGridFS instance
$gridFS = $db->getGridFS();
$filename = $_FILES['image']['name'];
$filetype = $_FILES['image']['type'];
$tmpfilepath = $_FILES['image']['tmp_name'];
$caption = $_POST['caption'];
$user = $_SESSION['user'];
//storing the uploaded file
$id = $gridFS->storeFile($tmpfilepath, array('filename' => $filename,
'user' => $user,
'filetype' => $filetype,
'caption' => $caption));
break;
default:
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css"
href="styles.css"/>
<title>Upload Files</title>
</head>
<body>
<div id="contentarea">
<div id="innercontentarea">
<h1>Upload Image</h1>
<?php if($action === 'upload'): ?>
<h3>File Uploaded. 

<br>
	<script>alert("Image has been safely stored in GridFS ! redirecting you to snapwall ");
		setTimeout(function(){location.href="Upload.php"} , 500);</script>

</h3>
<?php else: ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>"
method="post"
accept-charset="utf-8"
enctype="multipart/form-data">
<h3>Enter Caption&nbsp;
<input type="text" name="caption"/>
<h3/>
<p>
<input type="file" name="image" />
</p>
<p>
<input type="submit" value="Upload" name="upload"/>
</p>
</form>
<?php endif; ?>
</div>
</div>
</div>
</body>
</html>

<?php

   $m = new MongoClient();
   session_start();
   $user=$_SESSION['user'];
   
   
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
<title>Wall</title>
<link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
<div id="contentarea">
<div id="innercontentarea">
<h1>Wall- Friends Uploads</h1>
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
 
    <b><h3 id='name'><?php echo " $user Uploaded a pic ";?></h3></b>


<?php
    ?>  <h4 id='capt'><?php echo  $object->file['caption'] ?></h4>
    <?php
    echo "<img src='image.php?id=".$object->file['_id']."' width='300px' class='mypic'>";
    echo "<br>";?>
     
    <?php echo "<br>"; 
echo "<hr>";

     ?>
    
  

<?php endwhile;
            }
        }
    }
}
?>

</tbody>
</table>
</div>
</div>
</body>
</html>
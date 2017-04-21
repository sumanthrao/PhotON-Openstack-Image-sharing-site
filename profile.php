
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
.btn {
  background: #3a3e40;
  background-image: -webkit-linear-gradient(top, #3a3e40, #4e5457);
  background-image: -moz-linear-gradient(top, #3a3e40, #4e5457);
  background-image: -ms-linear-gradient(top, #3a3e40, #4e5457);
  background-image: -o-linear-gradient(top, #3a3e40, #4e5457);
  background-image: linear-gradient(to bottom, #3a3e40, #4e5457);
  -webkit-border-radius: 11;
  -moz-border-radius: 11;
  border-radius: 11px;
  font-family: Arial;
  color: #f5e7f5;
  font-size: 21px;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
}
.btn:hover {
  background: #d2d6d9;
  background-image: -webkit-linear-gradient(top, #d2d6d9, #8e9599);
  background-image: -moz-linear-gradient(top, #d2d6d9, #8e9599);
  background-image: -ms-linear-gradient(top, #d2d6d9, #8e9599);
  background-image: -o-linear-gradient(top, #d2d6d9, #8e9599);
  background-image: linear-gradient(to bottom, #d2d6d9, #8e9599);
  text-decoration: none;
}
    </style>
</head>
<script>
    function func(value,id){
        alert("You are now following "+value);
}
</script>
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
                        <a href="#"  style="font-size:150%;height:100px;padding:30px;">Profile</a>
                    </li>
                    <li>
                        <a href="#"  style="font-size:150%;height:100px;padding:30px">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <br>
    <br>
<div><?php
    error_reporting(0);
     session_start();
     $m = new MongoClient();
	 $db = $m->mydb; 
     $collection = $db->users;
$details=$collection->find(array('uname'=>$uname));
$cursor1 = $collection->find();?>
<h1>Your Profile</h1>
<h2><?php echo $_SESSION['user'] ;?></h2>

<div><?php
$document = $cursor1->getNext();

echo "<hr/><h2>People You May Know </h2><hr/>";

while ($cursor1->hasNext()):
                         $document = $cursor1->getNext();
                           
                         $user_name= $document['uname'];  
                         if($user_name != $_SESSION['user']){
     
                         echo "<div class='col-lg-3 col-md-4 col-xs-6 thumb'>";
                         echo "<img src='images.jpg'>";
                         echo "<h3 id='myspan' style='width:10%'>$user_name</h3>";
                         echo "<form action='addrequest.php?name=".$user_name."' >";
                         echo "<button class='btn' type='submit' method=get name='name' onclick='func(this.value,this.id)' id=$user_name value=$user_name> Follow </button>";
                         echo "</a>";
                        echo "</div>";  
                         }                  
                        
                         
                         
endwhile;
echo "<br>";
echo "<br>";


   
   $user=$_SESSION['user'];
   
   
   // select a database
   $db = $m->mydb;
   $gridFS = $db->getGridFS();
   $collection = $db->users ;
  // $res = $collection->find(array('uname' => $user));
 //while($ress = $res->getNext()): 
 //$ress = $res->getNext() ;
 //endwhile;

$cursor=$gridFS->find(array('user'=>$user));




 
  // var_dump($res);


//var_dump($objects);
?>
   </div> 
   </div>
    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Your Uploads</h1>
            </div>

            
               
                    
                    <?php
                    
$cursor=$gridFS->find(array('user'=>$user));

   while($object = $cursor->hasNext()): 
        $object = $cursor->getNext() ;

      
      echo " <div class='col-lg-3 col-md-4 col-xs-6 thumb'>";
      echo " <a class='thumbnail' href='#'>";

     echo "<img src='image.php?id=".$object->file['_id']."'  class='img-responsive' >";
     echo $object->file['caption'];
     echo "</a>";
     echo "</div>";

    
    ?>

    <?php endwhile;
            
            ?>

        <hr>
        <br>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p></p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

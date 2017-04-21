	
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login-1.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/Pretty-Header.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
	  <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<?php
	
	session_start();
     $m = new MongoClient();
	 $db = $m->mydb;
     
	if(isset($_SESSION['user'])!="") {
        
	?>
		<script>
				alert("You are already registered. Please log out to register again. Redirecting to homepage..");
						location.href="Upload.php";
			
		</script>
	<?php
	}

	if(isset($_POST['btn-signup'])) {
        if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
		$uname = ($_POST['uname']);
		$email = ($_POST['email']);
		$upass = ($_POST['password']);
		$phone = ($_POST['phone']);
		
	$_SESSION['user']=$uname;
    $collection = $db->users;
   
	
   $document = array( 
      "uname"=>$uname,
      "email"=>$email,
      "upass"=>$upass,
      "phone"=>$phone,
      "friend_requests"=>['']
   );
    
  $ins= $collection->insert($document);
   if($ins){?>			
	   <script>alert('Successfully registered! You are being redirected to homepage.');
					location.href="Upload.php";
			</script>
       
	<?php
    }
	}	
	?>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">SnapShare </a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="active" role="presentation"><a href="#">English </a></li>
                    <li class="active" role="presentation"><a href="#">Hindi </a></li>
                    <li class="active" role="presentation"><a href="#">Kannada </a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li role="presentation"><a href="login.php">LOGIN </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="login-card"><img src="assets/img/avatar_2x.png" class="profile-img-card">
        <p class="profile-name-card"> </p>
        <form class="form-signin" method=post action='signup.php'><span class="reauth-email"> </span>
            <input class="form-control"  name="uname" required="" placeholder="Username" autofocus="" id="inputEmail">
            <input class="form-control" type="email" required="" name="email" placeholder="Email address" autofocus="" id="inputEmail">
            <input class="form-control" type="password" required="" name="password" placeholder="password" autofocus="" id="inputEmail">
            <input class="form-control" type="text" required="" name="phone" placeholder="Phone" autofocus="" id="inputEmail">
            <div class="checkbox">
                <div class="checkbox">
                    <label>
                        <input type="checkbox">Remember me</label>
                </div>
            </div>
            <button class="btn btn-primary btn-block btn-lg btn-signin" name="btn-signup" type="submit">Sign in</button>
        </form>
    </div>
  
</body>


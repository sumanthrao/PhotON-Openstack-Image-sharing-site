<?php
    
	session_start();
    $m = new MongoClient();
	 $db = $m->mydb; 

	if(isset($_SESSION['user'])!="") {
	?>
		<script>alert("You are already logged in. Redirecting to home page");
		setTimeout(function(){location.href="Upload.php"} , 500);</script>
	
		
	

    <?php }
	
		if(isset($_POST['login'])){
        
			$postedUsername = $_POST['username']; //Gets the posted username, put's it into a variable.
			$postedPassword = $_POST['password']; //Gets the posted password, put's it into a variable.
			$userDatabaseSelect = $db->users; //Selects the user collection
			$userDatabaseFind = $userDatabaseSelect->find(array('uname' => $postedUsername)); //Does a search for Usernames with the posted Username Variable
				
				//Iterates through the found results
				foreach($userDatabaseFind as $userFind) {
				    $storedUsername = $userFind['uname'];
				    $storedPassword = $userFind['upass'];
				
                
	            
				if($postedUsername == $storedUsername && $postedPassword == $storedPassword){ 
                    
					$_SESSION['user'] = $postedUsername;
                    
                    
                    header("Location: Upload.php");

					
            
				
                }
				
                }
			}
    
?>



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/css/home.css">
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">SnapShare </a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav navbar-right">
                    <li role="presentation"><a href="signup.php">SIGNUP </a></li>
                </ul>
           
            </div>
        </div>
    </nav>
    <div class="login-card"><img src="assets/img/avatar_2x.png" class="profile-img-card">
        <p class="profile-name-card"> </p>
        <form  class="form-signin" method=post action='login.php'><span class="reauth-email"> </span>
        
            <input class="form-control" type="text" name="username" required="" placeholder="Username" autofocus="" id="inputEmail">
            <input class="form-control" type="password" name="password" required="" placeholder="Password" id="inputPassword">
            <div class="checkbox">
                <div class="checkbox">
                    <label>
                        <input type="checkbox">Remember me</label>
                </div>
            </div>
            <button class="btn btn-primary btn-block btn-lg btn-signin" name="login" type="submit">login</button>
        </form><a href="#" class="forgot-password">Forgot your password?</a></div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>




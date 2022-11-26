<?php
$db_username = 'root';
$db_password = '';
$db_name = 'rocket';
$db_host = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password,$db_name);
$loginsucces ='';
$error = '';
if(isset($_POST['login']))
{   
    $username = $_POST['username']; 
    $password = $_POST['password']; 
	

    $requete = "SELECT * FROM signup where 
    username = '".$username."' and password = '".$password."' ";
    $exec_requete = mysqli_query($db,$requete);
    $reponse = mysqli_fetch_array($exec_requete);

   
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
   

    if($username == '' || $password == '')
    {
        $error = 'veuillez saisir votre username et password';
    }else if($username == 'admin' && $password == 'admin'){
        session_start();
        $_SESSION['user'] = $_POST['username'];
        header('Location: adminstuff/welcomeadmin.php');
    }
    else if(strlen($password) < 8)
    {
        $error = 'votre password doit etre > 8 char';
    }else if(!$reponse){

        $error = 'username ou password invalid';
    }
    else{
        session_start();
        $_SESSION['user'] = $_POST['username'];
        header('Location: welcome.php');
    }

}
   
?>

<head> 
    <html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>StackUnderflow</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel='stylesheet' type='text/css' media='screen' href='stack.css'>


    <script>
    // Prevent dropdown menu from closing when click inside the form
    $(document).on("click", ".action-buttons .dropdown-menu", function(e){
        e.stopPropagation();
    });
    </script>
    <script>
    // hide msg after 5s
    function hideMessage() {
        document.getElementById("connectMsg").style.display = "none";
    };
    setTimeout(hideMessage, 5000);

    </script>
</head>
<div class="area">
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-inverse">
		<a href="index.php" class="navbar-brand">Stack<b>Under</b>Flow</a>  		
		<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
			<div class="navbar-nav nav">
				<a href="#" class="nav-item nav-link">Home</a>
				<a href="#" class="nav-item nav-link">About</a>			
				<div class="nav-item dropdown">
					<a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle">Services</a>
					<div class="dropdown-menu">					
						<a href="#" class="dropdown-item">Web Design</a>
						<a href="#" class="dropdown-item">Web Development</a>
						<a href="#" class="dropdown-item">Graphic Design</a>
						<a href="#" class="dropdown-item">Digital Marketing</a>
					</div>
				</div>
				<a href="#" class="nav-item nav-link">Contact</a>
			</div>
			<form class="navbar-form form-inline">
				<div class="input-group search-box">								
					<input type="text" id="search" class="form-control" placeholder="Search here...">
					<div class="input-group-append">
						<span class="input-group-text">
							<i class="material-icons"></i>
						</span>
					</div>
				</div>
			</form>
		</div>
	</nav>

    <div id="login">
        <div class="container mt-4">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                    <div class="error">
                        <?php if(isset($error))
                                {
                                    echo $error;
                                }?>
                        </div>
                        <form id="login-form" class="form" action="login.php" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                               
                            </div>
                            
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control" >
                                
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" class="btn btn-info btn-md" value="LOGIN" id="login" name="login">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="index.php" class="text-info">Register here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body> 



   <?php
   session_start();
    $db_username = 'root';
    $db_password = '';
    $db_name = 'rocket';
    $db_host = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name);
	include 'functions.php';
    $userquestion=$_GET['userquestion'];
    $questions=$_GET['question'];
	?>




<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>StackUnderflow</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	<link rel='stylesheet' type='text/css' media='screen' href='welcome.css'>



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

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-inverse">
		<a href="welcome.php" class="navbar-brand">Stack<b>Under</b>Flow</a>  		
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


			<div class="navbar-nav me-0 action-buttons ">
				<div class="nav-item ">
					<p class="username">Welcome <b><?php echo $_SESSION['user'] ?></b> </p>
				</div>
			</div>
		</div>
	</nav>
	<div class="area">
		<ul class="circles">    
			<li></li>
    		<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li> 

	<div class="row ">
		<div class="post text-center">
			<section id="question">
				<div class="container text-center">
				<h1 class="title">Post a Question</h1>
					<div class="question d-flex justify-content-center ">
						<form method="POST" action="welcome.php" enctype="multipart/form-data" >
							<div class="form-group">
								<textarea name="question" id="textarea" class="form-control" cols="80">"Enter Your question here"</textarea>
							</div>
							<button type="submit" name="question_post" class="btn btn-primary">Post your</button><br>
							<?php
								$info = selectuser($_SESSION['user']);
								$user_id = $info["id"];
									if(isset($_POST['question_post'])){
										$question = $_POST['question'];
										$query = "INSERT into question (question , user_id)
											VALUES ('$question', '$user_id')";
										$res = mysqli_query($db, $query);
											if($res){
												$questionsucces = "Your question has been posted successfully :D";
												  echo "<p style='color: #33cabb; font-size: 12px; margin-left: auto; margin-top: 20px;'>$questionsucces</p>";
											}
									}		
							?>
						</form>  
					</div>                      
				</div>
			</section>
		</div>
		
		<div class="desc mt-4" >	
				<div>
					<form action="get">						
                        <div class="row">
                            <div class="col-md-1">
                                <img src="imgs/images.png" class="user_img" width="50px" height="50px">
                            </div>
                            <div class="col-md-5">
                                <p class="user_name"><?php echo $userquestion ?></p>
                            </div>
                        </div>
                        <div class="col-12">
                            <textarea name="" class="show_question form-control text-start">
								<?php
									echo $questions;
							  	?>
							</textarea>
                        </div>
					</form>
				</div>
				<div>
					<span class="unlike fa fa-thumbs-up" data-id="<?php echo $row['id']; ?>"></span> 
					<span class="like hide fa fa-thumbs-o-up" data-id="<?php echo $row['id']; ?>"></span> 
				</div>	

		</div>
	</div>
</body>
 
		</ul>
    </div >
</html>
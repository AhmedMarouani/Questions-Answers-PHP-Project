
   <?php
    $db_username = 'root';
    $db_password = '';
    $db_name = 'rocket';
    $db_host = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name);
    $succes ='';
	$strongpassword='';
	$incorrectpassword='';
	$incorrectemail='';
	$uniquemail='';
	$questionfail='';
	$usertype = 'user';

			if(isset($_POST['signup'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$email = $_POST['email'];

			$uppercase = preg_match('@[A-Z]@', $password);
			$lowercase = preg_match('@[a-z]@', $password);
			$number    = preg_match('@[0-9]@', $password);

			$unique = "SELECT count(*) FROM signup where 
			email = '".$email."' ";
			$exec_requete = mysqli_query($db,$unique);
			$reponse = mysqli_fetch_array($exec_requete);
			$count = $reponse['count(*)'];

			if((!$uppercase || !$lowercase || !$number || strlen($password) < 8) && $count!=0) {
				$incorrectpassword =  "Password should be at least 8 characters in length and should include at least one upper case letter and one number.";
				$uniquemail = "An account already associated with this email";
			}
			else{
				$strongpassword = "Your password is strong";
				$query = "INSERT into signup (username, password, email, type)
						VALUES ('$username',  '$password', '$email', '$usertype')";
				$res = mysqli_query($db, $query);
				if($res){
					$succes =  "Your sign up is a success, Please Log in.";
				}
			}		
		}
	?>
<html lang="en"><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>StackUnderflow</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
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
		<a href="#" class="navbar-brand">Stack<b>Under</b>Flow</a>  		
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
			<form class="navbar-form form-inline" method="POST" action="welcome.php">
				<div class="input-group search-box dropdown">								
					<input type="text" id="search" name="search" class="form-control dropdown-toggle" placeholder="Search here...">
					<div id="display">
					</div>
					<ul>
						<?php
						if(isset($_POST['search'])){
							$query = $_POST['search']; 
							$raw_results =mysqli_query($db, "SELECT * FROM question, signup
							WHERE question LIKE '%$query%' AND question.user_id = signup.id LIMIT 5");
							 echo '
							 <ul>
								';
								while ($results = MySQLi_fetch_array($raw_results)) {
									$searchedQuestions = $results["question"];
									$searchedQuestionname = $results["username"];
									?>
									<li onclick='fill("<?php echo $results["question"]; ?>")'>
									<a href="singlequestion.php?question=<?php echo $searchedQuestions; ?>&userquestion=<?php echo $searchedQuestionname; ?>">
										<?php echo $searchedQuestions; ?>
									</li></a>
					<?php   }	}?>
					</ul>
				</div>
			</form>
			<div class="navbar-nav ms-auto action-buttons ">
				<div class="nav-item dropdown">
					<a href="login.php" class="nav-link  mr-4">Login</a>
				</div>
				<div class="nav-item dropdown">
					<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle sign-up-btn">Sign up</a>
					<div class="dropdown-menu action-form">
						<form action="index.php" method="POST">
							<p class="hint-text">Fill in this form to create your account!</p>
							<div class="form-group mt-2">
								<input type="text" class="form-control" placeholder="Insert Username Here" name="username">
								<?php
									if(isset($_POST["username"]) && empty($_POST["username"])){
										echo " <p style='color:red; font-size:12px;'>" . "The Username Field Is Required*";}
								?>
							</div>
							<div class="form-group mt-2">
								<input type="text" class="form-control" placeholder="Insert e-mail here" name="email">
								<?php
									if(isset($_POST["email"]) && empty($_POST["email"])){
										echo " <p style='color:red; font-size:12px;'>" . "The email Field Is Required*";}
										echo $uniquemail;
								?>
							</div>
							<div class="form-group mt-2">
								<input type="password" class="form-control" placeholder="Password" name="password">
								<?php
									if(isset($_POST["username"]) && empty($_POST["password"])){
										echo " <p style='color:red; font-size:12px;'>" . "The Password Field Is Required*";}
										echo $incorrectpassword;
										echo $strongpassword;
								?>
							</div>
							<div class="form-group mt-2">
								<label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms &amp; Conditions</a></label>
							</div>
							<div class=" mt-3 d-flex justify-content-center">
								<input name="signup" type="submit" class="btn btn-primary" value="Sign up" id="signup">
							</div>
						</form>
					</div>
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
	<?php echo "<p style='color:33cabb;
	 	font-size:22px;
	  	text-align: center;
	 	margin-top:20px;'>
	 	$succes
	  	</p>"
	?>
		<div class="post col-md-4 text-center ">
			<section id="question">
				<div class="container text-center">
				<h1 class="title">Post a Question</h1>
					<div class="question d-flex justify-content-center ">
						<form method="POST" action="index.php" enctype="multipart/form-data" >
							<div class="form-group">
								<textarea name="question" id="textarea" class="form-control" cols="80" placeholder="Enter Question here"></textarea>
							</div>
							<button type="submit" name="question_post" class="btn btn-primary">Post Question here</button><br>
							<?php								
								if(isset($_POST['question_post'])){
									echo "<p style='color: red; font-size: 12px; margin-left: auto; margin-top: 20px;'>Please login first</p>";	
								}							
							?>
						</form>  
					</div>                      
				</div>
			</section>
		</div>
		<?php
			$exec_requete = mysqli_query($db, "SELECT question.id, question.question, question.accepted, question.deleted, question.user_id, question.category_id, category.category_name, signup.username FROM question 
			INNER JOIN category ON question.category_id = category.id
			INNER JOIN signup ON question.user_id = signup.id");
				if(mysqli_num_rows($exec_requete) > 0){
				while($reponse = mysqli_fetch_array($exec_requete)){
					if($reponse["deleted"] == '0' && $reponse["accepted"] == '1'){
						$questions = $reponse["question"];
						$question_id = $reponse['id'];
						$userquestion = $reponse["username"];
						$nameee = $reponse["category_name"];
						$accepted = $reponse["accepted"];
		?>
		<div class="desc mt-5">
			<a href="singlequestion.php?question=<?php echo $reponse["question"]; ?>&userquestion=<?php echo $userquestion; ?>">
			<div class="row" >	
				<div class=" col-md-1">
					<img src="imgs/images.png" class="user_img" width="50px" height="50px">
				</div>
				<div class="col-md-5">
				<p class="category"><?php
					echo $nameee ?></p>
				</div>
				<div class="col-md-5">
				<p class="user_name"><?php echo $userquestion ?></p>
				</div>
			</div>
			</a>			
				<div>									
					<span name="like" class="show_question form-control text-start">
						<?php echo $reponse["question"]; ?>
					</span>	
					<form method="POST" action="like.php">
						<ul class="thumbnail-list">
						</ul>	
					</form>
					<?php
						}	}	}	
					?>
			</div>
		</div>
</body>
	</ul>
    </div>
</html>
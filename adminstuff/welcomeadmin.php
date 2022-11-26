
   <?php
   session_start();
    $db_username = 'root';
    $db_password = '';
    $db_name = 'rocket';
    $db_host = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name);
	include 'functions.php';
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
					$succes =  "This account has been added to the database";
				}
			}		
		}
	?>




	<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>StackUnderflow</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <link rel='stylesheet' type='text/css' media='screen' href='../welcome.css'>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
	<script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>

<script>
// Prevent dropdown menu from closing when click inside the form
$(document).on("click", ".action-buttons .dropdown-menu", function(e){
	e.stopPropagation();
});
</script>
<script src="scripts.js"></script>
</head> 
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-inverse">
		<a href="welcomeadmin.php" class="navbar-brand">Stack<b>Under</b>Flow</a>  		
		<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
			<div class="navbar-nav nav">
				<a href="#" class="nav-item nav-link">Home</a>
				<a href="#" class="nav-item nav-link">About</a>			
				<div class="nav-item dropdown">
				<a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle">Show Deleted Questions<span class="caret"></span></a>
						<ul class="dropdown-menu text-center">
							<?php
								$exec_requete = mysqli_query($db, "SELECT question, deleted FROM question, signup WHERE (deleted = '1' &&  question.user_id = signup.id)");
									if(mysqli_num_rows($exec_requete) > 0){
									while($reponse = mysqli_fetch_array($exec_requete)){	
							?>
							<li>Question :<?php echo $reponse["question"];?> </li>
						</ul>
						<?php }} ?>
					<div class="dropdown-menu">					
						<a href="#" class="dropdown-item">Web Design</a>
						<a href="#" class="dropdown-item">Web Development</a>
						<a href="#" class="dropdown-item">Graphic Design</a>
						<a href="#" class="dropdown-item">Digital Marketing</a>
					</div>
				</div>
				<a href="#" class="nav-item nav-link">Contact</a>
			</div>
			<form class="navbar-form form-inline" method="POST" action="welcomeadmin.php">
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
					<?php
						}}?>
					</ul>
				</div>
			</form>
			
			<div class="nav-item dropdown">
					<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle sign-up-btn">Add user</a>
					<div class="dropdown-menu action-form">
					
						<form action="welcomeadmin.php" method="POST">
							<p class="hint-text">Fill in this form to add a user to the database</p>
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




				<div class="nav-item">
					<div class="row">
						<div class="col-md-8">
							<p class="username">Welcome <b><?php echo $_SESSION['user'] ?></b> </p>		
						</div>
						<div class="col-md-4">
							<a id="disconnect" href="../index.php" class="btn btn-primary">Disconnect</a>
						</div>
						<div class="col-md-3">
								<?php echo "<span style='color:33cabb;
								font-size:15px;
								text-align: center;
								margin-top:20px;'>
								$succes
								</span>"
								?>
						</div>
					</div>
				</div>
			</div>
	</nav>


		<div class="post text-center">
			<section id="question">
				<div class="container text-center">
				<h1 class="title">Post a Question</h1>
					<div class="question d-flex justify-content-center ">
						<form method="POST" action="welcomeadmin.php" enctype="multipart/form-data" >
							<div class="form-group">
								<textarea name="question" id="textarea" class="form-control" cols="80" placeholder="Enter Your question here"></textarea>
							</div>
							<?php 
								if(isset($_SESSION['status']))
								{
									?>
										<div class="alert alert-warning alert-dismissible fade show" role="alert">
										<strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>
									<?php
									unset($_SESSION['status']);
								}
							?>
							<div class="row">
								<div class="col-md-6">
								<button type="submit" name="question_post" class=" btn btn-primary">Post your Question</button><br>
								</div>
								<div class="w-50 p3 col-md-4 from-group mt-4">
									<select name="category" class="form-control">
									<option><i class="fa fa-caret-down">Select Questions Category</i></option>
									<?php
										$categoryquery =mysqli_query($db, "SELECT * FROM category");
										while($catreponse = mysqli_fetch_array($categoryquery)){
												?>
												<option value="<?php echo $catreponse['id']; ?>"><?php echo $catreponse['category_name']; ?></option>
										<?php } ?>
										</select>
								</div>
							</div>	
						</form>  	
					</div>
								<div class="mt-2">
									<form action="welcomeadmin.php" method="POST" >
										<div class="form-group">
											<input type="text" name="categort_name" id="categort_name" placeholder="enter category name here" class="form-control">
										</div>
										<input type="submit" name="add_category" id="add_category" class="btn btn-primary" value="add category">
										<?php if(isset($_POST['add_category'])){
										$added_category = $_POST['categort_name']; 
										$addcategoryquery = mysqli_query($db, "INSERT INTO category (category_name) VALUES ('$added_category')");
										if($addcategoryquery){
											$categorysucces = "This category has been added successfully to the database :D";
											echo "<p style='color: #33cabb; font-size: 12px; margin-left: auto; margin-top: 20px;'>$categorysucces</p>";
										}
									} 
									?>
									</form>	
								</div>
				</div>
					<?php
						$info = selectuser($_SESSION['user']);
						$user_id = $info["id"];
							if(isset($_POST['question_post'])){
								if(isset($_POST['category'])){
									$cateid = $_POST['category'];
									$question = $_POST['question'];
									$query = "INSERT into question (question, user_id, category_id )
										VALUES ('$question', '$user_id', '$cateid')";
									$res = mysqli_query($db, $query);
										if($res){
											$questionsucces = "Your question has been posted successfully :D";
											echo "<p style='color: #33cabb; font-size: 12px; margin-left: auto; margin-top: 20px;'>$questionsucces</p>";
										}
								}
							}
							
					?>
			</section>
		</div>
		
		<?php
			$exec_requete = mysqli_query($db, "SELECT question.id, question.question, question.accepted, question.deleted, question.user_id, question.category_id, category.category_name, signup.username FROM question 
			INNER JOIN category ON question.category_id = category.id
			INNER JOIN signup ON question.user_id = signup.id");
				if(mysqli_num_rows($exec_requete) > 0){
				while($reponse = mysqli_fetch_array($exec_requete)){
					if($reponse["deleted"] == '0'){
						$questions = $reponse["question"];
						$question_id = $reponse['id'];
						$userquestion = $reponse["username"];
						$nameee = $reponse["category_name"];
						$accepted = $reponse["accepted"];
		?>
		<div class="desc mt-4 " >
			<a href="../singlequestion.php?question=<?php echo $reponse["question"]; ?>&userquestion=<?php echo $reponse["username"]; ?>">
				<div class="row" >	
					<div class=" col-md-1">
						<img src="../imgs/images.png" class="user_img" width="50px" height="50px">
					</div>
					<div class="col-md-5">
						<p class="category" style="color:#7FFF00 ;"> Category : <?php echo $reponse["category_name"] ?> </p>
					</div>
					<div class="col-md-5">
						<p class="user_name"><?php echo $reponse["username"]; ?></p>
					</div>
				</div>
			</a>			
				<div>									
					<span class="show_question form-control text-start">
						<?php echo $reponse["question"];	?>
					</span>	

					<div class="mt-2">
							<div class="row">
								<div class="col-md-5">
								<?php 
									if($reponse["accepted"] == '1'){
								?>
									<a style="color:#00FFFF ;font-size: 16px;" href="accept.php?question_id=<?php echo $reponse["id"];?>">Accept Question</a>
								<?php 
									}else{
										echo "<p style='color: #00FFFF; font-size: 13px; margin-left: auto;'>
										Question Already accepted
										</p>";}				
								?>
								</div>
								<div class="col-md-6">
									<a style="color:#FBCEB1;font-size: 16px;" href="delete.php?question_id=<?php echo $reponse["id"];?>">Delete Question</a>
								</div>
							</div>
					</div>
					<?php
						}	}	}
					?>
			</div>
		</div>
	</div>
</body>
</html>
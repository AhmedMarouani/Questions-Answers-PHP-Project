<?php
session_start();
$db_username = 'root';
$db_password = '';
$db_name = 'rocket';
$db_host = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password,$db_name);
include 'functions.php';
?>


<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>StackUnderflow</title>

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel='stylesheet' type='text/css' media='screen' href='welcome.css'>
		
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script
			src="https://code.jquery.com/jquery-3.6.1.js"
			integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
			crossorigin="anonymous">
		</script>
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
			<a href="welcome.php" class="navbar-brand">Stack<b>Under</b>Flow</a>  		
			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
				<div class="navbar-nav nav">
					<a href="#" class="nav-item nav-link">Home</a>
					<a href="#" class="nav-item nav-link">About</a>			
					<div class="nav-item dropdown">
                    <select  onchange="javascript:handleSelect(this)" name="category" class="options form-control nav-item" style="text-decoration: none;">
						<option class="options" style="text-decoration: none;">Search By Category</option>
							<?php
								$categoryquery =mysqli_query($db, "SELECT * FROM category");
								while($catreponse = mysqli_fetch_array($categoryquery)){;?>
									<option value="<?php echo $catreponse['id']; ?>"><?php echo $catreponse['category_name']; ?></option>
							<?php } ?>
					</select>
						<script type="text/javascript">
							function handleSelect(elm)
							{
								window.location ="search_by_cat.php?id="+ elm.value;
							}
						</script>
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
								$raw_results =mysqli_query($db, "SELECT question.question, category.category_name, signup.username FROM question, signup, category
								WHERE (question LIKE '%$query%' OR category_name LIKE '%$query%') AND question.user_id = signup.id LIMIT 2");
								echo '
								<ul>
									';
									while ($results = MySQLi_fetch_array($raw_results)) {
										$searchedQuestions = $results["question"];
										$searchedQuestionname = $results["username"];
										?>
										<li onclick='fill("<?php echo $results["question"]; ?>")'>
										<a href="singlequestion.php?question=<?php echo $searchedQuestions; ?>&userquestion=<?php echo $searchedQuestionname; ?>">
											<?php echo $catreponse['category_name']; ?>
										</li></a>
						<?php
							}}?>
						</ul>
					</div>
				</form>
				<div class="navbar-nav me-0 action-buttons ">
					<div class="nav-item ">
						<p class="username">Welcome <b><?php echo $_SESSION['user'] ?></b> </p>
					</div>
					<div class="nav-item">
						<a href="index.php" class="btn btn-primary">Disconnect</a>
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

			<div class="post text-center">
				<section id="question">
					<div class="container text-center">
					<h1 class="title">Post a Question</h1>
						<div class="question d-flex justify-content-center ">
							<form method="POST" action="welcome.php" enctype="multipart/form-data" >
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
											<option>Select Questions Category</option>
											<?php
												$categoryquery =mysqli_query($db, "SELECT * FROM category");
												while($catreponse = mysqli_fetch_array($categoryquery)){
											?>
											<option value="<?php echo $catreponse['id']; ?>"><?php echo $catreponse['category_name']; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<?php
									$info = selectuser($_SESSION['user']);
									$user_name = $_SESSION['user'];

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
														$exec_requete = mysqli_query($db, "SELECT question.id, question.question, question.accepted, question.deleted, question.user_id, question.category_id, category.category_name, signup.username FROM question 
															INNER JOIN category ON question.category_id = category.id
															INNER JOIN signup ON question.user_id = signup.id
															ORDER BY id DESC LIMIT 1");
															$getlikes = mysqli_fetch_array($exec_requete);
															$id = $getlikes['id'];
															$res = mysqli_query($db, "INSERT INTO likes (likee, unlikee, question_id, user_name) VALUES ('0', '0', '$id', '$user_name')");
													}
											}
										}
										?>
							</form>  
						</div>                      
					</div>
				</section>
			</div>
			<?php
                $id = $_GET['id'];
				$exec_requete = mysqli_query($db, "SELECT question.id, question.question, question.accepted, question.deleted, question.user_id, question.category_id, signup.username FROM question 
				INNER JOIN signup ON question.user_id = signup.id
				WHERE question.category_id = '$id'");
					if(mysqli_num_rows($exec_requete) > 0){
						while($reponse = mysqli_fetch_array($exec_requete)){
							if($reponse["deleted"] == '0' && $reponse["accepted"] == '1' ){
								$questions = $reponse["question"];
								$question_id = $reponse['id'];
								$userquestion = $reponse["username"];
								$accepted = $reponse["accepted"];
                                
			?>
			<div class="desc mt-5">
				<a href="singlequestion.php?question=<?php echo $reponse["question"]; ?>&userquestion=<?php echo $userquestion; ?>">
				<div class="row" >	
					<div class=" col-md-1">
						<img src="imgs/images.png" class="user_img" width="50px" height="50px">
					</div>
					<div class="col-md-5">
                        <p class="category">
                        </p>
					</div>
					<div class="col-md-5">
					<p class="user_name"><?php echo $userquestion ?></p>
					</div>
				</div>
				</a>			
				<div>									
					<span class="show_question form-control text-start">
						<?php 
							echo $reponse["question"];
							?>
					</span>
					<script>
						var btn1 = document.querySelector('#green');
						var btn2 = document.querySelector('#red');
						btn1.addEventListener('click', function() {
							if (btn2.classList.contains('red')) {
							btn2.classList.remove('red');
							} 
						this.classList.toggle('green');
						});
						btn2.addEventListener('click', function() {
							if (btn1.classList.contains('green')) {
							btn1.classList.remove('green');
							} 
						this.classList.toggle('red');
						});
					</script>
					<form action="like.php" method="POST" >
						<div class="form-group">
							<?php
								echo '<input type="hidden" name="needed_id" value="'.htmlentities($reponse['id']).'" >';
							?>
						</div>
						<button type="submit" class="btn" id="green" name="like"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i></button>
						<?php
							$exec_reque = mysqli_query($db, "SELECT likes.likee, likes.unlikee, likes.question_id, likes.user_name, question.id FROM likes 
							INNER JOIN question ON $question_id = likes.question_id");
							$show_likes = mysqli_fetch_array($exec_reque);
							$like_numb = $show_likes['likee'];
							echo "$like_numb";
							?>
						<button type="submit" id="red" class="btn" name="unlike"><i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i></button>
						<?php
							$unlike_numb = $show_likes['unlikee'];
							echo "$unlike_numb";
							?>
					</form>
					<br>

					<form method="POST" action="response_table.php" enctype="multipart/form-data" >
						<div class="form-group">
							<input name="response" id="response" class="form-control" placeholder="Add response here">
						</div>
						<div class="form-group">
							<?php
								echo '<input type="hidden" name="needed_id" value="'.htmlentities($reponse['id']).'" >';
							?>
						</div>
						<div >
							<button name="submit_response" type="submit" class="btn btn-primary">Add response</button>
						</div>
					</form>
							
								<?php
									$exec_reque = mysqli_query($db, "SELECT  question.id, response.response, response.question_id FROM question 
									INNER JOIN response ON response.question_id = $question_id LIMIT 2 ;");
									if(mysqli_num_rows($exec_reque) > 0){
										$reponsess = mysqli_fetch_array($exec_reque);
										?>
										<div class="dropdown">
											<a href="#" data-toggle="dropdown" class="dropdown-toggle" id="View_Comments">View Response</a>
											<div class="dropdown-menu">					
												<a href="#" class="dropdown-item"></a>
												<span class="dropdown-item form-control text-start"><?php echo $reponsess['response'];?></span>
											</div>
										</div>
										<?php					
									}
								}
								?>
					<?php
						}	}		
					?>
				</div>
			</div>
		</div>
	</body>

		</ul>
    </div >
</html>
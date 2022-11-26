<?php
    $db_username = 'root';
    $db_password = '';
    $db_name = 'rocket';
    $db_host = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name);
	include 'functions.php';
	session_start();
	$id = $_POST['needed_id'];

	$info = selectuser($_SESSION['user']);
	$exec_reque = mysqli_query($db, "SELECT likes.likee, likes.unlikee, likes.question_id, likes.user_name, question.id FROM likes 
	INNER JOIN question ON question.id = likes.question_id");
	var_dump(mysqli_num_rows($exec_reque));
	if(isset($_POST['like'])){
		if(mysqli_num_rows($exec_reque) == 0){
			$query = mysqli_query($db, "INSERT INTO likes (likee, unlikee, question_id, user_name) VALUES ('1', '0', '$id', '$info')");
		}elseif(mysqli_num_rows($exec_reque) > 0){
			$query = mysqli_query($db, "UPDATE likes SET likee = likee + 1 WHERE question_id = '$id' ") ;
		}
	}
	if(isset($_POST['unlike'])){
		if(mysqli_num_rows($exec_reque) == 0){
			$query = mysqli_query($db, "INSERT INTO likes (likee, unlikee, question_id, user_name) VALUES ('0', '1', '$id', '$info')");
		}elseif(mysqli_num_rows($exec_reque) > 0){
			$query = mysqli_query($db, "UPDATE likes SET unlikee = unlikee + 1 WHERE question_id = '$id' ") ;
		}
	}

	header('Location: welcome.php');

	?>


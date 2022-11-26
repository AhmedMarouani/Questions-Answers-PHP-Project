<?php
    $db_username = 'root';
    $db_password = '';
    $db_name = 'rocket';
    $db_host = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name);
    $id = $_GET['question_id'];

    
										
        $query = mysqli_query($db, "UPDATE question SET accepted = '1' WHERE id = '$id' ") ;
        
        header('Location: welcomeadmin.php');


    	

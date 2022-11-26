<?php

   session_start();

    $db_username = 'root';
        $db_password = '';
        $db_name = 'rocket';
        $db_host = 'localhost';
        $db = mysqli_connect($db_host, $db_username, $db_password,$db_name);
        $myresponse = $_POST['response'];
        $id = $_POST['needed_id'];
        $user_name = $_SESSION['user'];
        var_dump($_POST['needed_id']);
        var_dump($myresponse);
                    $query = "INSERT INTO response (response, question_id, user_name) VALUES ('$myresponse', '$id','$user_name')  ";
                    $res = mysqli_query($db, $query);
                    header('Location: welcome.php');
                
            ?>

<?php
   session_start();

    $db_username = 'root';
        $db_password = '';
        $db_name = 'rocket';
        $db_host = 'localhost';
        $db = mysqli_connect($db_host, $db_username, $db_password,$db_name);
        $myresponse = $_POST['response'];
        $id = $_POST['needed_id'];
        var_dump($_POST['needed_id']);
        var_dump($myresponse);
                    $query = "UPDATE question SET response = '$myresponse '
                        WHERE id = '$id' ";
                    $res = mysqli_query($db, $query);
                    header('Location: welcome.php');

            ?>

<?php
    function selectuser( $username){
        $db_username = 'root';
        $db_password = '';
        $db_name = 'rocket';
        $db_host = 'localhost';
        $db = mysqli_connect($db_host, $db_username, $db_password,$db_name);
       

        $se = "SELECT * FROM signup where 
                username = '".$username."' ";
        $exec_requete = mysqli_query($db,$se);
        $reponse = mysqli_fetch_array($exec_requete);

        return $reponse;
    }
    function listquestions($array = []){
        $db_username = 'root';
        $db_password = '';
        $db_name = 'rocket';
        $db_host = 'localhost';
        $db = mysqli_connect($db_host, $db_username, $db_password,$db_name);

        $sele = "SELECT question FROM question";
        $exec_requete = mysqli_query($db,$sele);
        while($reponse = mysqli_fetch_array($exec_requete)){
            $array = $reponse["question"];
            echo $array;
        };
        
    }
?>
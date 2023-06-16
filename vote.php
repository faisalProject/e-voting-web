<?php

    session_start();
    require 'api/conn.php';

    if ( !isset($_COOKIE['xyz']) && !isset($_COOKIE['zyx']) ) {
        $_SESSION = [];
        session_unset();
        session_destroy();

        setcookie('xyz', '', time() - 3600);
        setcookie('zyx', '', time() - 3600);

        header("Location: signin.php");
        exit;
    } else {
        $xyz = $_COOKIE['xyz'];
        $result = mysqli_query($conn, "SELECT id_student FROM student WHERE id_student = $xyz");
        $student = mysqli_fetch_assoc($result);
        $id_student = $student['id_student'];

        echo $id_student;
        
        $id_candidate = $_GET['id'];
        echo $id_candidate;
        $created_at = date('Y-m-d H:i:s', time());
        $updated_at = $created_at;

        $query = "INSERT voting VALUES(
            '',
            '$id_student', 
            '$id_candidate', 
            '$created_at', 
            '$updated_at'
        )";

        mysqli_query($conn, $query);
        header("Location: candidate-details.php?id=$id_candidate");
    }

?>
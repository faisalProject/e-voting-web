<?php

    session_start();
    require '../api/conn.php';

    if ( !isset($_COOKIE['hij']) && !isset($_COOKIE['jih']) ) {
        $_SESSION = [];
        session_unset();
        session_destroy();

        setcookie('hij', '', time() - 3600);
        setcookie('jih', '', time() - 3600);

        header("Location: login.php");
        exit;
    }

    $db = new Voting("localhost", "root", "", "db_evoting_web");
    $conn = $db->connect();
    $id_candidate = $_GET['id_candidate'];

    if ( $db->deleteCandidate($conn, $id_candidate) > 0 ) {
        echo "
            <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                icon: 'success',
                title: 'Berhasil', 
                html: '<p class="."p-popup".">Data kandidat berhasil dihapus!</p>',
                showConfirmButton: false,
                timer: 2000
                })
            })
            </script>
        ";

        header("Location: candidate-list.php");
    }

?>
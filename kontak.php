<?php
    include 'dbconnect.php';

    if(isset($_GET['kirim'])){
        $email = $_GET['email'];
        $text = $_GET['text'];

        $q = mysqli_query($conn, "INSERT INTO `kontak`(`id`, `email`, `text`, `tgl`) 
                                    VALUES (NULL, '$email', '$text', NULL)");
        if($q){
            header('location: index.php');
        }
    }
?>
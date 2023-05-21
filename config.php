<?php 
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "bhakti_makmur";
    
    $conn = mysqli_connect($server, $user, $pass, $database);
    
    if (!$conn) {
        ("<script>alert('Gagal tersambung dengan database.')</script>");
    } 
    // echo "Koneksi berhasil";
    // mysqli_close($conn);
?>
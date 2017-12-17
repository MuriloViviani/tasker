<?php
    echo "Você esta sendo desconectado, por-favor aguarde um momento";
    session_start();
    session_destroy(); 
    echo "Feito!";
    header('Location: http://localhost/tasker/index.php');
?>
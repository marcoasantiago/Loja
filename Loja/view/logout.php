<?php

	session_start(); 

    unset($_SESSION["logado"]);
    unset($_SESSION["user"]);
    
	header("Location: ./index.php");
	
?>
<?php

	function validaSessao () {
	
		session_start();	
	
		$temposessao = 300; //Tempo da Sessão (em Segundos)
	
		if ( ($_SESSION["logado"]) == False ) {
	
	        header('Location: ./login.php');
					
			
		} else {
			
		
			if ($_SESSION["sessiontime"]) { 
	        	
				if ($_SESSION["sessiontime"] <= (time() - $temposessao)) { 
	
					unset($_SESSION["logado"]);
	                unset($_SESSION["user"]);
	                
	                
	                header('Location: ./login.php');
	    		} 
	    		
			} 
	
			$_SESSION["sessiontime"] = time();
			
		}
		
	}

	function inicializaSessao ($email) {
		
		$_SESSION["logado"] = TRUE;
		$_SESSION["user"] = $email;
		$_SESSION["sessiontime"] = time();
		
	}


?>
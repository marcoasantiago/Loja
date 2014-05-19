<?php

class LoginDAO {
	
	private $email;
	private $senha;

	public function validaEmail($email) {
		
		$sql = "SELECT COUNT(0) TOTAL FROM tb_usuario WHERE NM_EMAIL = '" . $email . "'";
		
		$rs = mysql_query($sql);

		$reg = mysql_fetch_array($rs);

		return $reg["TOTAL"];

	}
	
	public function validaSenha($senha, $email) {
		
		$sql = "SELECT COUNT(0) TOTAL FROM tb_usuario WHERE NM_SENHA = '" . $senha . "'" . "AND NM_EMAIL = '" . $email . "'";
		
		$rs = mysql_query($sql);

		$reg = mysql_fetch_array($rs);
				
		return $reg["TOTAL"];

	}
}

?>
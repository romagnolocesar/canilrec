
<?php
	
	//DEU CERTO
	// $headers = "MIME-Version: 1.1\n";
	// $headers .= "Content-type: text/plain; charset=iso-8859-1\n";
	// $headers .= "From: cesar.romagnolo@canilrec.com.br\n"; // remetente
	// $headers .= "Return-Path: cesar.romagnolo@canilrec.com.br\n"; // return-path
	// $headers .= "Reply-To: mazzalara0@gmail.com\n"; // Endereço (devidamente validado) que o seu usuário informou no contato
	// $envio = mail("mazzalara0@gmail.com", "Assuntossssss", "Mensagemssss", $headers, "-fcesar.romagnolo@canilrec.com.br");

	// echo $envio;
	// echo $headers;




	$headers = "MIME-Version: 1.1\n";
	$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
	$headers .= "From: cesar.romagnolo@canilrec.com.br\n"; // remetente
	$headers .= "Return-Path: cesar.romagnolo@canilrec.com.br\n"; // return-path
	$headers .= "Reply-To: cesar.romagnolo@hotmail.com\n"; // Endereço (devidamente validado) que o seu usuário informou no contato
	$envio = mail("cesar.romagnolo@hotmail.com", "Assunto", "Mensagem", $headers, "-fcesar.romagnolo@canilrec.com.br");

	echo $envio;
	echo $headers;
?>
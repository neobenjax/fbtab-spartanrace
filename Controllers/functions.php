<?php

date_default_timezone_set('America/Mexico_City');

session_start();

header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');

require '../commons/helpers.php';
$helpers = new Helpers();

$base = $helpers->getURL();


if (isset($_POST['act']) && $_POST['act'] == 'mailUser' && isset($_POST['nombre']) && $_POST['nombre'] != ''
    && isset($_POST['edad']) && $_POST['edad'] != '' && isset($_POST['e_mail']) && $_POST['e_mail'] != '')
{
	try{
		$nombre 		= htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
		$e_mail 		= htmlspecialchars($_POST['e_mail'], ENT_QUOTES, 'UTF-8');
		$edad 			= htmlspecialchars($_POST['edad'], ENT_QUOTES, 'UTF-8');
		$he_particiado	= (isset($_POST['he_particiado']) && $_POST['he_particiado']!='')?htmlspecialchars($_POST['he_particiado'], ENT_QUOTES, 'UTF-8'):'no';

//Gracias por registrarte
	}
	catch(Exception $e)
	{
	 echo "IMPRIMIMOS EL MENSAJE QUE QUEREMOS QUE VEAN MAS EL ERROR CACHADO EN $e ".$e->getMessage();
	 var_dump($e);
	}

} else {
	echo "Inválido";
}

?>
<?php

date_default_timezone_set('America/Mexico_City');

session_start();

header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');

require '../commons/helpers.php';
$helpers = new Helpers();

$base = $helpers->getURL();


if (isset($_POST['act']) && $_POST['act'] == 'addUser' && isset($_POST['nombre']) && $_POST['nombre'] != ''
    && isset($_POST['edad']) && $_POST['edad'] != '' && isset($_POST['e_mail']) && $_POST['e_mail'] != '')
{
	try{
		$nombre 		= htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
		$e_mail 		= htmlspecialchars($_POST['e_mail'], ENT_QUOTES, 'UTF-8');
		$edad 			= htmlspecialchars($_POST['edad'], ENT_QUOTES, 'UTF-8');
		$he_participado	= (isset($_POST['he_participado']) && $_POST['he_participado']!='')?htmlspecialchars($_POST['he_participado'], ENT_QUOTES, 'UTF-8'):'no';


		$consulta = "SELECT * FROM tbl_registros WHERE e_mail = :e_mail";

        $params = array(0 => array('id'=>'e_mail', 'content'=>$e_mail,'tipo'=>PDO::PARAM_STR,'size'=>100));

        $user = $helpers->getDataSanitize($consulta,$params,'fetchAll');


        if ($user === false){
            echo '0';
            die();
        }


        // El usuario ya existe
        if(count($user) > 0)
        {
            echo '-1';
            die();
        }

        $table = 'tbl_registros';

        $params = array(array());
        $params[0] = array('id'=>'nombre', 'content'=>$nombre,'tipo'=>PDO::PARAM_STR,'size'=>500);
        $params[1] = array('id'=>'e_mail', 'content'=>$e_mail,'tipo'=>PDO::PARAM_STR,'size'=>100);
        $params[2] = array('id'=>'edad', 'content'=>$edad,'tipo'=>PDO::PARAM_INT,'size'=>11);
        $params[3] = array('id'=>'he_participado', 'content'=>$he_participado,'tipo'=>PDO::PARAM_STR,'size'=>2);

        $consulta = "INSERT INTO $table (nombre, e_mail, edad, he_participado) VALUES (:nombre, :e_mail, :edad, :he_participado)";

        // Reviso si se inserto el usuario
        $result = $helpers->insertDataSanitize($consulta,$params);


        if($result < 1){
            echo '0';
            die();
        }

        //Validar el ultimo registro insertado
        $consulta = "SELECT * FROM tbl_registros WHERE e_mail = :e_mail";

        $params = array(0 => array('id'=>'e_mail', 'content'=>$e_mail,'tipo'=>PDO::PARAM_STR,'size'=>100));

        $user = $helpers->getDataSanitize($consulta,$params,'fetchAll');

        if ($user === false){
            echo '0';
            die();
        }


        if ($result > 0)
        {
        	echo '1';
        }

        die();

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
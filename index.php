<?php
session_set_cookie_params(1800, NULL, NULL, isset($_SERVER["HTTPS"]), TRUE);
session_start();
error_reporting(0);
if($_SERVER['SERVER_PORT']==443)
  $_SERVER['HTTPS'] = 'on';

if(isset($_SERVER['HTTP_X_FORWARDED_PORT']) && $_SERVER['HTTP_X_FORWARDED_PORT']==443)
  $_SERVER['HTTPS'] = 'on';

if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO']=='https')
  $_SERVER['HTTPS'] = 'on';

include_once 'commons/helpers.php';

$helpers = new Helpers();

//Variables de navegacion
$pagina = (isset($_GET['pagina']))?htmlspecialchars($_GET['pagina'], ENT_QUOTES, 'UTF-8'):'index';
$subpagina = (isset($_GET['subpagina']))?htmlspecialchars($_GET['subpagina'], ENT_QUOTES, 'UTF-8'):'default';
$categoria = (isset($_GET['categoria']))?htmlspecialchars($_GET['categoria'], ENT_QUOTES, 'UTF-8'):'default';
$producto = (isset($_GET['producto']))?htmlspecialchars($_GET['producto'], ENT_QUOTES, 'UTF-8'):'default';

//Variables de directorios
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$directorio = dirname($_SERVER["PHP_SELF"]);
$directorio =($directorio!='')?$directorio:'/';
$http = (isset($_SERVER['HTTPS'])) ? 'https' : 'http';

$path = $http."://$_SERVER[HTTP_HOST]";
$fullPath = $path.$directorio;
$fullPath = ($fullPath[strlen($fullPath)-1]=='/')?$fullPath:$fullPath.'/';

$_SESSION['fullPath'] = $fullPath;       



if ($actual_link == 'https://dominiofinal.ext/' || $actual_link == 'https://dominiofinal.ext')
{

   header("HTTP/1.1 301 Moved Permanently");
   header('Location: https://www.dominiofinal.mx/');
}

include_once $helpers->getController($pagina);

?>
<!doctype html>
<html class="no-js" lang="es" ng-app="app">
    <head>
      <?php
        header('X-Frame-Options: DENY');
        header('X-XSS-Protection: 1; mode=block');
        header('X-Content-Type-Options: nosniff');
      ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->


        
        <title>SpartanRace</title>
        <meta name="description" content="">
        <meta name="keywords" content="">


        <?php include 'includes/head_includes.php'; ?>
    </head>
    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.7&appId=317689241650052";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <?php
            //Variables de reasignación para home_marca/categoria/nombre-de-producto
            if(4==5){
          ?>
          <div>
            <span class="green">Link Actual: <?php echo $actual_link; ?></span>
            <br>
            <span class="green">Página: <?php echo $pagina; ?></span>
            <br>
            <span class="green">Subpagina: <?php echo $subpagina; ?></span>
            <br>
            <span class="green">Categoria: <?php echo $categoria; ?></span>
            <br>
            <span class="green">Producto: <?php echo $producto; ?></span>
            <br>
            <span class="green">id_producto: <?php echo $id_producto; ?></span>
            <br>
            <span class="green">Nombre Productos: <?php echo $nombre_producto; ?></span>
          </div>
          <?php
            }
          ?>

        <div class="contenedorAll">
            <div class="desplazamiento">

                  <?php
                      # Contenido
                      include_once $helpers->getView($pagina);
                  ?>
                  
            </div><!--Fin Contenedor para desplazamiento en MOVIL -->
        </div>
    </body>
</html>

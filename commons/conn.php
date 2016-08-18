<?php

if ($_SERVER['SERVER_NAME']=='localhost' || $_SERVER['SERVER_NAME']=='127.0.0.1')
{
	# CONSTANTES DE CONEXIÓN DEV
	define('DATABASE_NAME','proyphp_spartantab');
	define('SERVER','71.19.228.214');
	define('USERNAME','pp_spartantab');
	define('PASSWORD','q:{sXUE84u&)N3_d');
	define('DIRECTORIO','/fbtab-spartanrace/');
	define('RUTA','/fbtab-spartanrace/');

}
elseif ($_SERVER['SERVER_NAME']=='ssl.codice.com')
{
	# CONSTANTES DE CONEXIÓN DEV
	define('DATABASE_NAME','spartantab');
	define('SERVER','71.19.228.214');
	define('USERNAME','ssl_spartantab');
	define('PASSWORD','TJ7Y=PS4D=dxYy$q');
	define('DIRECTORIO','/fbtab-spartanrace/');
	define('RUTA','/fbtab-spartanrace/');

}


define('APP_ID', '');
define('APP_SECRET', '');

define('YOUR_CONSUMER_KEY', '');
define('YOUR_CONSUMER_SECRET', '');

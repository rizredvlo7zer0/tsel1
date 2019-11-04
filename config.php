<?php
define( 'ENVIRONMENT', 'work' );

switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(-1);
        ini_set('display_errors', 1);
        //ini_set('display_startup_errors', 1);
        //error_reporting(E_ALL);
	break;

    case 'maintenance':
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo '1337Route Currently maintenance, Please try again later.';
		exit(1); // EXIT
    break;

    case 'work':
        error_reporting(0);
		ini_set('display_errors', 0);
    break;

	default:
		header('HTTP/1.1 500 Internal Server Error', TRUE, 500);
		exit(1); // EXIT_ERROR
}


define( 'privatekey', 'tppgaming' );
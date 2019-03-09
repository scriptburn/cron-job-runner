<?php require_once __DIR__.'/vendor/autoload.php';
use GO\Scheduler;
use Mailgun\Mailgun;


if (file_exists(__DIR__."/.env"))
{
	$dotenv = Dotenv\Dotenv::create(__DIR__,'.env');
	$dotenv->overload();
}

$scheduler = new Scheduler();
$mg = Mailgun::create(getenv('MG_KEY'));
$msg_params = array(
	'from' => getenv('EMAIL_FROM'),
	'to' => getenv('EMAIL_TO'),
);
 
<?php require_once __DIR__.'/vendor/autoload.php';

use GO\Scheduler;
use Mailgun\Mailgun;

$scheduler = new Scheduler();


/*
$cmd = 'echo $(date)';

$scheduler->raw($cmd)->at('* * * * *')->then(function ($output) use ($logfile, $cnt)
{
	$mg = Mailgun::create("key");
	$ret = $mg->messages()->send("domain", array(
		'from' => 'noreply@example.com',
		'to' => 'example@gmail.com',
		'subject' => 'test cron setup scorpion',
		'text' => 'test message. '.(is_array($output) ? implode("\n", $output) : $output),
	));

});
*/
$scheduler->run();
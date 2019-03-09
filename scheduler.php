<?php require_once __DIR__.'/init.php';

 
$cmd = 'ls -la';

$scheduler
	->raw($cmd, [], 'sample-cron')
	->at('* * * * *')
	->before(function () use ($mg, $msg_params)
{
		$msg_params = array_merge($msg_params, ['subject' => 'pre command subject', 'text' => 'pre command body']);
		
		$ret = $mg->messages()->send(getenv('MG_DOMAIN'), $msg_params);
	})
	->then(function ($output) use ($mg, $msg_params)
{
		$output = (is_array($output) ? implode("\n", $output) : $output);
		$msg_params = array_merge($msg_params, ['subject' => 'post command subject', 'text' => 'post command body :'.$output]);
		$ret = $mg->messages()->send(getenv('MG_DOMAIN'), $msg_params);
	});

$scheduler->run();
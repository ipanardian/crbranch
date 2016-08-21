<?php 
/**
 * crBranch
 * (c) 2016 Ipan Ardian
 * A simple command line app to help you simplify your life
 *
 * https://github.com/ipanardian/crbranch
 * The MIT License
 */

if (isset($_SERVER['REMOTE_ADDR'])) die('Permission denied.');
error_reporting(E_ALL ^E_NOTICE);

class crBranch
{
	private $arg;
	
	function __construct($argv)
	{
		$this->arg = $argv ?: exit();
	}

	public function simplifyMyLife(callable $callback)
	{
		is_callable($callback) ?: exit();
		$conf = $callback($this->arg) ?: exit('Empty return of callback');
		$str = $this->readline() ?: exit();
		if (!empty($conf[1])) {
			$str = $conf[1]. ' ' .$str;
		}
		$baseBranch = escapeshellcmd($conf[0]);
		$newBranch = escapeshellcmd(preg_replace('/\s/', '_', trim(preg_replace('/(\W\s|\s\W)/', '', strtolower($str)))));
		if (empty($newBranch)) exit('Empty new branch name');
		passthru('git checkout '.$baseBranch);
		passthru('git checkout -b '.$newBranch);
	}

	public function readline()
	{
		echo "Type: ";
		try {
			$handle = fopen ("php://stdin","r");
			$line = fgets($handle);
		} 
		catch (Exception $e) {
			die($e->getMessage());
		}
		finally {
			fclose($handle);
		}

		return str_replace("\n", '', $line);
	}

	function __destruct()
	{
		exit();
	}
}

(new crBranch($argv))->simplifyMyLife(function($arg) {
	$baseBranch = 'development';
	$prefix = '';
	switch ($arg[1]) {
		case '-f':
			$prefix = 'feature';
			break;

		case '-e':
			$prefix = 'enhance';
			break;

		case '-b':
			$prefix = 'bugfix';
			break;

		case '-h':
			$prefix = 'hotfix';
			$baseBranch = 'hotfix';
			break;

		case '-c':
			$baseBranch = $arg[2] ?: exit('Missing argument base branch');
			break;
		
		default:
			die('Unknown parameter');
			break;
	}

	return [$baseBranch, $prefix];
});
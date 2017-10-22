<?php 

namespace ipanardian\git;

/**
 * crBranch
 * (c) 2016 Ipan Ardian
 * A simple command line app to help you simplify your life
 *
 * https://github.com/ipanardian/crbranch
 * The MIT License
 */

class crBranch implements InterfaceCrBranch
{
	/**
	 * arguments
	 */
	private $arg;
	
	/**
	 * Constructor
	 * @param array $argv
	 */
	function __construct($argv)
	{
		$this->arg = $argv ?: exit();
	}

	/**
	 * Run
	 * @return void
	 */
	public function run()
	{
		switch ($this->arg) {

			default:
				$this->createBranch(function($arg) {
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
							
						case '-hf':
							$prefix = 'hotfeature';
							break;
						
						case '-t':
							$prefix = 'test';
							break;
				
						case '-c':
							$baseBranch = $arg[2] ?: exit('Missing argument base branch'. PHP_EOL);
							break;
						
						default:
							exit('Unknown parameter'. PHP_EOL);
							break;
					}
				
					return [$baseBranch, $prefix];
				});
			break;
		}
	}

	/**
	 * createBranchName
	 * @param string $str
	 * @return string $sanitizedBranchName
	 */
	public function createBranchName($str) 
	{
		return escapeshellcmd(preg_replace('/\s/', '_', trim(preg_replace('/(\W\s|\s\W)/', '', strtolower($str)))));
	}

	/**
	 * execGitCommand
	 * @param string $command
	 * @return void
	 */
	public function execGitCommand($command) 
	{
		passthru("git $command");
	}

	/**
	 * createBranch
	 * @param callable $callback
	 * @return void
	 */
	public function createBranch(callable $callback)
	{
		is_callable($callback) ?: exit();
		$conf = $callback($this->arg) ?: exit('Empty return of callback'. PHP_EOL);
		$str = $this->readline() ?: exit();

		if (!empty($conf[1])) 
			$str = $conf[1]. ' ' .$str;
		
		$baseBranch = escapeshellcmd($conf[0]);
		$newBranch = $this->createBranchName($str);
		if (empty($newBranch)) 
			exit('Empty new branch name');

		$this->execGitCommand('checkout '.$baseBranch);
		$this->execGitCommand('pull origin '.$baseBranch);
		$this->execGitCommand('checkout -b '.$newBranch);
	}

	/**
	 * readline
	 * @return string $line
	 */
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

<?php 
/**
 * Crbranch
 * (c) 2016 Ipan Ardian
 *
 * The MIT License
 */

$arg = $argv;

if (empty($arg)) {
	return;
}
unset($arg[0]);

$baseBranch = 'development';
switch ($arg[1]) {
	case '-f':
		$arg[1] = 'feature';
		break;

	case '-e':
		$arg[1] = 'enhance';
		break;

	case '-b':
		$arg[1] = 'bugfix';
		break;

	case '-h':
		$arg[1] = 'hotfix';
		$baseBranch = 'hotfix';
		break;

	case '-c':
		$baseBranch = $arg[2];
		unset($arg[1]);
		unset($arg[2]);
		break;
	
	default:
		die('Unknown parameter');
		break;
}

$newBranch = strtolower(preg_replace('/[^a-z0-9_]/i', '', implode('_', $arg)));
if (!empty($newBranch)) {
	passthru('git checkout '.$baseBranch);
	passthru('git checkout -b '.$newBranch);
}

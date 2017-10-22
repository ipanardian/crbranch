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

require 'InterfaceCrBranch.php';
require 'crBranch.php';

(new \ipanardian\git\crBranch($argv))->run();
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

interface InterfaceCrBranch 
{
    public function run();

    public function createBranchName($str);

    public function execGitCommand($command);

    public function createBranch(callable $callback);

    public function readline();
}
# crBranch
[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/ipanardian/crbranch/issues) 
[![GitHub license](https://img.shields.io/badge/license-MIT-red.svg)](https://raw.githubusercontent.com/ipanardian/crbranch/master/LICENSE)
[![HitCount](https://hitt.herokuapp.com/ipanardian/crbranch.svg)](https://github.com/ipanardian/crbranch)

A simple command line app to help you create git branch more faster. You just copy a title from project management app like Asana or whatever you use. Paste it on command line along with specific argument then enter. The crbranch will checkout to specific base branch and create new branch for you. 

## How to use
```
$ crbranch -f 
Type: API Seating Chart
Switched to branch 'development'
Your branch is up-to-date with 'origin/development'.
Switched to a new branch 'feature_api_seating_chart'

$ crbranch -h
Type: ATM expired payment
Switched to branch 'hotfix'
Your branch is up-to-date with 'origin/hotfix'.
Switched to a new branch 'hotfix_atm_expired_payment'

$ crbranch -c master 
Type: release
Switched to branch 'master'
Your branch is up-to-date with 'origin/master'.
Switched to a new branch 'release'
```

## Feature
1. Auto underscore and remove non alphanumeric characters
2. Auto prefix e.g feature, enhance, bugfix, hotfix
3. Auto checkout to specific branch
4. Auto create branch
5. Custom base branch
6. Minimize wrong selected base branch

## List Predefined Prefix
- f => feature
- e => enhance
- b => bugfix
- h => hotfix
- hf => hotfeature
- t => test

## License
The MIT License (MIT)

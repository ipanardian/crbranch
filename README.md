# crbranch

A simple command line app to help you create git branch more faster. You just copy a title from project management app like Asana or whatever you use. Paste it on command line along with specific argument then enter. The crbranch will checkout to specific base branch and create new branch for you. 

## How to use
```
$ crbranch -f API Seating Chart
output: 
Switched to branch 'development'
Your branch is up-to-date with 'origin/development'.
Switched to a new branch 'feature_api_seating_chart'

$ crbranch -h ATM expired payment
output: 
Switched to branch 'hotfix'
Your branch is up-to-date with 'origin/hotfix'.
Switched to a new branch 'hotfix_atm_expired_payment'
```

## License
The MIT License (MIT)

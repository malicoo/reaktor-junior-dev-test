# Pre-assignment for junior developer positions

## [Demo Link](https://reaktor.malico.me/)

Language : PHP 

### Installation

* Clone a Copy of the Project to your system
* Navigate to Project folder, run command `composer install` to install dependecies. The Two external Packages are used for this 
  - Bramus/Router - A simple web routing Package
  - lavary/crunz - For handling Crunz Jobs (More Here in Solution Guide)
* To start a test Server `php server.php`

### Solution Guide

The `src/command.php` generates json files, which are saved in the `.cache` folder. The script creates a new instance of the class `src/App/Status.php` which does pretty much everything, 
- Reading the status File
- Getting Package Properties and their values
- Sorting the Packages alphabetically.
- Generate cache & config files

The files generate feature
- `config.json` - Has Number of Packages in System & time
- `a.json`
.. 
-`z.json`
each file contains packages with first letter of that package.

This is done because for very large systems of +3000 packages, It's take time to read all the status file, read packages, extract info for every request. which often requires more time to render in response.

After caching, when a user request to view packages,or a single package (routes and actions define in `src/app.php`), It's easier to read the cached json files and also search if needed.

To Regenerate Json files in case of system update or new Package, navigate to `src/` and run script command.php (`php command.php`) to generated updated list. Or you can add the following line to your cronjob file to automatically generate json files weekly.
```bash
* * * * * cd /projectpath && vendor/bin/crunz schedule:run
```

With this, it was easy to create an API system to request Packages & Package Info
`https://url/api/packages/a` - returns 'a' Packages in JSON
`https://url/api/package/name` - returns detailed info about 'name' package 

With VueJS and Tailwind, It was easy to create a nice SPA to consume this API.


### Applicant
Name: Ndifon Desmond
Email: hi@malico.me
Website: https://malico.me


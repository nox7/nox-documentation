# Synchronizing Your PHP Models to Your MySQL Database
Now that you've built out some models for your application (if you haven't check out how to do so [on the Models page](/docs/1.x/orm/models)) - you'll need to make sure the models have MySQL tables that represent them.

Default Nox installations, made using the installation script on the [installation page](/docs/1.x/quick-start), come with a folder titled `cli-scripts`. Inside this folder is a script you can run named `sync-models.php`.

This script relies on you having filled out valid MySQL credentials in the `nox-env.php` file. You **must** have already made an existing MySQL database. Nox only will create and organize your tables (from the Models you made), but will not actually create a MySQL database for you.

## Running the Synchronization Script
Once the credentials are filled out, make sure that `php` is a valid command you can run from your command line (For Windows, your PATH variable must include a path to a folder that contains a PHP executable).

Navigate to the `cli-scripts` folder and execute the `sync-models.php` script. A few moments will pass, and you should now see all the tables and columns properly created in your MySQL database to match all of your Models.
```bash
$ php cli-script.php
```
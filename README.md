# Bookmarker #

By [Philip W. Knerr](https://github.com/pwk8).


## Description ##

**Bookmarker** is a web-based application for managing bookmarks to Internet resources.

Bookmarks can be viewed, followed, created, updated, and trashed via a web-based user interface.  This functionality is analogous to the bookmarking functionality in a web browser.  However, once created in Bookmarker, a bookmark can be accessed from any web browser on any device.

Bookmarker is a multi-user application.  Users may register for accounts and log in to an existing accounts.


## Dependencies ##

Bookmarker requires the following code to be installed on the server on which it will be hosted:

* The [Laravel framework](https://github.com/laravel/laravel), version 5.5.19 or greater.
* The [Composer package manager](https://getcomposer.org/).
* The [Node.js platform](https://nodejs.org/).
* The [npm package manager](https://www.npmjs.com/).
* The [PostgreSQL database](https://www.postgresql.org/).  Note that while other relational, SQL-based databases should work, Bookmarker has only been tested with the PostgreSQL database.

If the Laravel framework is not already present, it can be installed as described in the [Laravel documentation](https://laravel.com/docs/5.5/installation).  For installation instructions for other dependencies, please see the links above.


## Installation ##

Configure a virtual host for the application.

Ensure that the virtual host can process pretty URL's.  The [Laravel documentation](https://laravel.com/docs/5.5/installation) explains how to do this for both the [Apache HTTP Server](https://httpd.apache.org/) and the [nginx](https://www.nginx.org/) HTTP server.

Clone the Bookmarker repository into the directory in which the Bookmarker application should be stored.  Note that subsequent steps should be performed in this application directory, unless otherwise noted.

Ensure that the HTTP server can write to the following subdirectories of the application directory, including all files and subdirectories contained therein:

* `bootstrap/cache`
* `storage`

A good way to do this is to change ownership of these subdirectories and files to the *group* under which the HTTP server executes.  Then, make these subdirectories and files group-writeable.

Copy the file named `.env.example` to a file named `.env`.

Edit the `.env` file in a text editor.  Make the following changes:

* Customize the configuration in this file to match your server's configuration.
* Select a password for the database role.  Record this password at the end of the line beginning with `DB_PASSWORD=`.

Generate an application key by executing the following shell command:

```console
php artisan key:generate
```

Install JavaScript dependencies by executing the following shell command:

```console
npm install
```

Compile assets by executing the following shell command:

```console
npm run production
```


### Database configuration ###

Note that subsequent steps may be performed from any directory, unless otherwise noted.

Sign in to the PostgreSQL database by executing the following shell command as the root user:

```console
sudo -u postgres psql
```

Create a role for the application by executing the following SQL command:

```console
CREATE ROLE bookmarker LOGIN CREATEDB CREATEROLE;
```

Assign a password to this role by executing the following SQL command:

```console
\password bookmarker
```

When prompted, enter the database password you selected above.

Exit the PostgreSQL database by executing the following SQL command:

```console
\q
```

Edit the PostgreSQL Client Authentication Configuration File.  The location of this file depends on the flavor of Linux installed on the server.  Moreover, the file path depends on the installed version of the PostgreSQL database.  The commands below assume that version 9.6 is installed; the path needs to be adjusted if you are running a different version of the PostgreSQL database.

* On the Debian or Ubuntu operating system, execute the following shell command as the root user:

```console
sudo -u postgres nano /etc/postgresql/9.6/main/pg_hba.conf
```

* On the Amazon Linux operating system, execute the following shell command as the root user:

```console
sudo -u postgres nano /var/lib/pgsql96/data/pg_hba.conf
```

In the text editor, change `peer` to `md5` in the following line:

```console
local   all             all                                     peer
```

On the Amazon Linux operating system, and possibly on some other configurations, you will also need to change `ident` to `md5` in the following two lines.

Restart PostgreSQL.  Here again, the syntax depends on the flavor of Linux installed on the server.

* On the Debian or Ubuntu operating system, execute the following shell command as the root user:

```console
sudo service postgresql restart
```

* On the Amazon Linux operating system, execute the following shell command as the root user, again adjusting the name of the service if a version of the PostgreSQL database other than version 9.6 is installed:

```console
sudo service postgresql96 restart
```

Create a database for the application by executing the following shell command:

```console
createdb --username=bookmarker --password bookmarker
```

Run all database migrations by executing the following shell command from the application directory:

```console
php artisan migrate
```


## Database access ##

After performing the steps above, you can access the database for the application by executing the following shell command:

```console
psql --username=bookmarker --password bookmarker
```


## Documentation ##

Different types of code are commented in different ways:

* PHP code includes docblock comments in the style defined by the [phpDocumentor](https://www.phpdoc.org/) tool.  This tool may optionally be invoked to generate documentation for the PHP code.
* JavaScript code also includes docblock comments.  The format of these comments is loosely based on the [Google JavaScript Style Guide](https://google.github.io/styleguide/jsguide.html).
* Sass files begin with brief comments describing the purpose of the file.  Moreover, many individual styles are described by brief comments.
* Blade templates begin with comments describing the template.  Furthermore, when a template requires or accepts a variable (other than a standard variable such as `$errors`), the comments also specify this variable.

Special emphasis is placed on how the various parts of the application fit together.  It is my goal for others to be able to use the comments to understand how this application, and Laravel applications generally, are structured.


## Future plans ##

In the future, I plan to implement the following enhancements:

* A modern, Vue.js-based user interface which communicates with the server via AJAX.
* Search capabilities.
* Functionality to import bookmarks from web browsers.
* The ability to share bookmarks with other users.
* An administrative user interface to manage the application and the users thereof.
* Unit tests.
* Functional tests.


## Special thanks ##

The author would like to extend special thanks to the following people and organizations:

* My family.
* Taylor Otwell and all contributors to the Laravel framework.
* [Stephanie Hekker](https://github.com/stephzilla), whose [README markdown template](https://github.com/stephzilla/readme) was adapted to produce this README file.
* Wheaton-Warrenville Community Unit School District 200, DuPage County, Illinois, United States.
* College of DuPage, Glen Ellyn, Illinois, United States.
* North Central College, Naperville, Illinois, United States.


## Author ##

* Philip W. Knerr [https://github.com/pwk8](https://github.com/pwk8)


## License ##

Bookmarker is open-sourced software licensed under the MIT license.  This license can be viewed in the `LICENSE` file in this repository.

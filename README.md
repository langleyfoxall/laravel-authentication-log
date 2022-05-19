# Laravel Authentication Log

## Description

A package to listen for various Authenticatable events and log them in a database

## Installation

To install, enter the following inside the terminal within your working directory:

`composer require langleyfoxall/laravel-authentication-log`

Once the package has been installed, run your migrations and ensure to use the trait HasAuthenticatable in all models to be logged

All successful logins are logged within the authentication_log_records table.

You may remove events to be logged through the `auth-log.php` config file by commenting out unwanted events.
Furthermore, in the config file you may add credential items to the "credentialsToOmit" array for them to not be stored in the database.

## Commands

`php artisan laravel-authentication-log:showlog`

This command will display the data stored in the Authentication Log Records table

## Features

This package can log the following:
1. Successful Logins
2. Failed Logins
3. Successful Logouts

Features can be configured through `config/auth-log.php`.
# Laravel Authentication Log

## Description

A package to listen for various Authenticatable events and log them in a database

## Installation

To install, enter the following inside the terminal within your working directory:

`composer require langleyfoxall/laravel-authentication-log`

Once the package has been installed, run your migrations and ensure to use the trait HasAuthenticatable in all models to be logged.

All events are logged within the authentication_log_records table.
## Configuration

Within the `auth-log.php` config file, you may specfiy what you would like to log.
You may change:
- Events to log, by commenting out the unwanted events,
- Credentials to not be logged, by adding the fields within `credentialsToOmit`,
- Fields to not be logged, by adding the fields within `fieldsToOmit`,
- Accepted Guards, by adding the specified guards within `acceptedGuards`

## Commands

`php artisan laravel-authentication-log:showlog`

This command will display the data stored in the Authentication Log Records table

## Features

This package can log the following:
- Successful Logins
- Failed Logins
- Successful Logouts
- Password Resets
- Lockouts
- Registering New Users

Features can be configured through `config/auth-log.php`.
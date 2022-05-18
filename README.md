# Laravel Authentication Log

## Description

A package to listen for various Authenticatable events and log them in a database

## Installation

To install, enter the following inside the terminal within your working directory:

> composer require langleyfoxall/laravel-authentication-log

Once the package has been installed, run your migrations and ensure to use the trait HasAuthenticatable in all models to be logged

All successful logins are logged within the authentication_log_records table.

## Notes

Currently only supports Logging In
## v0.3

- Can now log ip addresses of all machines that triggered events
- Can select fields to be omitted, for example, `user_ip`
- Can not log User Registered events, Lockout events and Password Reset events
- Fixed field omissions not working correctly
- Added `createWithOmissions` method to `AuthenticationLogRecord`

## v0.2

- Can now log Failed Login Attempts and Successful Logouts to the database
- Can select events to ignore in the Config File
- Can select credentials to be omitted from the database in the Config File, such as passwords
- Developers can now add authentication events easily through the `AuthenticationLogSubscriber`
- Tests have been implemented to ensure the package works correctly throughout development

## v0.1

- Can log successful logins to the database
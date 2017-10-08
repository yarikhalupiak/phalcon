create Database: 
php app/cli.php main table

.....

create User: 
{flag} == 1 - admin
{flag} == 0 - simple user 

.....

php app/cli.php main create {email} {password} {flag}

.....

Simple authorized user: can create, edit other user

Admin: can do the same and also delete users

Not authorized user can only look users list.

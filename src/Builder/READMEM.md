###The Builder Pattern in Symfony

This is a contrived example to demonstrate the builder pattern.
The example shows how a computer can be built from a user specification.

To run the code, first upload the specification file 
`userSpecifications.csv` in the `upload/builder` directory

The run

`php bin/console app:build:user:computer <user_email>`

where `user_email` is the id or email of the user with the specification.

e.g `php bin/console app:build:user:computer jamie@devtest.com`
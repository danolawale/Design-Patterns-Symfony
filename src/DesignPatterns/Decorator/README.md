###The Decorator Pattern in Symfony

In the decorator pattern, custom behaviours can be added to a object
by wrapping the object with another object of the same type.

To demonstrate this pattern, I've created an example that generates
a sql query for creating and updating a user in the database.

There are base classes in Decorator/UserRequest for creating/updating
a user. The decorators are in Decorator/UserRequestDetails.

To run the code, use examples below:

`./bin/console app:user:request --userDetails "name=Dan Olawale,email=dan.olawale@gmail.com,username=danOlawale,role=developer" --action create`

`./bin/console app:user:request --userDetails "name=Dan Olawale,email=dan.olawale@gmail.com,username=danOlawale,id=5" --action update
`

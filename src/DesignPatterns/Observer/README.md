###Observer Pattern in Symfony

This uses the `CompilerPassInterface` defined in `Kernel.php` to subscribe the observers.

To run the code:

./bin/console app:avg:temp:notify --temp 30,50,60

./bin/console app:avg:temp:notify --temp 25,22,44 --processor max

./bin/console app:avg:temp:notify --temp 11,19,2 --processor min
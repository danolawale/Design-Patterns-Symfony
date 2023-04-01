##The publisher-subscriber Pattern in Symfony

The publisher-subscriber pattern can be thought of as a variation of the observer pattern.
The main difference between the pub-sub and the observer pattern is in who notifies the observers (or subscribers).
In the observer pattern, the subject does the notification. The publisher-subscriber 
pattern on the other hand uses a middle-man called `Publisher` to handle notification 
to the observers.

This implementation uses the symfony Event Dispatcher as the publisher. The observers 
(or listeners) tell the Event Dispatcher which events they want to listen to. Then the subject
tells the event dispatcher to dispatch the event. The dispatcher is then responsible for 
calling the listener methods.

The flow is subject->Event Dispatcher(or publisher)->Observers(or subscribers).

In this contrived example, I have extended the Weather Station example in the observer 
pattern to also provide humidity readings in addition to the temperature readings.

To run the code, use example commands below:

`./bin/console app:weather:process:readings --temp 30,70,50 --humidity 43,56,21`

`./bin/console app:weather:process:readings --temp 30,70,50`

`./bin/console app:weather:process:readings --humidity 43,56,21`

# Castellan
A simple PHP event notifier.

## Example Repository

```php
<?php

use Castellan\Castellan;

class Repository_Dispatcher
{

	public function exampleDispatcher($listeners = array())
	{
		$dispatcher = new Castellan();
		
		$listener = new Listener();

		$dispatcher->addListener('example.event', array($listener, 'event'));
		$dispatcher->addListener('example.staticEvent', 'Listener::staticEvent');
		$dispatcher->addListener('example.targetEvent', 'Listener::targetEvent');
		$dispatcher->addListener('example.parameterEvent', 'Listener::parameterEvent');
		$dispatcher->addListener('example.customEvent', 'Listener::customEvent');

		return $dispatcher;
	}

}

?>
```

## Example Listener

```php
<?php

class Listener_Example {

	public function event($event) {}

	public static function staticEvent($event) {}

	public static function targetEvent($event)
	{
		$target = $event->target;
	}

	public static function parameterEvent($event)
	{
		$parameters = $event->parameters;
	}

	public static function customEvent($event) {}

}

?>
```

## Example Use

```php
<?php

class Example
{

	public function use()
	{
		$dispatcher = new Repository_Dispatcher()->exampleDispatcher();

		// Basic events
		$dispatcher->trigger('example.event');
		$dispatcher->trigger('example.staticEvent');

		// Targeted event. All events should have targets, usually $this or $self
		$dispatcher->trigger('example.targetEvent', $this);

		// With additional parameters
		$parameters = array(
			'param' => 'value',
		);

		$dispatcher->trigger('example.parameterEvent', $this, $parameters);

		// Custom event
		$event = new Castellan\Event('example.customEvent', $this, $parameters);

		$dispatcher->trigger($event);
	}

}

?>
```

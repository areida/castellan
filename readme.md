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

		// Targeted event
		$target = new TargetObject();

		$dispatcher->trigger('example.targetEvent', $target);

		// With additional parameters
		$parameters = array(
			'param' => 'value',
		);

		$dispatcher->trigger('example.parameterEvent', $target, $parameters);

		// Custom event. Pass $this or $self if you need to pass parameters with no target
		$event = new Castellan\Event('example.customEvent', $target, $parameters);

		$dispatcher->trigger($event);
	}

}

?>
```

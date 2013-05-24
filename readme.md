# Castellan
A simple php event notifier.

## Example Repository

```php
<?php

class Repository_Dispatcher
{

	public function exampleDispatcher($listeners = array())
	{
		$dispatcher = new Castellan();

		$dispatcher->addListener('example.event', array(new Listener_Example, 'event'));
		$dispatcher->addListener('example.staticEvent', 'Listener::staticEvent');

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
		$dispatcher = new Repository_Dispatcher()->exampleDispatcher()->trigger('example.event');
	}

}

?>
```

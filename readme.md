### Castellan ###
A simple php event notifier.

## Example Factory

```php
<?php

use Castellan\Castellan;
use Castellan\Factory\FactoryInterface;

class Dispatcher_Factory implements FactoryInterface
{

	public function createDispatcher($listeners = array())
	{
		$dispatcher = new Castellan();

		$dispatcher->addListener('test.event', array(new Listener_Test, 'event'));

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
		$dispatcher = new Dispatcher_Factory()->createDispatcher()->trigger('example.event');
	}

}

?>
```
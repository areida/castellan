<?php

namespace Castellan;

use Castellan\Event;

/**
 * Castellan
 */
class Castellan
{
	protected $_listeners = array();

	public function addListener($name, $listener)
	{
		if ( ! array_key_exists($name, $this->_listeners))
		{
			$this->_listeners[$name] = array();
		}

		$this->_listeners[$name][] = $listener;

		return $this;
	}

	public function addListeners($listeners = array())
	{
		foreach ($listeners as $name => $callbacks)
		{
			if (is_array($callbacks))
			{
				foreach ($callbacks as $callback)
				{
					$this->addListener($name, $callback);
				}
			}
			else
			{
				$this->addListener($name, $listener);
			}
		}

		return $this;
	}

	public function removeListener($name, $listener)
	{
		if (isset($this->_listeners[$name]))
		{
			foreach ($this->_listeners[$name] as $i => $callable)
			{
				if ($listener === $callable)
				{
					unset($this->_listeners[$name][$i]);
				}
			}
		}

		return $this;
	}

	public function trigger($nameOrEvent, $target = NULL, $parameters = array())
	{
		if ($nameOrEvent instanceof Event)
		{
			$event = $nameOrEvent;
		}
		else
		{
			$event = new Event($nameOrEvent, $target, $parameters);
		}

		foreach ($this->_listeners[$event->name] as $listener)
		{
			if (is_array($listener))
			{
				call_user_func(array($listener[0], $listener[1]), $event);
			}
			else
			{
				call_user_func($listener, $event);
			}
		}

		return $event;
	}

	public function hasListeners($name)
	{
		if ( ! isset($this->_listeners[$name]))
		{
			$this->_listeners[$name] = array();
		}

		return (boolean) count($this->_listeners[$name]);
	}

	public function getListeners($name)
	{
		if ( ! isset($this->_listeners[$name]))
		{
			return array();
		}

		return $this->_listeners[$name];
	}

}
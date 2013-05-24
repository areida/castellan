<?php

namespace Castellan;

/**
 * Castellan Event
 */
class Event
{
	protected $_name       = NULL;
	protected $_parameters = array();
	protected $_processed  = FALSE;
	protected $_target     = NULL;
	protected $_value      = NULL;

	public function __construct($name, $target, $parameters = array())
	{
		$this->_name       = $name;
		$this->_parameters = $parameters;
		$this->_target     = $target;
	}

	public function __get($key)
	{
		if (in_array($key, array('name', 'parameters', 'processed', 'target', 'value')))
			return $this->{'_'.$key};
		else
			throw new Exception(sprintf('The property "%s" does not exist.', $key));
	}

	public function __set($key, $value)
	{
		if (in_array($key, array('name', 'parameters', 'target', 'value')))
		{
			$this->{'_'.$key} = $value;
		}
		elseif ($key === 'processed')
		{
			$this->_processed = (boolean) $value;
		}
		else
		{
			throw new Exception(sprintf('The property "%s" does not exist.', $key));
		}

		return $this;
	}

	public function getParameter($key)
	{
		if ( ! $this->hasParameter($key))
			throw new Exception(sprintf('The event "%s" has no "%s" parameter.', $this->_name, $key));

		return $this->_parameters[$key];
	}

	public function hasParameter($key)
	{
		return array_key_exists($key, $this->_parameters);
	}

	public function setParameter($key, $value)
	{
		$this->_parameters[$key] = $value;
	}

	public function unsetParameter($key)
	{
		if ( ! $this->hasParameter($key))
			throw new Exception(sprintf('The event "%s" has no "%s" parameter.', $this->_name, $key));

		unset($this->_parameters[$key]);

		return $this;
	}

}
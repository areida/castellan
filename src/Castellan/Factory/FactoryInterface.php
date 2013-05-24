<?php

namespace Castellan\Factory;

use Castellan\Castallan;

interface FactoryInterface
{
	public function createDispatcher($listeners = array());
}
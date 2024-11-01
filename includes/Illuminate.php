<?php

namespace SpringDevs\SMS;

use SpringDevs\SMS\Illuminate\Order;
use SpringDevs\SMS\Illuminate\Providers;

/**
 * Illuminate class
 * All Global define here
 */
class Illuminate
{

    /**
     * Initialize the class
     */
    public function __construct()
    {
        new Order;
        new Providers;
    }
}

<?php

namespace SpringDevs\SMS;

use SpringDevs\SMS\Frontend\Checkout;

/**
 * Frontend handler class
 */
class Frontend
{
    /**
     * Frontend constructor.
     */
    public function __construct()
    {
        new Checkout;
        new Illuminate;
    }
}

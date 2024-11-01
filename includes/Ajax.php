<?php

namespace SpringDevs\SMS;

use SpringDevs\SMS\Ajax\Form;
use SpringDevs\SMS\Ajax\GetData;
use SpringDevs\SMS\Ajax\Verify;

/**
 * Ajax Class
 */
class Ajax
{

    /**
     * Initialize the class
     */
    public function __construct()
    {
        new Form;
        new Verify;
        new GetData;
    }
}

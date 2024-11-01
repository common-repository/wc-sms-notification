<?php

namespace SpringDevs\SMS;

use SpringDevs\SMS\Admin\Forms;

/**
 * The admin class
 */
class Admin
{

    /**
     * Initialize the class
     */
    public function __construct()
    {
        $this->dispatch_actions();
        new Admin\Menu();
        new Forms;
        new Illuminate;
    }

    /**
     * Dispatch and bind actions
     *
     * @return void
     */
    public function dispatch_actions()
    {
    }
}

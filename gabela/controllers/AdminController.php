<?php

namespace Gabela\Controller;

use Gabela\Core\AbstractController;
use Gabela\Core\Middleware\Middleware;

class AdminController extends AbstractController
{
    public function Action()
    {
        printValue('This is the admin page');
    }
}

Middleware::resolve('admin');
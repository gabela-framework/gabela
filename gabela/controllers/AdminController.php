<?php

namespace Gabela\Controller;

use Gabela\Core\AbstractController;
use Gabela\Core\Middleware\Middleware;

class AdminController extends AbstractController
{
    public function Action()
    {
        printValue('You are authorized to be in this page');
    }
}

Middleware::resolve('admin');
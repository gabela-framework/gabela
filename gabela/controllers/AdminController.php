<?php

namespace Gabela\Controller;

use Gabela\Core\AbstractController;
use Gabela\Core\Middleware\Middleware;

class AdminController extends AbstractController
{
    public function Action()
    {
        $this->getTemplate('gabela/views/admin.view.php');
    }
}

Middleware::resolve('admin');
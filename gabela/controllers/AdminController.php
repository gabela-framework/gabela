<?php

namespace Gabela\Controller;

use Gabela\Core\AbstractController;
use Gabela\Core\Middleware\Middleware;

class AdminController extends AbstractController
{
    public function Action()
    {
        $data = ['tittle'=> 'Admin dashboad'];
        $this->renderTemplate('gabela/views/admin.view.php', $data);
    }
}

Middleware::resolve('admin');
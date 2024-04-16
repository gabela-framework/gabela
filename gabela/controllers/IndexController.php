<?php

namespace Gabela\Controller;

use Gabela\Core\Session;
use Gabela\Core\AbstractController;

class IndexController extends AbstractController
{
    public function Index()
    {
        $data = [
            'tittle' => 'Official Gabela framework home',
            'userEmail' => Session::getCurrentUserEmail()
        ];
        $this->renderTemplate(HOME_PAGE, $data);
    }
}
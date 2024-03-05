<?php

namespace Gabela\Controller;

use Gabela\Core\AbstractController;

class IndexController extends AbstractController
{
    public function Index()
    {
        $this->getTemplate(HOME_PAGE);
    }

    
}
<?php

namespace Gabela\Controller;

use Gabela\Core\Middleware\Middleware;

    class SettingsController extends \Gabela\Core\AbstractController
    {
        public function Action()
        {
            $this->getTemplate(ADMIN_SETTINGS);
        }
    }

    Middleware::resolve('admin');
<?php

namespace Gabela\Controller;

use Gabela\Core\AbstractController;

class ResetPasswordController extends AbstractController
{
    public function reset()
    {
        $this->getTemplate(USER_PASSWORD_RESET);
    }
}
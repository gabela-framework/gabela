<?php

namespace Gabela\Controller;

use Gabela\Core\AbstractController;

class ForgotPasswordController extends AbstractController
{
    public function forgot()
    {
        $this->getTemplate(FORGOT_PASSWORD_PAGE);
    }
}
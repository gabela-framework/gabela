<?php

namespace Gabela\Controller;

use Gabela\Core\AbstractController;

class ForgotPasswordController extends AbstractController
{
    public function forgot()
    {
        $data = ['tittle' => 'Forgot password page'];
        $this->renderTemplate(FORGOT_PASSWORD_PAGE, $data);
    }
}
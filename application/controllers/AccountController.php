<?php

class AccountController extends controller
{
    public function signupAction()
    {
        return $this->render(array(
            '_token' => $this->generateCsrfToken('account/signup'),
        ));
    }
}
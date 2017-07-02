<?php

trait LoginUsers {

    protected function login(array $credentials = [])
    {
        return $this->visit(route('admin.auth.login'))
            ->type($credentials['email'], 'email')
            ->type($credentials['password'], 'password')
            ->press('Login')
        ;
    }
}
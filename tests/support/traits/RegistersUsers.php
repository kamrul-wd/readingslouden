<?php

use App\Models\User;

trait RegistersUsers {

	protected function register($route, array $overrides = [])
	{
		$fields = $this->getRegisterFields($overrides);

		return $this->visit($route)
			->submitForm('Register', $fields);
	}

	protected function getRegisterFields(array $overrides = [])
	{
		$user = factory(User::class)->create($overrides);

		unset($user['activation_code']);

		return $user;
	}

}
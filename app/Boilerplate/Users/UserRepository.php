<?php namespace Boilerplate\Users;

/**
 * Class UserRepository
 * @package Boilerplate\Users
 */
class UserRepository {

	/**
	 * Persist a user
	 *
	 * @param User $user
	 * @return mixed
	 */
	public function save(User $user)
	{
		return $user->save();
	}

	/**
	 * Update a user
	 *
	 * @param User $user
	 * @param $userId
	 * @return mixed
	 */
	public function update(User $user, $userId)
	{
		$userUpdate = User::findOrFail($userId);

		$userUpdate->firstname = $user->firstname;
		$userUpdate->name = $user->name;
		$userUpdate->email = $user->email;

		return $userUpdate->save();
	}
}
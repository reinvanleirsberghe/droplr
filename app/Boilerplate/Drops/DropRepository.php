<?php namespace Boilerplate\Drops;

use Boilerplate\Users\User;
use Illuminate\Support\Facades\Auth;

class DropRepository {

	/**
	 * Adds a drop
	 *
	 * @param Drop $drop
	 * @internal param \Boilerplate\Drops\User $user
	 * @return mixed
	 */
	public function add(Drop $drop)
	{
		return User::findOrFail(Auth::user()->id)
			->drops()
			->save($drop);
	}

	/**
	 * Update a drops info
	 *
	 * @param Drop $drop
	 * @param $id
	 * @return mixed
	 */
	public function updateInfo(Drop $drop, $id){
		$dropToUpdate = Drop::where('user_id', Auth::user()->id)->findOrFail($id);

		$dropToUpdate->name = $drop->name;
		$dropToUpdate->description = $drop->description;

		$dropToUpdate->save();

		return $dropToUpdate;
	}

	/**
	 * Loads a drop for a given user
	 *
	 * @param $id
	 * @return mixed
	 */
	public function loadForUserById($id)
	{
		return Drop::where('user_id', Auth::user()->id)->findOrFail($id);
	}

	/**
	 * Loads a drop byId
	 *
	 * @param $id
	 * @return mixed
	 */
	public function loadById($id)
	{
		return Drop::findOrFail($id);
	}

	/**
	 * Delete a drop byId
	 *
	 * @param $id
	 */
	public function deleteById($id)
	{
		$drop = Drop::where('user_id', Auth::user()->id)->findOrFail($id);

		$drop->delete();
	}

	/**
	 * Get all drops
	 *
	 * @return mixed
	 */
	public function getAll()
	{
		return Drop::all();
	}

	/**
	 * Get all markers of a drop
	 *
	 * @param $id
	 * @return mixed
	 */
	public function getAllMarkers($id)
	{
		return Drop::findOrFail($id)
			->markers()
			->orderBy('order')
			->orderBy('id')
			->get();
	}

	/**
	 * Get all the drops for a User
	 *
	 * @param \Boilerplate\Users\User $user
	 * @return mixed
	 */
	public function getAllForUser(User $user)
	{
		return $user->drops()->latest()->get();
	}
}
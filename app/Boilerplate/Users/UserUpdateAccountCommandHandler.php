<?php namespace Boilerplate\Users;

use Laracasts\Commander\CommandHandler;

class UserUpdateAccountCommandHandler implements CommandHandler {

	protected $userRepository;

	function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	/**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {
		$user = User::updateUser(
			$command->firstname, $command->name, $command->email
		);

		$user = $this->userRepository->update($user, $command->userId);
    }

}
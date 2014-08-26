<?php namespace Boilerplate\Registration;

use Boilerplate\Users\User;
use Boilerplate\Users\UserRepository;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class RegisterUserCommandHandler implements CommandHandler {

	use DispatchableTrait;

	/**
	 * @var
	 */
	protected $userRepository;

	/**
	 * @param UserRepository $userRepository
	 */
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
		$user = User::register(
			$command->firstname, $command->name, $command->email, $command->password
		);

		$this->userRepository->save($user);

		$this->dispatchEventsFor($user);

		return $user;
    }

}
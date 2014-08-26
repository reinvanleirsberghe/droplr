<?php namespace Boilerplate\Drops;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class AddDropCommandHandler implements CommandHandler {

	use DispatchableTrait;

	/**
	 * @var DropRepository
	 */
	protected $dropRepository;

	/**
	 * @param DropRepository $dropRepository
	 */
	function __construct(DropRepository $dropRepository)
	{
		$this->dropRepository = $dropRepository;
	}

	/**
	 * Handle the command.
	 *
	 * @param object $command
	 * @return void
	 */
	public function handle($command)
	{
		$drop = Drop::add(
			$command->name, $command->description
		);

		$this->dropRepository->add($drop);

		$this->dispatchEventsFor($drop);

		return $drop;
	}

}
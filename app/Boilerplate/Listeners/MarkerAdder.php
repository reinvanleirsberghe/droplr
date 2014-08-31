<?php namespace Boilerplate\Listeners;

use Boilerplate\Drops\Events\DropAdded;
use Boilerplate\Markers\Marker;
use Boilerplate\Markers\MarkerRepository;
use Laracasts\Commander\Events\EventListener;

class MarkerAdder extends EventListener{

    function __construct(MarkerRepository $markerRepository)
    {
        $this->markerRepository = $markerRepository;
    }

    /**
     * Add a first marker when a drop was added
     *
     * @param \Boilerplate\Drops\Events\DropAdded $event
     */
    public function whenDropAdded(DropAdded $event)
    {
        $marker = Marker::add(
            $event->drop->name, $event->drop->lat, $event->drop->lng
        );

        $this->markerRepository->add($marker, $event->drop->id);
    }
}

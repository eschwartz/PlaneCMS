<?php

namespace PlaneCms;


use PlaneCms\Event\ApplicationEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Application {

	/** @var EventDispatcher */
	protected $eventDispatcher;

	public function __construct(array $config = null) {
		$this->eventDispatcher = new EventDispatcher();

		if ($config) {
			$this->configure($config);
		}
	}

	public function configure(array $config) {
		// this will probably do some configuration stuff
		// with the service locator.
	}

	public function run() {
		$appEvent = new ApplicationEvent();

		try {
			/**
			 * Event: application.bootstrap
			 *
			 * This at the very start of the application lifecycle,
			 * before any other application logic.
			 */
			$this->eventDispatcher->dispatch('application.bootstrap', $appEvent);

			/**
			 * Determine the route of the incoming
			 * request.
			 */
			$this->eventDispatcher->dispatch('application.route', $appEvent);


			/**
			 * Render the requested content,
			 * updating the ApplicationLifecycleEvent::content property.
			 */
			$this->eventDispatcher->dispatch('application.render', $appEvent);

			/**
			 * Application lifecycle is complete.
			 */
			$this->eventDispatcher->dispatch('application.finish', $appEvent);

			$response = $appEvent->getResponse();
			$response->send();
		}
		catch (\Exception $ex) {
			$appEvent->setException($ex);

			/**
			 * An error occurred during the application lifecycle.
			 */
			$this->eventDispatcher->dispatch('application.error');
		}
	}


	/**
	 * @return EventDispatcher
	 */
	public function getEventDispatcher() {
		return $this->eventDispatcher;
	}

}
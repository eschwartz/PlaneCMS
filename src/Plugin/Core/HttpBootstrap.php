<?php

namespace PlaneCms\Plugin\Core;


use PlaneCms\Event\ApplicationEvent;
use PlaneCms\Plugin\PluginInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HttpBootstrap implements PluginInterface {


	/**
	 * Returns an array of event names this subscriber wants to listen to.
	 *
	 * The array keys are event names and the value can be:
	 *
	 *  * The method name to call (priority defaults to 0)
	 *  * An array composed of the method name to call and the priority
	 *  * An array of arrays composed of the method names to call and respective
	 *    priorities, or 0 if unset
	 *
	 * For instance:
	 *
	 *  * array('eventName' => 'methodName')
	 *  * array('eventName' => array('methodName', $priority))
	 *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
	 *
	 * @return array The event names to listen to
	 *
	 * @api
	 */
	public static function getSubscribedEvents() {
		return [
			'application.bootstrap' => [
				['provideRequestObject', 1000],
				['provideResponseObject', 1000]
			]
		];
	}

	public function provideRequestObject(ApplicationEvent $event) {
		$request = Request::createFromGlobals();
		$event->setRequest($request);
	}

	public function provideResponseObject(ApplicationEvent $event) {
		$response = new Response();
		$event->setResponse($response);
	}
}
<?php

namespace PlaneCms\Event;


use PlaneCms\Route\RouteMatchInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplicationEvent extends Event {

	/** @var Request */
	protected $request;

	/** @var Response */
	protected $response;

	/** @var RouteMatchInterface */
	protected $routeMatch;

	/** @var \Exception|null */
	protected $exception;


	/**
	 * @return \Exception|null
	 */
	public function getException() {
		return $this->exception;
	}

	/**
	 * @param \Exception|null $exception
	 */
	public function setException(\Exception $exception) {
		$this->exception = $exception;
	}

	/**
	 * @return Request
	 */
	public function getRequest() {
		return $this->request;
	}

	/**
	 * @param Request $request
	 */
	public function setRequest(Request $request) {
		$this->request = $request;
	}

	/**
	 * @return Response
	 */
	public function getResponse() {
		return $this->response;
	}

	/**
	 * @param Response $response
	 */
	public function setResponse(Response $response) {
		$this->response = $response;
	}

	/**
	 * @return RouteMatchInterface
	 */
	public function getRouteMatch() {
		return $this->routeMatch;
	}

	/**
	 * @param RouteMatchInterface $routeMatch
	 */
	public function setRouteMatch(RouteMatchInterface $routeMatch) {
		$this->routeMatch = $routeMatch;
	}

}
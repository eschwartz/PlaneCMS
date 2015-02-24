<?php

namespace PlaneCms\Plugin\Core;


use PlaneCms\Event\ApplicationEvent;
use PlaneCms\Exception\RequestedContentNotFoundException;
use PlaneCms\Plugin\PluginInterface;
use PlaneCms\Route\MarkdownFileRouteMatch;
use Symfony\Component\Filesystem\Filesystem;

class MarkdownFileRouter implements PluginInterface {

	/** @var string */
	protected $contentDir;

	/** @var string */
	protected $markdownExtension = 'md';

	public function __construct() {
		// TODO: this should be injected.
		// just hard coding for now for testing.
		$this->contentDir = __DIR__ . '/../../../content';
	}

	public static function getSubscribedEvents() {
		return [
			'application.route' => ['provideRouteMatch', 10]
		];
	}

	public function provideRouteMatch(ApplicationEvent $event) {
		$request = $event->getRequest();
		$path = $request->getPathInfo();

		// Find a markdown file matching the request path
		$markdownFilePath = $this->contentDir . $path . '.md';

		$fs = new Filesystem();
		if (!$fs->exists($markdownFilePath)) {
			throw new RequestedContentNotFoundException(
				"Unable to find content for request at $path. " .
				"Tried to find a markdown file at $markdownFilePath"
			);
		}

		$routeMatch = new MarkdownFileRouteMatch();
		$routeMatch->setUri($path);
		$routeMatch->setMarkdownFilePath($markdownFilePath);
		$event->setRouteMatch($routeMatch);
	}
}
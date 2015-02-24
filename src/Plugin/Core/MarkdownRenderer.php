<?php

namespace PlaneCms\Plugin\Core;


use PlaneCms\Event\ApplicationEvent;
use PlaneCms\Exception\MarkdownRenderException;
use PlaneCms\Exception\UnexpectedApplicationStateException;
use PlaneCms\Plugin\PluginInterface;
use PlaneCms\Route\MarkdownFileRouteMatch;

class MarkdownRenderer implements PluginInterface {

	public static function getSubscribedEvents() {
		return [
			'application.render' => ['provideResponseContent', 10]
		];
	}

	public function provideResponseContent(ApplicationEvent $event) {
		$routeMatch = $event->getRouteMatch();

		if (!$routeMatch instanceof MarkdownFileRouteMatch || !$routeMatch->getMarkdownFilePath()) {
			throw new UnexpectedApplicationStateException(
				"Expected application event to contain a MarkdownFileRouteMatch with a valid markdown file path."
			);
		}

		$markdown = file_get_contents($routeMatch->getMarkdownFilePath());
		if (!$markdown) {
			throw new MarkdownRenderException("Failed to read markdown file at {$routeMatch->getMarkdownFilePath()}");
		}

		$html = $this->parseMarkdown($markdown);

		$event->getResponse()
			->setContent($html);
	}

	/**
	 * @param string $contentDir
	 */
	public function setContentDir($contentDir) {
		$this->contentDir = $contentDir;
	}

	/**
	 * @param string $markdownFileExtension
	 */
	public function setMarkdownFileExtension($markdownFileExtension) {
		$this->markdownFileExtension = $markdownFileExtension;
	}

	/**
	 * @param string $markdown
	 * @return string
	 */
	protected function parseMarkdown($markdown) {
		try {
			$parser = new \Parsedown();

			return $parser->parse($markdown);
		}
		catch (\Exception $ex) {
			throw new MarkdownRenderException("Failed to render markdown: {$ex->getMessage()}");
		}
	}
}
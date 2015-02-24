<?php

namespace PlaneCms\Route;


class MarkdownFileRouteMatch implements RouteMatchInterface {

	/** @var string */
	protected $uri;

	/** @var string */
	protected $markdownFilePath;

	/**
	 * @return string
	 */
	public function getUri() {
		return $this->uri;
	}

	/**
	 * @param string $uri
	 */
	public function setUri($uri) {
		$this->uri = $uri;
	}

	/**
	 * @return string
	 */
	public function getMarkdownFilePath() {
		return $this->markdownFilePath;
	}

	/**
	 * @param string $markdownFilePath
	 */
	public function setMarkdownFilePath($markdownFilePath) {
		$this->markdownFilePath = $markdownFilePath;
	}
}
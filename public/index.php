<?php
use PlaneCms\Plugin\Core\HttpBootstrap;
use PlaneCms\Plugin\Core\MarkdownFileRouter;
use PlaneCms\Plugin\Core\MarkdownRenderer;

require_once(__DIR__ . '/../vendor/autoload.php');

$app = new \PlaneCms\Application();

$eventDispatcher = $app->getEventDispatcher();

$eventDispatcher->addSubscriber(new HttpBootstrap());
$eventDispatcher->addSubscriber(new MarkdownFileRouter());
$eventDispatcher->addSubscriber(new MarkdownRenderer());

$app->run();
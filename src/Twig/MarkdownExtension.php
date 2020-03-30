<?php

namespace App\Twig;

use App\Service\MarkdownTransformer;
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MarkdownExtension extends AbstractExtension implements ServiceSubscriberInterface {
	private $container;

	public function __construct(ContainerInterface $container) {

		$this->container = $container;
	}

  public function getFilters():array {
    return [
      new TwigFilter('markdownify', array($this, 'parseMarkdown'), [
        'is_safe' => ['html']
      ])
    ];
  }

  public function parseMarkdown($str) {
    return $this->container->get(MarkdownTransformer::class)->parse($str);
  }

	public static function getSubscribedServices() {
		return [
			MarkdownTransformer::class
		];
	}
}

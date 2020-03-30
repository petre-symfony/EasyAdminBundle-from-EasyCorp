<?php

namespace App\Service;

use Doctrine\Common\Cache\Cache;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownTransformer {
  private $markdownParser;
	private $cache;

	public function __construct(AdapterInterface $cache, MarkdownParserInterface $markdownParser) {
    $this->markdownParser = $markdownParser;
		$this->cache = $cache;
	}

  public function parse(string $source):string {
	  $item = $this->cache->getItem('markdown_'.md5($source));
	  if (!$item->isHit()) {
		  $item->set($this->markdownParser->transformMarkdown($source));
		  $this->cache->save($item);
	  }

	  return $item->get();
  }
}

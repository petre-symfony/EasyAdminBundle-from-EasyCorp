<?php


namespace App\Twig;


use App\Entity\Genus;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class EasyAdminExtension extends AbstractExtension  {
	public function getFilters() {
		return [
			new TwigFilter('filter_admin_actions', [$this, 'filterActions'])
		];
	}

	public function filterActions(array $itemActions, $item){
		if($item instanceof Genus && $item->getIsPublished()){
			unset($itemActions['delete']);
		}

		return $itemActions;
	}
}
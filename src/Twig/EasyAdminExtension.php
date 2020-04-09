<?php


namespace App\Twig;


use App\Entity\Genus;
use App\Entity\User;
use Psr\Container\ContainerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class EasyAdminExtension extends AbstractExtension  implements ServiceSubscriberInterface {
	private $container;

	public function __construct(ContainerInterface $container) {
		$this->container = $container;
	}

	public function getFilters() {
		return [
			new TwigFilter('filter_admin_actions', [$this, 'filterActions'])
		];
	}

	public function filterActions(array $itemActions, $item){
		if($item instanceof Genus && $item->getIsPublished()){
			unset($itemActions['delete']);
		}

		if($item instanceof User &&
			!$this->container->get(AuthorizationCheckerInterface::class)
				->isGranted('ROLE_SUPERADMIN'))
		{
			unset($itemActions['edit']);
		}
		return $itemActions;
	}

	public static function getSubscribedServices() {
		return [
			AuthorizationCheckerInterface::class
		];
	}
}
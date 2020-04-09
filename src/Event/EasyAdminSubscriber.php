<?php
namespace App\Event;


use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class EasyAdminSubscriber implements EventSubscriberInterface {
	private $tokenStorage;

	public function __construct(TokenStorageInterface $tokenStorage) {
		$this->tokenStorage = $tokenStorage;
	}

	public static function getSubscribedEvents() {
		return [
			EasyAdminEvents::PRE_UPDATE => 'onPreUpdate',
			EasyAdminEvents::POST_EDIT => 'onPreEdit'
		];
	}

	public function onPreUpdate(GenericEvent $event) {
		$entity = $event->getSubject();

		if($entity instanceof User){
			$user = $this->tokenStorage->getToken()->getUser();
			if (!$user instanceof User){
				$user = null;
			}


			$entity->setLastUpdatedBy($user);
		}
	}

	public function onPreEdit(GenericEvent $event){
		dd($event);
	}
}
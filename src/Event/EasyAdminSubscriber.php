<?php
namespace App\Event;


use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class EasyAdminSubscriber implements EventSubscriberInterface {
	public static function getSubscribedEvents() {
		return [
			EasyAdminEvents::PRE_UPDATE => 'onPreUpdate'
		];
	}

	public function onPreUpdate(GenericEvent $event) {
		dd($event);
	}

}
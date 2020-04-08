<?php


namespace App\Controller\EasyAdmin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController as BaseAdminController;

class UserController extends BaseAdminController {
	protected function updateEntity($entity) {
		$entity->setUpdatedAt(new \DateTime());
		parent::updateEntity($entity);
	}
}
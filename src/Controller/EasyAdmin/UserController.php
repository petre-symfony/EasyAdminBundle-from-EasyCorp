<?php
namespace App\Controller\EasyAdmin;


class UserController extends AdminController {
	protected function updateEntity($entity) {
		$entity->setUpdatedAt(new \DateTime());
		parent::updateEntity($entity);
	}
}
<?php


namespace App\Controller\EasyAdmin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController as BaseAdminController;

class AdminController extends BaseAdminController {
	public function exportAction(){
		throw new \RuntimeException('Action for exporting an entity is not defined');
	}
}
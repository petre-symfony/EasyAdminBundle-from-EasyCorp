<?php


namespace App\Controller\EasyAdmin;

use App\Entity\Genus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController as BaseAdminController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends BaseAdminController {
	public function exportAction(){
		throw new \RuntimeException('Action for exporting an entity is not defined');
	}

	/**
	 * @Route("/dashboard", name="admin_dashboard")
	 */
	public function dashboardAction() {
		$em = $this->getDoctrine()->getManager();
		$genusRepository = $em->getRepository(Genus::class);

		return $this->render('easy_admin/dashboard.html.twig', [
			'genusCount' => $genusRepository->getGenusCount(),
			'publishedGenusCount' => $genusRepository->getPublishedGenusCount(),
			'randomGenus' => $genusRepository->findRandomGenus()
		]);
	}
}
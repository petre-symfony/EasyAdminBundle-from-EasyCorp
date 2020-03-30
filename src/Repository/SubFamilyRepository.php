<?php

namespace App\Repository;

use App\Entity\SubFamily;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SubFamilyRepository extends ServiceEntityRepository {
	public function __construct(ManagerRegistry $registry) {
		parent::__construct($registry, SubFamily::class);
	}

	public function createAlphabeticalQueryBuilder() {
    return $this->createQueryBuilder('sub_family')
      ->orderBy('sub_family.name', 'ASC');
  }

  /**
   * Helper method to return ANY SubFamily.
   *
   * This is mostly useful when playing and testing things.
   *
   * @return SubFamily
   */
  public function findAny() {
    return $this->createQueryBuilder('sub_family')
      ->setMaxResults(1)
      ->getQuery()
      ->getOneOrNullResult();
  }
}

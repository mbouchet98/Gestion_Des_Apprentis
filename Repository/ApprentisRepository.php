<?php

namespace ApprentisBundle\Repository;

/**
 * ApprentisRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ApprentisRepository extends \Doctrine\ORM\EntityRepository
{
	/*public function findBaseAdherent(){
		$maRequete=$this->createQueryBuilder('a');
		
		$maRequete->orderBy ('a.nomA','asc');
		
		return $maRequete
			->getQuery()
			->getResult()
		;	
	}*/
}
?>
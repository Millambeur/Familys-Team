<?php

namespace Altgeek\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class UserRepository extends \Doctrine\ORM\EntityRepository
{
	public function getUsers($page, $nbPerPage)
	{
		$query = $this->createQueryBuilder('a')
		  ->orderBy('a.id', 'DESC')
		  ->getQuery()
		;
		$query
		  ->setFirstResult(($page-1) * $nbPerPage)
		  ->setMaxResults($nbPerPage)
		;

		return new Paginator($query, true);
	}
}

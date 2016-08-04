<?php

namespace Altgeek\ForumBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class UberTopicRepository extends \Doctrine\ORM\EntityRepository
{
	public function getUberTopics($page, $nbPerPage)
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

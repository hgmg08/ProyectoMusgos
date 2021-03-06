<?php

namespace repositories;

use Doctrine\ORM\EntityRepository,
	Doctrine\ORM\Query;

/**
 * RoleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RoleRepository extends EntityRepository
{
	public function getAll()
	{
		$query = $this->_em->createQuery(
			"SELECT r.id, r.name FROM entities\Role r"
		);
		return $query->getResult(Query::HYDRATE_ARRAY);
	}
}
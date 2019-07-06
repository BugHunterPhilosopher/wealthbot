<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * DocumentOwnerSignatureRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DocumentOwnerSignatureRepository extends EntityRepository
{
    public function findOneByDocumentSignatureIdAndOwnerEmail($documentSignatureId, $email)
    {
        $qb = $this->createQueryBuilder('ds');
        $qb->leftJoin('ds.clientOwner', 'user_owner')
            ->leftJoin('ds.contactOwner', 'contact_owner')
            ->where('ds.document_signature_id = :document_signature_id')
            ->andWhere('user_owner.email = :email OR contact_owner.email = :email')
            ->setMaxResults(1)
            ->setParameters([
                'document_signature_id' => $documentSignatureId,
                'email' => $email,
            ]);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
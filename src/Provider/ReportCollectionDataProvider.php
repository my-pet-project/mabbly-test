<?php

namespace App\Provider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Team;
use App\Model\Report;
use Doctrine\Persistence\ManagerRegistry;

final class ReportCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private ManagerRegistry $registry;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Report::class === $resourceClass;
    }

    /**
     * Retrieves a collection.
     *
     * @param string $resourceClass
     * @param string|null $operationName
     *
     * @return Report
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        $report = new Report();
        $report->setTeams($this->registry->getRepository(Team::class)->findAll());

        return $report;
    }
}

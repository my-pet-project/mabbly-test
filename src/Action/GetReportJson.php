<?php

namespace App\Action;

use App\Model\Report;
use App\Provider\ReportCollectionDataProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GetReportJson extends AbstractController
{
    private ReportCollectionDataProvider $reportCollectionDataProvider;

    /**
     * @param ReportCollectionDataProvider $reportCollectionDataProvider
     */
    public function __construct(ReportCollectionDataProvider $reportCollectionDataProvider)
    {
        $this->reportCollectionDataProvider = $reportCollectionDataProvider;
    }

    /**
     * @Route(
     *     name="report_json",
     *     path="/api/report/json",
     *     methods={"GET"}
     * )
     *
     * @return Response
     */
    public function __invoke(): Response
    {
        return $this->json($this->reportCollectionDataProvider->getCollection(Report::class));
    }
}

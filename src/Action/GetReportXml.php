<?php

namespace App\Action;

use App\Model\Report;
use App\Provider\ReportCollectionDataProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\SerializerInterface;

final class GetReportXml extends AbstractController
{
    private ReportCollectionDataProvider $reportCollectionDataProvider;
    private SerializerInterface $serializer;

    /**
     * @param ReportCollectionDataProvider $reportCollectionDataProvider
     * @param SerializerInterface $serializer
     */
    public function __construct(
        ReportCollectionDataProvider $reportCollectionDataProvider,
        SerializerInterface $serializer
    ) {
        $this->reportCollectionDataProvider = $reportCollectionDataProvider;
        $this->serializer = $serializer;
    }

    /**
     * @Route(
     *     name="report_xml",
     *     path="/api/report/xml",
     *     methods={"GET"}
     * )
     *
     * @return Response
     */
    public function __invoke(): Response
    {
        $report = $this->reportCollectionDataProvider->getCollection(Report::class);

        return new Response(
            $this->serializer->serialize(
                $report,
                XmlEncoder::FORMAT,
                [
                    XmlEncoder::ROOT_NODE_NAME => 'Report',
                    XmlEncoder::ENCODING => 'UTF-8',
                ]
            ),
            Response::HTTP_OK,
            ['Content-Type' => 'application/xml;charset=UTF-8']
        );
    }
}

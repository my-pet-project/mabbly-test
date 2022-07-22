<?php

namespace App\OpenApi;

use ApiPlatform\Core\JsonSchema\SchemaFactoryInterface;
use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\OpenApi;
use App\Model\Report;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetReportJsonFactory
 */
final class GetReportJsonFactory implements OpenApiFactoryInterface
{
    private OpenApiFactoryInterface $decorated;
    private SchemaFactoryInterface $schemaFactory;

    /**
     * @param OpenApiFactoryInterface $decorated
     * @param SchemaFactoryInterface $schemaFactory
     */
    public function __construct(OpenApiFactoryInterface $decorated, SchemaFactoryInterface $schemaFactory)
    {
        $this->decorated = $decorated;
        $this->schemaFactory = $schemaFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);
        $schemas = $openApi->getComponents()->getSchemas();

        $schemaResponse = $this->schemaFactory->buildSchema(Report::class, 'json');

        $schemas[$schemaResponse->getRootDefinitionKey()] =
            $schemaResponse->getDefinitions()[$schemaResponse->getRootDefinitionKey()];

        $openApi
            ->getPaths()
            ->addPath(
                '/api/report/json',
                new PathItem(
                    null, null, null, new Operation(
                        'report_json',
                        ['Report'],
                        [
                            Response::HTTP_OK => [
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            '$ref' => sprintf(
                                                '#/components/schemas/%s',
                                                $schemaResponse->getRootDefinitionKey()
                                            ),
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'Retrieves the number of books and top books (legacy endpoint).'
                    )
                )
            );

        return $openApi;
    }
}

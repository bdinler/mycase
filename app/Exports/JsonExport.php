<?php

namespace App\Exports;


use App\Contracts\FeedExportInterface;
use App\Model\Product;
use App\Services\BaseFeedService;
use App\Traits\Responder;
use Exception;

class JsonExport implements FeedExportInterface
{
    use Responder;

    /**
     * @var array
     */
    private array $products;
    private BaseFeedService $baseFeedService;

    /**
     * @param array $products
     * @param BaseFeedService $baseFeedService
     */
    public function __construct(array $products, BaseFeedService $baseFeedService)
    {
        $this->products = $products;
        $this->baseFeedService = $baseFeedService;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function export(): string
    {
        $schema = $this->baseFeedService->getJsonSchema();
        $returnProducts = [];

        foreach ($this->products as $key => $product) {
            $productModel = new Product($product);

            foreach ($schema as $schemaKey => $getter) {
                $returnProducts[$key][$schemaKey] = $productModel->$getter();
            }

        }

        return $this->jsonResponse($returnProducts);
    }
}
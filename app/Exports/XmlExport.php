<?php

namespace App\Exports;

use App\Contracts\FeedExportInterface;
use App\Services\BaseFeedService;
use App\Traits\Responder;
use Exception;
use SimpleXMLElement;
use App\Model\Product;

class XmlExport implements FeedExportInterface
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
        $schema = $this->baseFeedService->getXmlSchema();
        $xml = new SimpleXMLElement(sprintf("<%s />", $schema['container']));

        foreach ($this->products as $product) {
            $product = new Product($product);
            $track = $xml->addChild($schema['item_name']);

            foreach ($schema['item'] as $sKey => $getter) {
                $track->addChild($sKey, $product->$getter());
            }

        }

        $xmlData = $xml->asXML();

        return $this->xmlResponse($xmlData);
    }
}
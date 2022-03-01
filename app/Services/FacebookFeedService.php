<?php

namespace App\Services;


class FacebookFeedService extends BaseFeedService
{
    public function __construct()
    {
        $this->setXmlSchema();
        $this->setJsonSchema();
    }

    /**
     * @return void
     */
    public function setXmlSchema(): void
    {
        $this->xmlSchema = [
            'container' => 'products',
            'item_name' => 'product',
            'item' => [
                'title' => 'getName',
                'id' => 'getId',
                'price' => 'getPrice',
                'product_category' => 'getCategory',
            ]
        ];
    }

    /**
     * @return void
     */
    public function setJsonSchema(): void
    {
        $this->jsonSchema = [
            'title' => 'getName',
            'id' => 'getId',
            'price' => 'getPrice',
            'category' => 'getCategory'
        ];
    }
}
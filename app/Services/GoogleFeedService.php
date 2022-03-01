<?php

namespace App\Services;


class GoogleFeedService extends BaseFeedService
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
            'container' => 'rss',
            'item_name' => 'channel',
            'item' => [
                'g:title' => 'getName',
                'g:id' => 'getId',
                'g:price' => 'getPrice',
                'g:google_product_category' => 'getCategory',
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
            'google_product_category' => 'getCategory'
        ];
    }
}
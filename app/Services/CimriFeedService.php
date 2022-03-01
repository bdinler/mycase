<?php

namespace App\Services;


class CimriFeedService extends BaseFeedService
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
                'title' => 'getName',
                'id' => 'getId',
                'price' => 'getPrice',
                'category' => 'getCategory',
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
            'cimri_category' => 'getCategory'
        ];
    }
}
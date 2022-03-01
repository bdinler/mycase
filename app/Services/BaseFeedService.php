<?php

namespace App\Services;


abstract class BaseFeedService
{
    protected array $xmlSchema = [];
    protected array $jsonSchema = [];

    /**
     * @return void
     */
    public abstract function setXmlSchema(): void;

    /**
     * @return void
     */
    public abstract function setJsonSchema(): void;

    /**
     * @return array
     */
    public function getXmlSchema(): array
    {
        return $this->xmlSchema;
    }

    /**
     * @return array
     */
    public function getJsonSchema(): array
    {
        return $this->jsonSchema;
    }
}
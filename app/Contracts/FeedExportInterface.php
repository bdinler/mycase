<?php

namespace App\Contracts;


interface FeedExportInterface
{
    public function export(): string;
}
<?php

namespace App\Controller;


use App\Contracts\FeedExportInterface;
use App\Core\Request;
use App\Exception\NotFeedServiceException;
use App\Exception\NotFeedExportException;

class FeedController
{
    /**
     * @param Request $request
     * @return string
     * @throws NotFeedServiceException
     * @throws NotFeedExportException
     */
    public function feedBuild(Request $request): string
    {
        $feedName = $request->getRouteParam('class');
        $feedType = $request->getRouteParam('type');

        $products = json_decode(file_get_contents(__DIR__ . '/../../store/products.json'), true);

        $feedClass = sprintf("\\App\\Services\\%sFeedService", ucfirst($feedName));
        if(!class_exists($feedClass)) {
            throw new NotFeedServiceException(sprintf("%sFeedService Class not found", ucfirst($feedName)), 422);
        }

        $exportClass = sprintf("\\App\\Exports\\%sExport", ucfirst($feedType));
        if(!class_exists($exportClass)) {
            throw new NotFeedExportException(sprintf("%sExport Class not found", ucfirst($feedType)), 422);
        }

        return $this->exportFeed(new $exportClass($products, new $feedClass()));
    }

    /**
     * @param FeedExportInterface $feedService
     * @return string
     */
    private function exportFeed(FeedExportInterface $feedService): string
    {
        return $feedService->export();
    }
}
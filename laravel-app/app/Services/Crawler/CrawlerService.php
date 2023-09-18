<?php

namespace App\Services\Crawler;

use App\Models\Link;
use App\Models\Target;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerService extends AbstractBrowser
{


    protected function doRequest(object $request)
    {
        // TODO: Implement doRequest() method.
    }
}

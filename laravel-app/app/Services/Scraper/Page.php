<?php

namespace App\Services\Scraper;

class Page
{
    public string $url;
    public string $title;
    public array $links;

    public function __construct(string $url, string $title, array $links)
    {
        $this->url = $url;
        $this->title = $title;
        $this->links = $links;
    }
}

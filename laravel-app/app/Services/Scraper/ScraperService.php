<?php

namespace App\Services\Scraper;

use App\Models\Link;
use App\Models\Target;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\BrowserKit\CookieJar;
use Symfony\Component\BrowserKit\History;
use Symfony\Component\DomCrawler\Crawler;


class ScraperService
{
    private string $urlRegex = '/https?:\/\/[^\s]+/';
    private Crawler $crawlerInstance;
    private string $url;
    private int $depth = 1;
    public string $title = '';
    private array $pages = [];  // Array to store Page objects
    private string $pageContent;
    private array $queue = [];
    private array $visited = [];
    private array $links = [];

    /**
     * @throws Exception
     */
    public function __construct(string $url, int $depth = 1)
    {

        $this->url = $url;
        $this->depth = $depth;
        $this->queue = [...$this->queue, $url];
        $this->scrape(0);
    }


    /**
     * @throws Exception
     */
    protected function scrape(int $currentDepth): void
    {
        if ($currentDepth >= $this->depth) {
            return;
        }

        $tempQueue = $this->queue;
        $this->queue = [];

        foreach ($tempQueue as $url) {
            if (in_array($url, $this->visited)) {
                continue;
            }

            $this->visited[] = $url;

            $client = new Client();
            try {
                $response = $client->request('GET', $url);
                $this->pageContent = $response->getBody()->getContents();
                $this->crawlerInstance = new Crawler($this->pageContent, $url);
            } catch (GuzzleException $e) {
                throw new Exception($e->getMessage());
            }

            $this->extractTitle();
            $this->extractLinksViaCrawler();

            $page = new Page($url, $this->title, $this->links);
            $this->pages[] = $page;

            $this->queue = array_unique(array_merge($this->queue, $this->links));
        }

        $this->queue = array_diff($this->queue, $this->visited);

        $this->scrape($currentDepth + 1);
    }


    private function extractTitle(): void
    {
        $this->title = $this->crawlerInstance->filter('title')->innerText();
    }

    private function extractLinksViaCrawler(): void
    {
        $anchors = $this->crawlerInstance->filter('a')->links();
        foreach ($anchors as $anchor) {
            $this->links =[...$this->links, $anchor->getUri()];
        }
    }

    private function getPageContent(): void
    {
        $this->pageContent = $this->crawlerInstance->html();
    }

    public function getPages(): array
    {
        return $this->pages;
    }
}

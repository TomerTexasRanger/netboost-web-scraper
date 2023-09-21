<?php

namespace App\Services\Scraper;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;
use Exception;

class ScraperService
{
    private string $url;
    private int $depth;
    private array $pages = [];
    private array $queue = [];
    private array $visited = [];
    private Client $client;

    /**
     * ScraperService constructor.
     * @param string $url
     * @param int $depth
     * @throws Exception
     */
    public function __construct(string $url, int $depth = 1)
    {
        $this->client = new Client();
        $this->url = $url;
        $this->depth = $depth;
        $this->queue[] = $url;
        $this->scrape(0);
    }

    /**
     * @param int $currentDepth
     * @throws Exception
     */
    private function scrape(int $currentDepth): void
    {
        if ($currentDepth >= $this->depth) {
            return;
        }

        $tempQueue = $this->queue;
        $this->queue = [];

        foreach ($tempQueue as $url) {
            if (in_array($url, $this->visited) || !is_string($url) || empty($url)) {
                continue;
            }

            // Implement a delay to avoid rate-limiting
            sleep(1);

            $this->visited[] = $url;
            try {
                $response = $this->client->request('GET', $url, ['timeout' => 10]);
                $pageContent = $response->getBody()->getContents();
                $crawler = new Crawler($pageContent, $url);
            } catch (GuzzleException $e) {
                Log::error("Failed to scrape URL: $url", ['exception' => $e]);
                continue; // Skip this URL and continue
            }

            $title = $this->extractTitle($crawler);
            $links = $this->extractLinks($crawler);

            $this->pages[] = new Page($url, $title, $links);
            $this->queue = array_merge($this->queue, $links);
        }

        $this->queue = array_diff($this->queue, $this->visited);
        $this->scrape($currentDepth + 1);
    }


    /**
     * @param Crawler $crawler
     * @return string
     */
    private function extractTitle(Crawler $crawler): string
    {
        return $crawler->filter('title')->text();
    }

    /**
     * @param Crawler $crawler
     * @return array
     */
    private function extractLinks(Crawler $crawler): array
    {
        return $crawler->filter('a')->each(function (Crawler $node) {
            $url = $node->link()->getUri();
            if (preg_match('/https?:\/\/[^\s]+/', $url) && (parse_url($url, PHP_URL_SCHEME) == 'http' || parse_url($url, PHP_URL_SCHEME) == 'https')) {
                return $url;
            }
            return null;
        });
    }

    /**
     * @return array
     */
    public function getPages(): array
    {
        return $this->pages;
    }
}

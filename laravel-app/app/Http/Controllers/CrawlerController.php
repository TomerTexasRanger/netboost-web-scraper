<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrawlerRequest;
use App\Models\CrawledUrl;
use GuzzleHttp\Client;

use GuzzleHttp\Exception\GuzzleException;

class CrawlerController extends Controller
{
    /**
     * @throws GuzzleException
     */
    public function crawl(CrawlerRequest $request)
    {
        $client = new Client();
        extract($request->validationData());
        try {
            $existingUrl = CrawledUrl::where('url', $url)->first();

            if ($existingUrl) {
                // URL already exists, you can decide what to do here
                return;
            }

            $response = $client->get($url);

            if ($response->getStatusCode() == 200) {
                $content = $response->getBody()->getContents();

                // Save to MongoDB
                CrawledUrl::create([
                    'url' => $url,
                    'content' => $content
                ]);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function yo(string $name): string
    {
        $namee = 'eae';
        return $name;
    }
}

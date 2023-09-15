<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrawlerRequest;
use App\Models\Link;
use App\Models\Target;
use Exception;
use GuzzleHttp\Client;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerController extends Controller
{
    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function crawl(CrawlerRequest $request): Response
    {
        $session = DB::getMongoClient()->startSession();
        $session->startTransaction();
        $regex = '/https?:\/\/[^\s]+/';

        $client = new Client();
        extract($request->validationData());
        try {
            $existingUrl = Target::where('url', $url)->first();

            if ($existingUrl) {
                // URL already exists, you can decide what to do here
                return response('no', 400);
            }

            $response = $client->get($url);

            if ($response->getStatusCode() == 200) {
                $content = $response->getBody()->getContents();
                $crawler = new Crawler($content, 'http://localhost');
                $title = $crawler->filter('title')->innerText();
                $anchors = $crawler->filter('a')->links();
                $links = [];
                foreach ($anchors as $anchor) {
                    $links[] = $anchor->getUri();
                }
                preg_match_all($regex, $content, $matches);

                $links = $links[] = $matches;

                $target = new Target(['url' => $url, 'name' => $title]);
                $target->save();
                foreach ($links[0] as $link) {
                    $linkModel = new Link(['url' => $link]);
                    $linkModel->save();
                    $target->links()->save($linkModel);
                }
            }
            $session->commitTransaction();
            return response()->make('cset cool');
        } catch (Exception $e) {
            $session->abortTransaction();
            throw new Exception($e->getMessage());
        }
    }

}

<?php

namespace App\Services\Target\Crud;

use App\Events\scraperLinks;
use App\Http\Resources\Target\StoreResource;
use App\Models\Link;
use App\Models\Target;
use App\Services\Scraper\Page;
use App\Services\Scraper\ScraperService;
use App\Services\Target\TargetService;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Broadcast;

class StoreService extends TargetService
{
    private ScraperService $scraperService;
    private array $targets = [];

    /**
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->initSession();
        $this->begin();
        extract($data);
        $this->url = $url;
        $this->scraperService = new ScraperService($url, $depth ?: 1);
        $this->storePages();

    }

    /**
     * @throws Exception
     */
    private function storePages()
    {
        foreach ($this->scraperService->getPages() as $page) {
            $this->storeTargetModel($page);
            $this->storeTargetLinks($page);
            $this->model->load('links');
            $this->targets[] = $this->model;
        }
    }

    /**
     * @throws Exception
     */
    private function storeTargetModel(Page $page): void
    {
        try {
            $this->model = new Target(['url' => $page->url, 'title' => $page->title]);
            $this->model->save();

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

    }

    /**
     * @throws Exception
     */
    private function storeTargetLinks(Page $page): void
    {
        try {
            foreach ($page->links as $link) {
                $linkModel = new Link(['url' => $link]);
                $linkModel->save();
                $this->model->links()->save($linkModel);
            }
        } catch (Exception $exception) {
            $this->rollback();
            throw  new Exception($exception->getMessage());
        }

    }


    public function response(): void
    {
        $this->commit();
        broadcast(new scraperLinks(StoreResource::collection($this->targets)))->toOthers();
//        return response(StoreResource::collection($this->targets));
    }


}

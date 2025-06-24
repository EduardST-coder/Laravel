<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Support\Collection;
use App\Jobs\ProcessVideoJob;
use App\Jobs\GenerateCatalog\GenerateCatalogMainJob;

class DiggingDeeperController extends Controller
{
    public function collections()
    {
        $result = [];

        $eloquentCollection = BlogPost::withTrashed()->get();
        $collection = collect($eloquentCollection->toArray());

        $result['first'] = $collection->first();
        $result['last'] = $collection->last();

        $result['where']['data'] = $collection
            ->where('category_id', 10)
            ->values()
            ->keyBy('id');

        $result['where']['count'] = $result['where']['data']->count();
        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();

        $result['where_first'] = $collection->firstWhere('slug', '!=', '');

        $result['map']['all'] = $collection->map(function ($item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'] ?? null;
            $newItem->item_name = $item['title'] ?? null;
            $newItem->exists = is_null($item['deleted_at'] ?? null);
            return $newItem;
        });

        $result['map']['not_exists'] = $result['map']['all']
            ->where('exists', '=', false)
            ->values()
            ->keyBy('item_id');

        $collectionTransformed = $collection->map(function ($item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'] ?? null;
            $newItem->item_name = $item['title'] ?? null;
            $newItem->exists = is_null($item['deleted_at'] ?? null);
            return $newItem;
        });

        $newItem = new \stdClass();
        $newItem->id = 9999;

        $newItem2 = new \stdClass();
        $newItem2->id = 8888;

        $newItemFirst = $collectionTransformed->prepend($newItem)->first();
        $newItemLast = $collectionTransformed->push($newItem2)->last();
        $pulledItem = $collectionTransformed->pull(1);

        $filtered = collect(); // created_at відсутній

        $sortedSimpleCollection = collect([5, 3, 1, 2, 4])->sort()->values();
        $sortedAscCollection = $collectionTransformed->sortBy('item_name');
        $sortedDescCollection = $collectionTransformed->sortByDesc('item_id');

        dd(compact(
            'result',
            'newItemFirst',
            'newItemLast',
            'pulledItem',
            'filtered',
            'sortedSimpleCollection',
            'sortedAscCollection',
            'sortedDescCollection'
        ));
    }

    public function processVideo()
    {
        ProcessVideoJob::dispatch();
    }

    public function prepareCatalog()
    {
        GenerateCatalogMainJob::dispatch();
    }
}

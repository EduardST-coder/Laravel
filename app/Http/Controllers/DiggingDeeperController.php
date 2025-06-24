<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Carbon\Carbon;

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

        $result['where_first'] = $collection
            ->firstWhere('slug', '!=', '');

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

        $transformed = $collection->map(function ($item) {
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

        $newItemFirst = $transformed->prepend($newItem)->first();
        $newItemLast = $transformed->push($newItem2)->last();
        $pulledItem = $transformed->pull(1);

        $filtered = collect(); // created_at видалено, тому фільтр умовний

        $sortedSimpleCollection = collect([5, 3, 1, 2, 4])->sort()->values();
        $sortedAscCollection = $transformed->sortBy('item_name');
        $sortedDescCollection = $transformed->sortByDesc('item_id');

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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class IndexController extends Controller
{
    /**
     * @return mixed
     */
    private function getFeed()
    {
        return \Feeds::make('http://pox.globo.com/rss/g1/economia');
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function index(Request $request)
    {
        $page =  $request->get('page') ?: 1;
        if(!is_numeric($page)){
            throw new InvalidParameterException("O número da página precisa ser um inteiro");
        }

        $feed = $this->getFeed();
        $data = [];

        foreach ($feed->get_items() as $item) {
            $data[] = $item->data;
        }

        $perPage = 10;
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $itemCollection = collect($data);
        $paginatedItems = new LengthAwarePaginator($itemCollection->forPage($page, $perPage), $itemCollection->count(), $perPage, $page);
        $paginatedItems->setPath('news');

        return $paginatedItems;
    }

    /**
     * @param $id
     * @return array
     */
    public function view($id)
    {
        $data = [];
        $feed = $this->getFeed();

        foreach ($feed->get_items() as $item) {
            if(md5($item->get_permaLink()) == $id) {
                $data = $item->data['child'][''];
                break;
            }
        }

        return $data;
    }
}

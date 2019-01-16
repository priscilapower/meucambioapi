<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class IndexController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $page =  $request->get('page') ?: 1;
        if(!is_numeric($page)){
            throw new InvalidParameterException("O número da página precisa ser um inteiro");
        }

        $news = News::paginate(10);
        $news->setPath('api/news');

        return $news;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function view($id)
    {
        return News::find($id);
    }

    /**
     * @return JsonResponse
     */
    public function load()
    {
        $feed = \Feeds::make('http://pox.globo.com/rss/g1/economia');
        $data = [];

        try{
            foreach ($feed->get_items() as $item) {
                $link = $item->get_permaLink();
                $new = News::where("content", "LIKE", "%{$link}%")->get();
                if(empty($new->count())) {
                    $data['content'] = json_encode($item->data);
                    News::create($data);
                }
            }
            $result = new JsonResponse("Not&iacute;cias carregadas com sucesso.");
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            $result = new JsonResponse("Ocorreu um erro ao carregar as not&iacute;cias.");
        }

        return $result;
    }
}

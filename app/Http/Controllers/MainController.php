<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\controllers\contracts\CategoryInterface;
use App\http\controllers\contracts\SeoInterface;

class MainController extends Controller
{

    private $category;
    private $seo;

    public function __construct(
        CategoryInterface $category,
        SeoInterface $seo
        )
    {
        $this->category = $category;
        $this->seo = $seo;
    }

    public function show()
    {

        $data = [];
        
        $categorys = $this->category->getCategory(['category.show' => 1]);

        $home = $this->seo->getSeo(['seo.type_page' => 'home']);
        if(count($home)){
            $data['title'] = $home[0]['data'];
            $data['description'] = $home[1]['data'];
        }

        $data = array_merge($data, [
            'categorys' => $categorys
        ]);

        return view('main', $data);
    }
}

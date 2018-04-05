<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\controllers\contracts\SeoInterface;
use Session;

class SettingController extends Controller
{
    private $seo;

    public function __construct(
        SeoInterface $seo
        )
    {
        $this->seo = $seo;
    }


    public function home()
    {
        $data = [];

        $home = $this->seo->getSeo(['seo.type_page' => 'home']);
        if(count($home)){
            $data['title'] = $home[0]['data'];
            $data['description'] = $home[1]['data'];
        }

        if(Session::has('error')) $data['error'] = Session::get('error');
        if(Session::has('success')) $data['success'] = Session::get('success');

        return view('setting.home', $data);
    }

    public function save(Request $request)
    {
        unset($request['_token']);

        $home = $this->seo->getSeo(['seo.type_page' => 'home']);
        try {
            
            if(count($home)){
                $this->seo->updateSeo(['seo.id' => $home[0]['id']],['seo.data' => $request['title']]);
                $this->seo->updateSeo(['seo.id' => $home[1]['id']],['seo.data' => $request['description']]);
            } else{
                $this->seo->addSeo(['seo.data' => $request['title'], 'seo.type_page' => 'home']);
                $this->seo->addSeo(['seo.data' => $request['description'], 'seo.type_page' => 'home']);
            }

            return redirect()->back()->with('success', 'Сохранено');
        } catch (\Exception $e) {}

        return redirect()->back()->with('error', 'Что-то пошло не так');
    }
}

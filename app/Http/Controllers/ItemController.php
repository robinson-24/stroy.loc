<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;
use Validator;
use Session;
use Route;
use App\Libraries\GeneralFunctions;

use App\Http\Controllers\Contracts\CategoryInterface;
use App\Http\Controllers\Contracts\ImageInterface;
use App\Http\Controllers\Contracts\SeoInterface;
use App\Http\Controllers\Contracts\ItemsInterface;

class ItemController extends Controller
{

    private $category;
    private $image;
    private $seo;
    private $items;

    public function __construct(
        CategoryInterface $category,
        ImageInterface $image,
        SeoInterface $seo,
        ItemsInterface $items
    ){
         
        $this->category = $category;
        $this->image = $image;
        $this->seo = $seo;
        $this->items = $items;
    }

    public function show()
    {
        $data = [];
        $items = $this->items->getItems();
        
        $data = array_merge($data, [
            'items' => $items
        ]);

        return view('item.show', $data);
    }

    public function create()
    {
        $data = [];

        $category = $this->category->getCategory();

        if(Session::has('error')) $data['error'] = Session::get('error');
        if(Session::has('success')) $data['success'] = Session::get('success');
        
        $data = array_merge($data, [
            'category' => $category
        ]);

        return view('item.create', $data);
    }

    public function postCreate(Request $request)
    {
        $request = $request::all();

        unset($request['_token']);

        $validator = Validator::make(
            array(
                'name'            => trim($request['name']),
                'characteristics' => trim($request['characteristics']),
                'title'           => trim($request['title']),
                'description'     => trim($request['description']),
                'price'           => trim($request['price']),
                'alt'             => trim($request['alt'])
            ),array(
                'name'            => 'required',
                'characteristics' => 'required',
                'title'           => 'required',
                'description'     => 'required',
                'price'           => 'required',
                'alt'             => 'required'
            ), array(
                'name.required'            => 'Название товара должно быть заполено.',
                'characteristics.required' => 'Краткое описание товара должно быть заполено.',
                'title.required'           => 'Поле "title" должно быть заполено.',
                'description.required'     => 'Поле "description" должно быть заполено.',
                'price.required'           => 'Поле цена должно быть заполено.',
                'alt.required'             => 'Поле "alt" должно быть заполено.'
            )
        );
        if($validator->fails()){ //ошибка в валидации
            $error = '';
            foreach ($validator->messages()->getMessages() as $key => $value) {
                $error = $error.$value[0].'<br>';
            }

            return redirect()->back()->with('error', $error);
        } else{ //все хоршо с валидацией, записываем в базу

            if(isset($request['show'])){
                $request['show'] = 1;
            } else {
                $request['show'] = 0;
            }

            if(isset($request['existence'])){
                $request['existence'] = 1;
            } else {
                $request['existence'] = 0;
            }

            $request['slug'] = GeneralFunctions::getSlug($request['name']);

            try {
                if($_FILES['image']['name'] != ''){
                    $uploaddir = public_path('images/items/');
                    $name = md5(microtime()).".".substr($_FILES['image']['type'], strlen("image/"));
                    $uploadfile = $uploaddir.$name;
                    $request['image'] = $name;
                    move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
                }
                
                $dataImage    = [];
                $dataSeo      = [];
                $dataItems = [];

                $dataImage = [
                    'image.name' => $name,
                    'image.alt'  => $request['alt']
                ];
                $image = $this->image->addImage($dataImage);

                $dataSeo = [
                    'seo.data'      => $request['title'],
                    'seo.type_page' => 'item'
                ];
                $title = $this->seo->addSeo($dataSeo);

                $dataSeo = [
                    'seo.data'      => $request['description'],
                    'seo.type_page' => 'item'
                ];
                $description = $this->seo->addSeo($dataSeo);

                $dataItems = [
                    'items.slug'            => $request['slug'],
                    'items.show'            => $request['show'],
                    'items.category'        => $request['category'],
                    'items.existence'       => $request['existence'],
                    'items.name'            => $request['name'],
                    'items.characteristics' => $request['characteristics'],
                    'items.price'           => intval($request['price']),
                    'items.image'           => $image->id,
                    'items.title'           => $title->id,
                    'items.description'     => $description->id
                ];

                $this->items->addItems($dataItems);

            } catch (\Exception $e) {}

            return redirect()->back()->with('success', 'Успешно добавлено товар');
        }
    }

    public function edit()
    {
        $id = Route::input('id');

        $items = $this->items->getItems(['items.id' => $id]);

        $category = $this->category->getCategory();

        $data = [];

        if(Session::has('error')) $data['error'] = Session::get('error');
        if(Session::has('success')) $data['success'] = Session::get('success');

        $data = array_merge($data, [
            'items'    => $items,
            'category' => $category
        ]);

        return view('item.edit', $data);
    }

    public function deletePhoto()
    {
        $id = $_POST['id'];

        $items = $this->items->getItems(['items.id' => $id]);
        $filename = public_path('/images/items/'.$items[0]['image_name']);

        if(file_exists($filename)){
            try {
                unlink($filename);
                $this->image->deleteImage(['image.id' => $items[0]['image_id']]);
                $this->items->updateItems(
                    [
                        'items.id' => $id
                    ],[
                        'items.image' => null
                    ]
                );

                return 'true';
            } catch (\Exception $e) {}
        }

        return 'false';
    }

    public function save(Request $request)
    {
        $id = Route::input('id');

        $items = $this->items->getItems(['items.id' => $id]);

        $request = $request::all();

        unset($request['_token']);

        $validator = Validator::make(
            array(
                'name'            => trim($request['name']),
                'characteristics' => trim($request['characteristics']),
                'title'           => trim($request['title']),
                'description'     => trim($request['description']),
                'price'           => trim($request['price']),
                'alt'             => trim($request['alt'])
            ),array(
                'name'            => 'required',
                'characteristics' => 'required',
                'title'           => 'required',
                'description'     => 'required',
                'price'           => 'required',
                'alt'             => 'required'
            ), array(
                'name.required'            => 'Название товара должно быть заполено.',
                'characteristics.required' => 'Краткое описание товара должно быть заполено.',
                'title.required'           => 'Поле "title" должно быть заполено.',
                'description.required'     => 'Поле "description" должно быть заполено.',
                'price.required'           => 'Поле цена должно быть заполено.',
                'alt.required'             => 'Поле "alt" должно быть заполено.'
            )
        );
        if($validator->fails()){ //ошибка в валидации
            $error = '';
            foreach ($validator->messages()->getMessages() as $key => $value) {
                $error = $error.$value[0].'<br>';
            }

            return redirect()->back()->with('error', $error);
        } else{ //все хоршо с валидацией, записываем в базу

            $data = [];

            if(isset($request['show'])){
                $request['show'] = 1;
            } else {
                $request['show'] = 0;
            }

            if(isset($request['existence'])){
                $request['existence'] = 1;
            } else {
                $request['existence'] = 0;
            }

            $request['slug'] = GeneralFunctions::getSlug($request['name']);

            try {
                if(count($_FILES)){
                    $uploaddir = public_path('images/items/');
                    $name = md5(microtime()).".".substr($_FILES['image']['type'], strlen("image/"));
                    $uploadfile = $uploaddir.$name;
                    move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);

                    $dataImage = [
                        'image.name' => $name,
                        'image.alt' => $request['alt']
                    ];
                    $data['image'] = $this->image->addImage($dataImage)->id;
                }

                if($request['title'] != $items[0]->title){
                    $this->seo->updateSeo(
                    [
                        'seo.id' => $items[0]->title_id
                    ],[
                        'seo.data' => $request['title']
                    ]);
                }

                if($request['description'] != $items[0]->description){
                    $this->seo->updateSeo(
                    [
                        'seo.id' => $items[0]->description_id
                    ],[
                        'seo.data' => $request['description']
                    ]);
                }

                if($request['alt'] != $items[0]->image_alt){
                    $this->image->updateImage(
                    [
                        'image.id' => $items[0]->image_id
                    ],[
                        'image.alt' => $request['alt']
                    ]);
                }

                $data = array_merge($data, array(
                    'items.name'            => $request['name'],
                    'items.characteristics' => $request['characteristics'],
                    'items.show'            => $request['show'],
                    'items.existence'       => $request['existence'],
                    'items.price'           => $request['price'],
                    'items.category'        => intval($request['category'])
                ));

                $this->items->updateItems(['items.id' => $items[0]->id], $data);

                return redirect()->back()->with('success', 'Успешно обновлено товар');
            
            } catch (\Exception $e) {}

            return redirect()->back()->with('error', 'Что-то пошло не так');
        }
    }

    public function delete()
    {
        $id = Route::input('id');

        $item = $this->items->getItems(['items.id' => $id]);
        try {
            $this->seo->deleteSeo(['seo.id' => $item[0]['title_id']]);
            $this->seo->deleteSeo(['seo.id' => $item[0]['description_id']]);

            if($item[0]['image_name'] != null){
                $filename = public_path('images/items/').$item[0]['image_name'];
                if(file_exists($filename)){
                    unlink($filename);
                    $this->image->deleteImage(['image.id' => $item[0]['image_id']]);
                }
            }

            $this->items->deleteItems(['items.id' => $id]);

            return redirect('/items');
        } catch (\Exception $e) {
            
        }
    }

}

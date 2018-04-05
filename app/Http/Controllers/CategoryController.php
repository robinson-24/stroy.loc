<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;
use Validator;
use Session;
use App\Libraries\GeneralFunctions;
use Route;

use App\Http\Controllers\Contracts\CategoryInterface;
use App\Http\Controllers\Contracts\ImageInterface;
use App\Http\Controllers\Contracts\SeoInterface;
use App\Http\Controllers\Contracts\ItemsInterface;


class CategoryController extends Controller
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

        $categorys = $this->category->getCategory();

        $data = [
            'categorys' => $categorys
        ];

        return view('category.show', $data);
    }

    public function create()
    {
        $data = [];
        if(Session::has('error')) $data['error'] = Session::get('error');
        if(Session::has('success')) $data['success'] = Session::get('success');
        
        return view('category.create', $data);
    }

    public function postCreate(Request $request)
    {
        $request = $request::all();

        unset($request['_token']);

        $validator = Validator::make(
            array(
                'name'              => trim($request['name']),
                'intro_description' => trim($request['intro_description']),
                'full_description'  => trim($request['full_description']),
                'title'             => trim($request['title']),
                'description'       => trim($request['description']),
                'alt'               => trim($request['alt'])
            ),array(
                'name'              => 'required',
                'intro_description' => 'required',
                'title'             => 'required',
                'description'       => 'required',
                'alt'               => 'required'
            ), array(
                'name.required'              => 'Название категории должно быть заполено.',
                'intro_description.required' => 'Краткое описание категории должно быть заполено.',
                'title.required'             => 'Поле "title" должно быть заполено.',
                'description.required'       => 'Поле "description" должно быть заполено.',
                'alt.required'               => 'Поле "alt" должно быть заполено.'
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

            $request['slug'] = GeneralFunctions::getSlug($request['name']);

            try {
                if($_FILES['image']['name'] != ''){
                    $uploaddir = public_path('images/categorys/');
                    $name = md5(microtime()).".".substr($_FILES['image']['type'], strlen("image/"));
                    $uploadfile = $uploaddir.$name;
                    $request['image'] = $name;
                    move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
                }

                $dataImage    = [];
                $dataSeo      = [];
                $dataCategory = [];

                $dataImage = [
                    'image.name' => $name,
                    'image.alt' => $request['alt']
                ];
                $image = $this->image->addImage($dataImage);

                $dataSeo = [
                    'seo.data' => $request['title'],
                    'seo.type_page' => 'category'
                ];
                $title = $this->seo->addSeo($dataSeo);

                $dataSeo = [
                    'seo.data' => $request['description'],
                    'seo.type_page' => 'category'
                ];
                $description = $this->seo->addSeo($dataSeo);

                $dataCategory = [
                    'category.slug'              => $request['slug'],
                    'category.show'              => $request['show'],
                    'category.name'              => $request['name'],
                    'category.intro_description' => $request['intro_description'],
                    'category.full_description'  => $request['full_description'],
                    'category.image'             => $image->id,
                    'category.title'             => $title->id,
                    'category.description'       => $description->id
                ];

                $this->category->addCategory($dataCategory);

            } catch (\Exception $e) {}

            return redirect()->back()->with('success', 'Успешно добавлено категорию');
        }
    }

    public function edit()
    {
        $id = Route::input('id');

        $where = ['category.id' => $id];
        $category = $this->category->getCategory($where);

        $data = [];

        if(Session::has('error')) $data['error'] = Session::get('error');
        if(Session::has('success')) $data['success'] = Session::get('success');
        $data = array_merge($data, [
            'category' => $category
        ]);

        return view('category.edit', $data);
    }

    public function save(Request $request)
    {
        $id = Route::input('id');

        $category = $this->category->getCategory(['category.id' => $id]);

        $request = $request::all();

        unset($request['_token']);

        $validator = Validator::make(
            array(
                'name'              => trim($request['name']),
                'intro_description' => trim($request['intro_description']),
                'full_description'  => trim($request['full_description']),
                'title'             => trim($request['title']),
                'description'       => trim($request['description']),
                'alt'               => trim($request['alt'])
            ),array(
                'name'              => 'required',
                'intro_description' => 'required',
                'title'             => 'required',
                'description'       => 'required',
                'alt'               => 'required'
            ), array(
                'name.required'              => 'Название категории должно быть заполено.',
                'intro_description.required' => 'Краткое описание категории должно быть заполено.',
                'title.required'             => 'Поле "title" должно быть заполено.',
                'description.required'       => 'Поле "description" должно быть заполено.',
                'alt.required'               => 'Поле "alt" должно быть заполено.'
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

            $request['slug'] = GeneralFunctions::getSlug($request['name']);

            $name = '';

            try {
                if(count($_FILES)){
                    $uploaddir = public_path('images/categorys/');
                    $name = md5(microtime()).".".substr($_FILES['image']['type'], strlen("image/"));
                    $uploadfile = $uploaddir.$name;
                    move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);

                    $dataImage = [
                        'image.name' => $name,
                        'image.alt' => $request['alt']
                    ];
                    $data['image'] = $this->image->addImage($dataImage)->id;
                }

                if($request['title'] != $category[0]->title){
                    $this->seo->updateSeo(
                    [
                        'seo.id' => $category[0]->title_id
                    ],[
                        'seo.data' => $request['title']
                    ]);
                }

                if($request['description'] != $category[0]->description){
                    $this->seo->updateSeo(
                    [
                        'seo.id' => $category[0]->description_id
                    ],[
                        'seo.data' => $request['description']
                    ]);
                }

                if($request['alt'] != $category[0]->image_alt){
                    $this->image->updateImage(
                    [
                        'image.id' => $category[0]->image_id
                    ],[
                        'image.alt' => $request['alt']
                    ]);
                }

                $data = array_merge($data, array(
                    'category.name' => $request['name'],
                    'category.intro_description' => $request['intro_description'],
                    'category.full_description' => $request['full_description'],
                    'category.show' => $request['show']
                ));

                $this->category->updateCategory(['category.id' => $category[0]->id], $data);

                //Category::where('id', $id)->update($request);

            } catch (\Exception $e) {}

            return redirect()->back()->with('success', 'Успешно обновлено категорию');
        }
    }

    public function deletePhoto()
    {
        $id = $_POST['id'];

        $category = $this->category->getCategory(['category.id' => $id]);
        $filename = public_path('/images/categorys/'.$category[0]['image_name']);

        if(file_exists($filename)){
            try {
                unlink($filename);
                $this->image->deleteImage(['image.id' => $category[0]['id']]);
                $this->category->updateCategory(
                    [
                        'category.id' => $id
                    ],[
                        'category.image' => null
                    ]
                );
                //Category::where('id', $id)->update(['image' => null]);
                return 'true';
            } catch (\Exception $e) {}
        }

        return 'false';
    }

    public function delete()
    {
        $id = Route::input('id');

        $category = $this->category->getCategory(['category.id' => $id]);
        $items = $this->items->getItems(['items.category' => $category[0]['id']]);
        try {
            if(count($items)){

                for ($i = 0; $i < count($items); $i++) { 
                    $this->seo->deleteSeo(['seo.id' => $items[$i]['title_id']]);
                    $this->seo->deleteSeo(['seo.id' => $items[$i]['description_id']]);

                    if($items[$i]['image'] != null){
                        $filename = public_path('images/items/').$items[$i]['image_name'];
                        unlink($filename);
                        $this->image->deleteImage(['image.id' => $items[$i]['image_id']]);
                    }

                    $this->items->deleteItems(['items.id' => $items[$i]['id']]);
                }
            }
            
            if($category[0]['image'] != null){
                unlink(public_path('/images/categorys/').$category[0]['image_name']);
            }
            $this->seo->deleteSeo(['seo.id' => $category[0]['title_id']]);
            $this->seo->deleteSeo(['seo.id' => $category[0]['description_id']]);

            $this->category->deleteCategory(['category.id' => $id]);

            return redirect('/category');
        } catch (\Exception $e) {
        }

        return redirect()->back()->with('error', 'Что-то пошло не так');
    }

    public function get()
    {
        $slug = Route::input('slug');

        $categorys = $this->category->getCategory(['category.show' => 1]);
        $category = $this->category->getCategory(['category.slug' => $slug]);
        if(count($category)){
            $whereItems = [
                'items.show'     => 1,
                'items.category' => $category[0]['id']
            ];
            $items = $this->items->getItems($whereItems);

            $data = [];
            $data = [
                'items'    => $items,
                'categorys' => $categorys,
                'category' => $category[0],
                'title' => $category[0]['title'],
                'description' => $category[0]['description']
            ];

            return view('category', $data);
        }

        return redirect('/');
    }

}

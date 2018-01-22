<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 18.01.18
 * Time: 17:12
 */

namespace MVS\MyEduProject\Application\Controllers;
use MVS\MyEduProject\Core\Controller;
use MVS\MyEduProject\Application\Models\Category;

class CatalogController extends Controller
{
    public $defaultAction = 'category';
    public $path = 'image/items/';


    public function actionCategory()
    {
        $model = new Category;
        $params['message'] = 'Показать подкатегории.';
        $categories = $model->findCategories();
        $params['categories'] = $categories;


        $this->Render($this->template,$params);
    }

    public function actionItems($id){

        $model = new Items();

        return $this->render('items',
            [
                'items'=> $model->findItems($id),
            ]
        );

    }

    public function actionItem($id){
        $model = new Items();
        $model -> findItem($id);
        $model->findPath($this->path);
        $model->viewImage();
//        var_dump($model->viewImage()); die;
        return $this->render('item',
            ['item'=>$model->item ,
                'images'=>$model->images,
                'path' => $model->path
            ]
        );
    }

    public function actionExternalorder($id){
        $model= new Category();
        $category_without_items = $model->findCategory_without_items($id);
        return $this->render('externalorder',
            [
                'category_without_items'=>$category_without_items,
            ]

        );
    }


}
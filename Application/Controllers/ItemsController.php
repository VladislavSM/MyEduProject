<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 25.12.17
 * Time: 17:14
 */
namespace MVS\MyEduProject\Application\Controllers;

use MVS\MyEduProject\Core\Controller;
use MVS\MyEduProject\Application\Models\Items;

class ItemsController extends Controller
{
    public $defaultAction = 'items';
    public $path = 'image/items/';


    public function actionItems() {
        $model = new Items();
        $params['items'] = $model->findItems();
        if (!empty($_POST)){
            $params['value'] = $_POST['sell'];
        }else{
            $params['value'] = 'id';
        }
        $this->Render($this->template,$params);
    }

    public function actionItem() {

        $model = new Items();
        $params['path'] = $model->findPath($this->path);
        $params['images'] = $model->viewImage();
        $params['item'] = $model->findItem();
        $params['comments'] = $model->findComments();
        $params['bought'] = $model->didTheUserBuyThisProduct();
//        var_dump($params['comments']);die;

        $this->Render($this->template,$params);

    }
    public function actionAddcomment(){
        $model = new Items();
        $model->addComment();
            $result = 'Ваш отзыв добавлен. Если Ваш отзыв не соответствует предъявляемым требованиям
                       он будет удален ! С Уважением администрация My Edu Project !';

//        $this->Render($this->template,$params);

    }

    public function actionSearch(){
        $model = new Items();
        $params['items'] = $model->search();
        $params['offer'] = $model->offerOfGoods();
        $this->Render($this->template,$params);
    }
}
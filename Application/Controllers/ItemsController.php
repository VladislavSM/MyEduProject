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

        $this->Render($this->template,$params);
    }

    public function actionItem() {

        $model = new Items();
        $params['path'] = $model->findPath($this->path);
        $params['images'] = $model->viewImage();
        $params['item'] = $model->findItem();

        $this->Render($this->template,$params);

    }
}
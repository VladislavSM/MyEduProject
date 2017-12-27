<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 25.12.17
 * Time: 17:14
 */

require_once '../application/models/Items.php';


class ItemsController extends Controller
{
    public $defaultAction = 'items';

    public function actionItems() {

        $model = new Items();
        $params['items'] = $model->findItems();

        $this->Render($this->template,$params);

    }

    public function actionItem() {

        $model = new Items();
        $params['item'] = $model->findItem();

        $this->Render($this->template,$params);

    }
}
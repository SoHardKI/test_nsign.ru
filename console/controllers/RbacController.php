<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->assign($admin, 1);
        $seller = $auth->createRole('seller');
        $auth->add($seller);
    }
}
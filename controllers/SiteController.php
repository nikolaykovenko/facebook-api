<?php

namespace app\controllers;

use app\models\User;
use app\models\UserPost;
use app\ncms\oauth\Factory;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Главный контроллер
 * @package app\controllers
 */
class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Список пользователей
     * @return string
     */
    public function actionIndex()
    {
        $items = User::find()->all();
        
        $this->view->title = 'Список користувачів';
        return $this->render('users-list', ['itemsList' => $items]);
    }


    /**
     * Страница пользователя
     * @param int $user
     * @return string
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     */
    public function actionUserPage($user)
    {
        /** @var User $item */
        $item = User::findOne($user);
        if (empty($item)) {
            throw new NotFoundHttpException('User not found');
        }
        
        try {
            $oAuth = Factory::getObject($item->apiController);
            $posts = $oAuth->getLastPosts($item->token);
            UserPost::updateUserPosts($item->id, $posts);
        } catch (\Exception $e) {
            
        }
        
        $this->view->title = 'Сторінка користувача ' .$item->name;
        return $this->render('user-page', ['item' => $item]);
    }
}

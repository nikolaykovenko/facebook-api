<?php
/**
 * @package ncms
 * @author Nikolay Kovenko <nikolay.kovenko@gmail.com>
 * @date 07.03.15
 */

namespace app\controllers;

use app\models\User;
use app\ncms\oauth\Factory;
use yii\base\Exception;
use yii\web\Controller;

/**
 * Контроллер авторизаци
 * @package app\controllers
 */
class LoginController extends Controller
{
    /**
     * Страница для неавторизированных польователей
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('login');
    }

    /**
     * Редирект на страницу oath авторизации
     * @param string $system
     * @return \yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionLogin($system)
    {
        $oauth = Factory::getObject($system);
        return $this->redirect($oauth->loginRedirectUrl());
    }

    /**
     * Авторизация в системе после возвращаения пользователя
     * @param string $system
     * @return \yii\web\Response
     * @throws Exception
     */
    public function actionAuth($system)
    {
        try {
            $oAuth = Factory::getObject($system);
            $response = $oAuth->response();
        } catch (\Exception $e) {
            return $this->render('/site/text', ['text' => 'Авторизація провалилася']);
        }
        
        
        $user = User::findByApiUserId($response['apiUserId'], $response['apiController']);
        if (empty($user)) {
            $user = new User();
            $user->apiId = $response['apiUserId'];
            $user->apiController = $response['apiController'];
        }
        
        $user->token = $response['token'];
        $userInfo = $oAuth->getUserInfo($user->token);
        
        $user->load(['User' => $userInfo]);
        $user->save();
        
        if (empty($user->id)) {
            throw new Exception('unknown error');
        }

        if (\Yii::$app->user->login($user)) {
            return $this->redirect(['site/user-page', 'user' => $user->id]);
        }
        
        return $this->redirect(['/login']);
    }

    /**
     * Logout
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }
}

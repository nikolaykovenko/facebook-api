<?php
/**
 * @package NCMS
 * @author Nikolay Kovenko <nikolay.kovenko@gmail.com>
 * @date 07.03.15
 */

namespace app\ncms\oauth;

use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookSession;
use yii\helpers\Url;

/**
 * Авторизация через facebook
 * @package app\ncms\oauth
 */
class Facebook extends AOath
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
//        TODO: Упрощено. Можно оптимизировать, убрав привязку параметров к конфигу.
        FacebookSession::setDefaultApplication(
            \Yii::$app->params['facebookAppId'],
            \Yii::$app->params['facebookSecret']
        );
    }

    /**
     * @inheritdoc
     */
    public function loginRedirectUrl()
    {
        $helper = new FacebookRedirectLoginHelper($this->redirectUrl());
        return $helper->getLoginUrl(['email', 'read_stream']);
    }

    /**
     * @inheritdoc
     */
    public function response()
    {
        $helper = new FacebookRedirectLoginHelper($this->redirectUrl());
        $session = $helper->getSessionFromRedirect();
        if (empty($session)) {
            throw new \Exception('Auth failed');
        }
        
        return [
            'token' => $session->getToken(),
            'apiUserId' => $session->getAccessToken()->getInfo()->getId(),
            'apiController' => $this->apiID(),
        ];
    }

    /**
     * Возвращает информацию о пользователе по токену
     * @param string $token
     * @return array
     * @throws \Exception в случае ошибки
     */
    public function getUserInfo($token)
    {
        $session = new FacebookSession($token);
        
        $info =
            (new FacebookRequest($session, 'GET', '/me'))
            ->execute()
            ->getGraphObject();
        
        $picture =
            (new FacebookRequest($session, 'GET', '/me?fields=picture.height(300).width(300)'))
                ->execute()
                ->getGraphObject()
                ->getProperty('picture');
        
        
        return [
            'name' => $info->getProperty('name'),
            'email' => $info->getProperty('email'),
            'imageUrl' => !empty($picture) ? $picture->getProperty('url') : null,
        ];
    }

    /**
     * Возвращает последниии записи пользователя
     * @param string $token
     * @param int $postsNumber
     * @return array
     * @throws \Exception в случае ошибки
     */
    public function getLastPosts($token, $postsNumber = 5)
    {
        $result = [];
        $session = new FacebookSession($token);

        $posts =
            (new FacebookRequest($session, 'GET', '/me?fields=posts.limit(5)'))
                ->execute()
                ->getGraphObject()
                ->getProperty('posts');
        
        if (is_null($posts)) {
            return $result;
        }
        $posts = $posts->getProperty('data')->asArray();
        
        foreach ($posts as $post) {
            $result[] = [
                'postId' => $post->id,
                'imageUrl' => isset($post->picture) ? $post->picture : null,
                'text' => isset($post->description) ? $post->description : $post->message,
                'url' => $post->link,
                'date' => $post->created_time,
            ];
        }
        
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function apiID()
    {
        return 'facebook';
    }

    /**
     * Возвращает redirect Url
     * @return string
     */
    private function redirectUrl()
    {
        return Url::to(['/login/auth', 'system' => 'facebook'], true);
    }
}

<?php
/**
 * @package NCMS
 * @author Nikolay Kovenko <nikolay.kovenko@gmail.com>
 * @date 08.03.15
 */

namespace app\controllers;

use app\models\UserPostLike;
use app\ncms\core\Controller;
use yii\filters\AccessControl;

/**
 * Контроллер работы с постаами
 * @package app\controllers
 */
class PostController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function () {
                    echo $this->renderAjax('/site/json-result', ['status' => 'error', 'message' => 'Вам необхідно авторизуватися']);
                    return false;
                },
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    /**
     * Добавляет новый лайк
     * @param int $post
     * @param int $likeType
     * @return string
     */
    public function actionAddLike($post, $likeType)
    {
        $like = new UserPostLike();
        $like->user = \Yii::$app->user->identity->id;
        $like->post = $post;
        $like->likeType = $likeType;
        
        if ($like->save()) {
            $this
                ->setVariable('status', 'ok')
                ->setVariable('message', 'Ви успішно вплинули на карму поста!');
        } else {
            $this->modelsValidationErrorsToAjax($like);
        }
        
        
        return $this->renderAjax('/site/json-result');
    }
}

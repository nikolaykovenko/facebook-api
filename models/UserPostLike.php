<?php

namespace app\models;

use Yii;

/**
 * Модель лайков
 *
 * @property integer $id
 * @property integer $post
 * @property integer $user
 * @property string $likeType
 * @property string $addTime
 *
 * @property User $user0
 * @property UserPost $post0
 */
class UserPostLike extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_post_like';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post', 'user'], 'required'],
            [['post', 'user'], 'integer'],
            [['likeType'], 'in', 'range' => [-1, 1]],
            [['post', 'user'], 'unique', 'targetAttribute' => ['post', 'user'], 'message' => 'Вы вже вплинули на карму цього поста']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post' => 'Post',
            'user' => 'User',
            'likeType' => 'Like Type',
            'addTime' => 'Add Time',
        ];
    }

    /**
     * Возвращает пользователя
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }

    /**
     * Возвращает пост
     * @return \yii\db\ActiveQuery
     */
    public function getPost0()
    {
        return $this->hasOne(UserPost::className(), ['id' => 'post']);
    }
}

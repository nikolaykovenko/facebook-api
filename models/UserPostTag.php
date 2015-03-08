<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_post_tag".
 *
 * @property integer $id
 * @property integer $post
 * @property string $tag
 *
 * @property UserPost $post0
 */
class UserPostTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_post_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post', 'tag'], 'required'],
            [['post'], 'integer'],
            [['tag'], 'string', 'max' => 255],
            [['post', 'tag'], 'unique', 'targetAttribute' => ['post', 'tag'], 'message' => 'У цього поста вже є даний тег']
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
            'tag' => 'Tag',
        ];
    }

    /**
     * Возвращает запись поста
     * @return \yii\db\ActiveQuery
     */
    public function getPost0()
    {
        return $this->hasOne(UserPost::className(), ['id' => 'post']);
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return parent::find()->orderBy('id desc');
    }
}

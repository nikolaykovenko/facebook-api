<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * Модель пользователей
 *
 * @property integer $id
 * @property string $apiId
 * @property string $apiController
 * @property string $name
 * @property string $email
 * @property string $imageUrl
 * @property string $token
 * @property string $registerTime
 * @property UserPost[] $posts
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    /**
     * Возвращает учетную запись по внутреннему id пользователя внури внешней системы
     * @param $apiUserId
     * @param $apiController
     * @return null|User
     */
    public static function findByApiUserId($apiUserId, $apiController)
    {
        return static::findOne(['apiId' => $apiUserId, 'apiController' => $apiController]);
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apiId', 'apiController', 'token'], 'required'],
            [['imageUrl', 'token'], 'string'],
            [['registerTime'], 'safe'],
            [['apiId', 'apiController', 'name', 'email'], 'string', 'max' => 255],
            [['apiId'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'apiId' => 'Api ID',
            'apiController' => 'Api Controller',
            'name' => 'Name',
            'email' => 'Email',
            'imageUrl' => 'Image Url',
            'token' => 'Token',
            'registerTime' => 'Register Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(UserPost::className(), ['userId' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return false;
    }
}

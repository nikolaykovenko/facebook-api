<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_post".
 *
 * @property integer $id
 * @property string $apiPostId
 * @property integer $userId
 * @property string $imageUrl
 * @property string $text
 * @property string $date
 * @property string $url
 *
 * @property User $user
 * @property UserPostLike[] $postLikes
 * @property integer $postPositiveLikesCount
 * @property integer $postNegativeLikesCount
 * @property UserPostTag[] $postTags
 */
class UserPost extends \yii\db\ActiveRecord
{

    /**
     * Обновляет посты пользователя
     * @param int $userId
     * @param array $posts
     * @return bool
     */
    public static function updateUserPosts($userId, array $posts)
    {
        $result = true;

        foreach ($posts as $post) {
            $postItem = static::findOne(['apiPostId' => $post['postId']]);
            if (empty($postItem)) {
                $postItem = new static();
                $postItem->userId = $userId;
                $postItem->apiPostId = $post['postId'];
            }

            $postItem->load(['UserPost' => $post]);
            $result = $postItem->save() and $result;
        }

        return $result;
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apiPostId', 'userId', 'text'], 'required'],
            [['userId'], 'integer'],
            [['imageUrl', 'text', 'url'], 'string'],
            [['date'], 'safe'],
            [['apiPostId'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'apiPostId' => 'Api Post ID',
            'userId' => 'User ID',
            'imageUrl' => 'Image Url',
            'text' => 'Text',
            'date' => 'Date',
            'url' => 'Url',
        ];
    }

    /**
     * Возвращает запись автора поста
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    /**
     * Возвращает список всех лайков и дизлайков поста
     * @return \yii\db\ActiveQuery
     */
    public function getPostLikes()
    {
        return $this->hasMany(UserPostLike::className(), ['post' => 'id']);
    }

    /**
     * Возвращает количество лайков поста 
     * @return int
     */
    public function getPostPositiveLikesCount()
    {
        return $this->hasOne(UserPostLike::className(), ['post' => 'id'])->where(['likeType' => '1'])->count();
    }

    /**
     * Возвращает количество дизлайков поста
     * @return int
     */
    public function getPostNegativeLikesCount()
    {
        return $this->hasOne(UserPostLike::className(), ['post' => 'id'])->where(['likeType' => '-1'])->count();
    }

    /**
     * Возвращает список тегов поста
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return $this->hasMany(UserPostTag::className(), ['post' => 'id']);
    }
}

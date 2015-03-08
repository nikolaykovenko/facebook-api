<?php
/** @var \app\models\User $item */
$putAttributes = ['email'];
/** @var \yii\web\View $this */
$this->registerJsFile('/js/posts.js', ['depends' => [\app\assets\AppAsset::className()]]);
?>
<section class="user-page">
    <div class="row">
        <div class="col-sm-6">
            <div class="image">
                <?= !empty($item->imageUrl) ? '<img class="img-responsive" src="' . $item->imageUrl . '" alt="' . \yii\helpers\Html::encode($item->name) . '">' : '' ?>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="info">
                <h1 class="h2"><?= $item->name ?>:</h1>
                <dl>
                    <?php foreach ($putAttributes as $attr): ?>
                        <?= !empty($item->$attr) ? '<dt>' . $item->getAttributeLabel($attr) . '</dt>
                                                    <dd>' . $item->$attr . '</dd>' : '' ?>
                    <?php endforeach ?>
                </dl>
            </div>
        </div>
    </div>
    
    <?php if (!empty($item->posts)): ?>
        <section class="user-posts-list">
            <h2>Пости користувача:</h2>
            <?php foreach ($item->posts as $post): ?>
                <article class="item" data-post-id="<?= $post->id ?>">
                    <div class="row">
                        <div class="col-sm-4 col-md-2">
                            <div class="image">
                                <?= !empty($post->imageUrl) ? '<img class="img-responsive" src="' . $post->imageUrl . '" alt="">' : '' ?>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-10">
                            <div class="text">
                                <?= \yii\helpers\Html::encode($post->text); ?>
                            </div>
                        </div>
                    </div>
                    <footer class="item-footer">
                        <div class="row">
                            <div class="col-xs-4">
                                <?= Yii::$app->formatter->asDatetime($post->date) ?>
                            </div>
                            <div class="col-xs-4 text-center">
                                <button class="btn btn-success" data-like="1">
                                    Лайк (<span data-likes-count><?= $post->postPositiveLikesCount ?></span>) <span class="glyphicon glyphicon-thumbs-up"></span>
                                </button>
                                <button class="btn btn-danger" data-like="-1">
                                    НеЛайк (<span data-likes-count><?= $post->postNegativeLikesCount ?></span>) <span class="glyphicon glyphicon-thumbs-down"></span>
                                </button>
                            </div>
                            <div class="col-xs-4 text-right">
                                <?= !empty($post->url) ? '<a class="btn btn-link" href="' . $post->url . '" target="_blank">Детальний перегляд</a>' : '' ?>
                            </div>
                            <div class="col-xs-12">
                                <div class="tags" data-tags>
                                    <?php foreach ($post->postTags as $tag): ?>
                                        <?= $this->render('/post/tag-item', ['tag' => $tag]) ?>
                                    <?endforeach ?>
                                    
                                </div>
                                <form class="form-inline" action="<?= \yii\helpers\Url::to(['/post/add-tag']) ?>"
                                      method="post" data-ajax-form-response="addTagResponse" data-ajax-form>
                                    <input type="hidden" name="post" value="<?= $post->id ?>">
                                    <div class="form-group">
                                        <label for="add-tag">Додати тег</label>
                                        <input name="tag" type="text" class="form-control" id="add-tag" placeholder="Новий тег" required>
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Додати">
                                </form>
                            </div>
                        </div>
                    </footer>
                </article>
            <?php endforeach ?>
        </section>
    <?php endif ?>
</section>
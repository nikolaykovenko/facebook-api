<?php
/** @var \app\models\User $item */
$putAttributes = ['email'];
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
                <article class="item">
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
                            <div class="col-xs-6">
                                <?= Yii::$app->formatter->asDatetime($post->date) ?>
                            </div>
                            <div class="col-xs-6 text-right">
                                <?= !empty($post->url) ? '<a href="' . $post->url . '" target="_blank">Детальний перегляд</a>' : '' ?>
                            </div>
                        </div>
                    </footer>
                </article>
            <?php endforeach ?>
        </section>
    <?php endif ?>
</section>
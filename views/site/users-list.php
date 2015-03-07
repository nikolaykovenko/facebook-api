<?php
/** @var \app\models\User[] $itemsList */
?>
<h1 class="h2">Список користувачів</h1>
<div class="users-list">
    <?php foreach ($itemsList as $item): ?>
        <article class="item">
            <div class="row">
                <div class="col-xs-6 col-sm-4 col-md-2">
                    <div class="image">
                        <?= !empty($item->imageUrl) ? '<img class="img-responsive" src="' . $item->imageUrl . '" alt="' . \yii\helpers\Html::encode($item->name) . '">' : '' ?>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-8 col-md-10">
                    <h2 class="h3"><?= $item->name ?></h2>
                    <footer class="item-footer">
                        <a href="<?= \yii\helpers\Url::to(['/site/user-page', 'user' => $item->id]) ?>">Детальний перегляд</a>
                    </footer>
                </div>
            </div>
        </article>
    <?php endforeach ?>
</div>
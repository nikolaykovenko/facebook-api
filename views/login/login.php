<?php
use \yii\helpers\Url;
?>

<h1 class="h2">Авторизація</h1>
<header class="block-header">
    Ви не авторизовані. Щоб використовувати всі можливості системи, будь-ласка, авторизуйтеся:
</header>
<div>
    <a class="btn btn-default" href="<?= Url::to(['login/login', 'system' => 'facebook']) ?>">Facebook</a>
    <a class="btn btn-default" href="<?= Url::to(['login/login', 'system' => 'in_develop']) ?>">Гіпотетична система</a>
</div>
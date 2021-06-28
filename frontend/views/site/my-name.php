<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'My Name';
$this->params['breadcrumbs'][] = $this->title;
?>


<body>
<div class="container">
    <div class="row">
        <div class="col-lg">
            <img src="https://www.meme-arsenal.com/memes/8025f0b29a9899d1b2913e50ad96b90e.jpg" alt="фото" width="200"
                 height="200">
        </div>
        <div class="col-lg">
            <h1>ФИО</h1>
            <form action="">
                <input type="text"> <br>
                <input type="text">

            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table cellspacing="1" cellpadding="4" border="1">
                <tr>
                    <td>Навык</td>
                    <td>Дата</td>
                    <td>Описание</td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>

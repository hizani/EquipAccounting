<?php

/* @var $this yii\web\View */

$this->title = 'Учет оборудованияя';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Учет оборудования</h1>
        <p class="lead">Вас приветствует менеджер учета оборудования!</p>
        <form action="/site/excel">
            <input type="submit" class="btn btn-lg btn-success" value="Сформировать excel таблицу учета">
        </form>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Шаблоны оборудования</h2>

                <p>В этой таблице представлены все шаблоны оборудования. Также, данный раздел позваляет создавать и
                    редактировать созданные шаблоны</p>

                <p><a class="btn btn-default" href="/equipment-type">Шаблоны &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Оборудование на учете</h2>

                <p>В данной таблице представлено всё оборудование, которое стоит в текуищий момент на учете. В этом
                    разделе можно создавать конкретное оборудование по созданному ранее шаблону</p>

                <p><a class="btn btn-default" href="/accounted-equipment">Оборудование &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Аудитории</h2>

                <p>Данная таблица позволяет просматривать подлежаюие учету аудитории, ставить на учет новые
                    и удалять снятые с учета </p>

                <p><a class="btn btn-default" href="/classroom">Аудитории &raquo;</a></p>
            </div>
        </div>

    </div>
</div>

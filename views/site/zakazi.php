<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.02.17
 * Time: 22:41
 */

use yii\helpers\Html;
use \yii\widgets\Pjax;

$this->title = 'Запчасти';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile("http://rm.0x5.ru/css/bootstrap-select.min.css");

//$this->registerJsFile('http://rm.0x5.ru/js/jquery.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('http://rm.0x5.ru/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('http://rm.0x5.ru/js/bootstrap-select.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="row padding-bot">
    <div class="col-xs-12 col-xs-offset-0 col-sm-9 col-sm-offset-0 col-md-9 col-md-offset-0 col-lg-8 col-lg-offset-0">
        <!--<p>
           <a class="text-inline" href="need-rem.html" role="button"><span class="lead">
Оставить заявку на ремонт <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
        </span></a>&nbsp;
           <a class="text-inline" href="spares-order.html" role="button"><span class="lead">
Оставить заявку на запчасть <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
        </span></a>
        </p>-->
    </div>
</div>

<div class="row">
    <?php Pjax::begin(); ?>
    <div class="col-xs-12 col-xs-offset-0 col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0 col-lg-6 col-lg-offset-0">
        <?php if (count($model['zakazi']) > 0) {
            foreach ($model['zakazi'] as $item) {
                ?>

                <div class="thumbnail">
                    <div class="caption">
                        <h4><?= $item['name'] ?></h4>
                        <p><?= $item['description'] ?></p>
                        <p class="text-right">Город: <?= \app\models\Regions::findOne($item['city'])['name'] ?></p>
                        <!-- <button type="button" class="btn btn-md btn-primary">Принять заявку</button> -->
                        <a href="<?= Yii::getAlias('@web') ?>/site/description?id=<?= $item['id'] ?>" role="button" class="btn btn-primary btn-large">Подробнее</a>
                    </div>
                </div>

            <?php }} else { ?>
            Запчастей нет
            <?php
        }
        echo \yii\widgets\LinkPager::widget([
            'pagination' => $model['pages'],
        ]);
        ?>
    </div>
    <?php Pjax::end(); ?>

    <div class="col-xs-12 col-xs-offset-0 col-sm-5 col-sm-offset-0 col-md-4 col-md-offset-2 col-lg-4 col-lg-offset-2">
        <div class="">
            <h3 class="first">Регион</h3>
            <?php
            $selectTitle = 'Выберите регион';
            if (isset($_GET['region']))
                $selectTitle = \app\models\Regions::findOne($_GET['region'])['name'];
            ?>
            <select class="selectpicker" title="<?= $selectTitle ?>" data-live-search="true" onchange="javascript:location.href = this.value;">
                <?php
                foreach ($model['reg_items'] as $item) {
                    echo '<option value="http://'.$_SERVER['SERVER_NAME'].yii\helpers\Url::current(['region'=>$item['id']]).'">'.$item['name'].'</option>';
                }
                ?>
            </select>
            <h3>Вид техники</h3>
            <div class="list-group">
                <?php
                foreach ($model['tec_items'] as $item)  {
                    $params = ['class' => 'list-group-item'];
                    if (isset($_GET['tech']) && $_GET['tech'] == $item['id'])
                        $params = ['class' => 'list-group-item active'];
                    echo Html::a($item['name'], 'http://'.$_SERVER['SERVER_NAME'].yii\helpers\Url::current(['tech'=>$item['id']]), $params);
                }
                ?>
            </div>
        </div>
    </div>

    <?php //Pjax::end(); ?>
</div>

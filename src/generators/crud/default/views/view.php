<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// \yii\web\YiiAsset::register($this);
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">


    <div class="post d-flex flex-column-fluid">
        <div class="container-xxl">
            <div class="row">
                <div class="col-xl-12">
                    <!--begin::Tables Widget 9-->
                    <div class="card card-xl-stretch mb-12 ">

                        <div class="card-body pt-5">

                        <?= "<?= " ?>DetailView::widget([
                            'model' => $model,
                            'options' => ['class' => 'table table-row-dashed table-hover gs-0 gy-4'],
                            'template' => '<tr><th class="font-weight-bold">{label}</th><td>{value}</td></tr>', 
                            'attributes' => [
<?php
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        echo "                                '" . $name . "',\n";
    }
} else {
    foreach ($generator->getTableSchema()->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        echo "                                '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
    }
}
?>
//                                  [
//                                      'attribute'=>'created_at',
//                                       'value'=>function($model){
//                                           return date('Y-m-d', $model->created_at);
//                                       }
//                                  ],
//                                  [
//                                      'attribute'=>'updated_at',
//                                       'value'=>function($model){
//                                           return date('Y-m-d', $model->updated_at);
//                                       }
//                                  ],
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

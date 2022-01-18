<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model = $this->context->searchModel;
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">

    <?= "<?php " ?>$form = ActiveForm::begin([
        'id' => 'filterSearchOptionsForm',
        'action' => ['index'],
        'method' => 'get',
<?php if ($generator->enablePjax): ?>
        'options' => [
            'data-pjax' => 1
        ],
<?php endif; ?>
    ]); ?>

    <div class="px-7 py-5 mh-350px overflow-auto">

<?php
$count = 0;
foreach ($generator->getColumnNames() as $attribute) {
    if (++$count < 6) {
        echo "    <?= " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
    } else {
        echo "    <?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
    }
}
?>

    </div>
    
    <div class="separator border-gray-200"></div>
    
    <div class="px-7 py-4">
        <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Search') ?>, ['class' => 'btn btn-sm btn-primary', 'data-kt-menu-dismiss' => "true"]) ?>
        <?= "<?= " ?>Html::resetButton(<?= $generator->generateString('Reset') ?>, ['class' => 'btn btn-sm btn-light btn-active-light-primary me-2']) ?>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>

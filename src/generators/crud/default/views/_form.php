<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<div class="modal-content">
    <div class="modal-header">
        <h2><?= "<?php " ?> echo $model->isNewRecord?Yii::t('app', 'Create'):Yii::t('app', 'Update');?></h2>

        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
            <span class="svg-icon svg-icon-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                </svg>
            </span>
        </div>
    </div>
    <div class="modal-body py-lg-10 px-lg-10">
        <div class="d-flex flex-column flex-xl-row flex-row-fluid">
            
            <div class="flex-row-fluid py-lg-5 px-lg-15">
                
                <div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

                <?= "<?php " ?> $form = ActiveForm::begin([
                    'action' => $model->isNewRecord?Url::toRoute(['create']):Url::toRoute(['update','id'=>$model->id]),
                    'id' => 'common_create_modal_form',
                    'options' => [
                        'class' => 'form',
                        'novalidate' => 'novalidate',
                    ],
                ]); ?>

                <?= "<?php " ?>echo common\components\Alert::widget(['executeImmediately'=>true, 'reload'=>true]) ?>
                <?= "<?php " ?>echo $form->errorSummary($model); ?>

                <div>
                    <!--begin::Step 1-->
                    <div class="current" data-kt-stepper-element="content">
                        <div class="w-100">
                            
                            <?php foreach ($generator->getColumnNames() as $attribute) {
                            if (in_array($attribute, $safeAttributes)) {
                            ?><div class="fv-row mb-10">
                            <?php  echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n";?>
                            </div>
                                <?php
                            }
                            } ?>

                        </div>
                    </div>
                    <!--end::Step 1-->

                    <!--begin::Step 2-->

                    <!--end::Step 2-->


                    <!--begin::Actions-->
                    <div class="d-flex flex-stack pt-10">
                        <div>
                            <button type="button" class="btn btn-lg btn-primary form_submit_btn">
                                <span class="indicator-label"><?= "<?php " ?> echo $model->isNewRecord?Yii::t('app', 'Create'):Yii::t('app', 'Update');?>
                                </span>
                                <span class="indicator-progress"><?= "<?php " ?> echo Yii::t('app', 'Please wait');?>...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
                    <!--end::Actions-->


                </div>

                <?= "<?php " ?> echo common\components\Alert::widget(['executeImmediately'=>true, 'reload'=>true]) ?>
                <?= "<?php " ?> echo $form->errorSummary($model); ?>

                <?= "<?php " ?>ActiveForm::end(); ?>

                </div>
                
            </div>
        </div>
    </div>
</div>



<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$modelClass = StringHelper::basename($generator->modelClass);

echo "<?php\n";
?>

use yii\bootstrap4\Html;
use yii\helpers\Url;
//use yii\grid\ActionColumn;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>



$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">

<?= $generator->enablePjax ? "    <?php Pjax::begin(); ?>\n" : '' ?>

<?php if ($generator->indexWidgetType === 'grid'): ?>

    <div class="post d-flex flex-column-fluid">
        <div class="container-xxl">
            <div class="row">
                <div class="col-xl-12">
                    <!--begin::Tables Widget 9-->
                    <div class="card card-xl-stretch mb-12 ">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5 pb-5 justify-content-start">
                            <?= '<?php '?> echo $this->render('_searching', ['model' => $searchModel]); ?>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-3">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                            <?= "<?php " ?>
							$count = $dataProvider->getCount();
							if ($count > 0) {
							?>
                            <?= "<?= " ?>GridView::widget([
                                'dataProvider' => $dataProvider,
                                'tableOptions' => [
                                    'class' => 'table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4 '
                                    ],
                                    'headerRowOptions' => ['class' => 'fw-bolder text-muted '],
                                    'pager' => [
                                        'class' => '\common\components\PageJumper',
                                ],
                                'columns' => [
                                    //['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'class' => 'yii\grid\CheckboxColumn',
                                        'header' => '<div class="form-check form-check-sm form-check-custom form-check-solid">' .
                                            Html::checkBox('index_selection_all', false, ['type' => 'checkbox', 'data-kt-check' => "true", 'class' => 'form-check-input', 'data-kt-check-target' => ".widget-9-check"])
                                            . '</div>',
                                        'cssClass' => 'form-check-input widget-9-check',
                                        'content' => function ($model) {
                                            return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                                ' . Html::checkBox('selection', false, ['class' => 'list_item_check form-check-input widget-9-check', 'value'=>$model->id]) . '
                                            </div>';
                                        },
                                    ],
<?php
                            $count = 0;
                            if (($tableSchema = $generator->getTableSchema()) === false) {
                                foreach ($generator->getColumnNames() as $name) {
                                    if (++$count < 6) {
                                        echo "                                    '" . $name . "',\n";
                                    } else {
                                        echo "                                    //'" . $name . "',\n";
                                    }
                                }
                            } else {
                                foreach ($tableSchema->columns as $column) {
                                    $format = $generator->generateColumnFormat($column);
                                    if (++$count < 6) {
                                        echo "                                    '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                    } else {
                                        echo "                                    //'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                    }
                                }
                            }
                            ?>
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'header' => Yii::t('app', 'Actions'),
                                        'template' => '{update} {delete}&nbsp; {view}',
                                        'buttons' => [
                                            'update' => function ($url, $model, $key) {
                                                return '<a href="' . $url . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="' . Yii::t('yii', 'Update') . '" data-bs-toggle="modal" data-bs-target="#common_create_modal" >
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                                                                </svg>
                                                            </span>
                                                        </a>';
                                            },
                                            'delete' => function ($url, $model, $key) {
                                                return '<a href="javascript:void(0);" class="delete-record btn btn-icon btn-bg-light btn-active-color-primary btn-sm " title="' . Yii::t('yii', 'Delete') . '" data-redirect-url="' . Url::toRoute(['index']) . '" data-href="' . $url . '">
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                                                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                                                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                                                                </svg>
                                                            </span>
                                                        </a>';
                                            },
                                            'view' => function ($url, $model, $key) {
                                                return '<a href="' . $url . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="' . Yii::t('yii', 'View') . '">
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black"></rect>
                                                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black"></path>
                                                                </svg>
                                                            </span>
                                                        </a>';
                                            }
                                        ]
                                    ],
                                ],
                            ]); 
                            } else {
								?>
								<div class="card-px text-center my-10">
									<h2 class="fs-2x fw-bolder mb-10"><?= '<?php '?> Yii::t('app', 'Here is nothing!'); ?></h2>
									<p class="text-gray-400 fs-4 fw-bold mb-10"><?= '<?php '?> Yii::t('app', 'Maybe you can create by yourself!'); ?></p>

									<a href="<?= '<?php '?> echo Url::toRoute(['create']); ?>" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#common_create_modal">
										<i class="fas fa-plus"></i> <?= '<?php '?> Yii::t('app', 'Create'); ?>
									</a>

								</div>
							<?= "<?php \n"?>
							}
                            ?>
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--begin::Body-->

                        <div class="card-footer py-3">
                            <a href="javascript:void(0);" class="delete-record delete-records d-none btn btn-sm btn-icon btn-light btn-active-light-primary"  title="<?= '<?php '?> Yii::t('app', 'Delete'); ?>" data-redirect-url="<?= '<?php '?> echo Url::toRoute(['index']); ?>" data-href="<?= '<?php '?> echo Url::toRoute(['delete'])?>">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                        </div>
                    </div>
                    <!--end::Tables Widget 9-->
                </div>
            </div>
        </div>
    </div>







    
<?php else: ?>
    <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?= $generator->getNameAttribute() ?>), ['view', <?= $generator->generateUrlParams() ?>]);
        },
    ]) ?>
<?php endif; ?>

<?= $generator->enablePjax ? "    <?php Pjax::end(); ?>\n" : '' ?>

</div>

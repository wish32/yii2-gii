
<?= "<?php \n" ?>
$attributes = $model->attributes;
$inputNamePre = $model->formName();
foreach( $attributes as $key=>$value ):
    if ($value!==null && $value!==''):
    ?>
    <a href="javascript:void(0);" name="<?= '<?php ' ?> echo $inputNamePre.'['.$key.']';?>" onclick="AMCommon.filterSearchingOptionsCancel(this);" class="btn btn-light-primary filterSearchingOptions">
        <?= '<?php ' ?> echo $model->getAttributeLabel($key).': '.$value; ?> &nbsp;
        <i class="fa fa-times"></i>
    </a> &nbsp;
    <?= "<?php \n" ?>
    endif;
endforeach;

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Add Product';
$this->params['breadcrumbs'][] = ['label' => 'Product List', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'productName')->textInput() ?>

<?= $form->field($model, 'channels', ['template' => 
    '{label}
    <div class="checkgroup">
        <input type="checkbox" class="all" Name="CheckAll"><label for="all" class="label-all">Check All</label><br />
        {input}
    </div>
    {error}',
])->checkboxList($channels, [ 'separator'=>'&nbsp;&nbsp;']) ?>

<div class="form-group">
    <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
    <?= Html::a('Cancel', \Yii::$app->request->referrer, ['class' => 'btn btn-warning cancel']) ?>
</div>
<?php ActiveForm::end(); ?>
<?php 
    $this->registerJs("
        $('.all').change(function(){
    		if(this.checked){
    			$('.label-all').html('Deselect All');
    		}else{
    			$('.label-all').html('Check All');
    		}
            $('#product-channels input').prop('checked', this.checked);
	    });
        
        $('#product-channels input').change(function(){
    		var checkAll = true;
        	$('#product-channels input').each(function(){
        		if(!$(this).prop('checked')){
        			checkAll = false;
        			$('.all').prop('checked', false);
        			$('.label-all').html('Check All');
        			return false;
        		}
        	});
        	if(checkAll){
        		$('.all').prop('checked', true);
        		$('.label-all').html('Deselect All');
        	}
	    });
        $(document).on('click', '.cancel', function(){
            window.history.back();
        });
    ");
?>
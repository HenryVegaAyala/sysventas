<?php
	use synatree\dynamicrelations\SynatreeAsset;

	SynatreeAsset::register($this);
?>

<label class="form-control"><?= $title; ?></label>
<ul class="list-group" data-related-view="<?= $ajaxAddRoute; ?>">
	<li class="list-group-item">
		<a href="#" class="btn btn-success btn-sm add-dynamic-relation">
			<i class="glyphicon glyphicon-plus"></i> Add
		</a>
	</li>

<?php 
	foreach($collection as $model)
	{
?>
	<li class="list-group-item">
		<div class="row">
		
			
			<div class="col-sm-11">
				<div class="dynamic-relation-container">
					<?= $this->renderFile( $viewPath, [ 'model' => $model ]); ?>
				</div>
			</div>
			<div class="col-sm-1">
				<button type="button" class="btn btn-block btn-default btn-sm  remove-dynamic-relation" aria-label="Remove"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
			</div>
		</div>
	</li>	
<?php
	}
?>
</ul>


<?php
	include("../config.php");
	$lineNo = $_REQUEST['lineNo'];
?>
<div class="itemPart">
<div class="row">
	<div class="col-md-6 col-xs-12">
		<div class="row">
			<div class="col-md-5 col-xs-12">
				<div class="form-group">
					<?php if($lineNo == 1){?><label>Name</label><?php } ?>
					<input type="text" name="vName_<?=$lineNo?>" id="vName_<?=$lineNo?>" class="form-control" />
				</div>
			</div>
			<div class="col-md-6 col-xs-12">
				<div class="form-group">
					<?php if($lineNo == 1){?><label>Value</label><?php } ?>
					<input type="text" name="vValue_<?=$lineNo?>" id="vValue_<?=$lineNo?>" class="form-control" />
				</div>
			</div>
			<div class="col-md-1 col-xs-1">
				<div class="form-group">
					<?php if($i == 1){ ?><label>&nbsp;</label><?php } ?>
					<button type="button" class="btn btn-primary btn-sm " onclick="removerow(this,<?=$lineNo?>)"><i class="fa fa-trash"></i> </button>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
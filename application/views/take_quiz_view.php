<div class="container">
<h2>Quiz name</h2>
<ul class="list-group">

</ul>

<div class="container-fluid">
  	<?php 
		foreach ($questions->result() as $row) { ?>
		<div class="row">
		<div class="col-md-12">
			<h3>
				Question
			</h3>
			<p>
				<?php echo $row->question_text; ?>
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 well">
			<p>
				<?php echo $row->answer_a; ?>
			</p> 
			<button type="button" class="btn btn-success btn-lg btn-block">
				Select this answer
			</button>
		</div>
		<div class="col-md-3 well">
			<p>
				<?php echo $row->answer_b; ?>
			</p> 
			<button type="button" class="btn btn-success btn-lg btn-block">
				Select this answer
			</button>
		</div>
		<div class="col-md-3 well">
			<p>
				<?php echo $row->answer_c; ?>
			</p> 
			<button type="button" class="btn btn-success btn-lg btn-block">
				Select this answer
			</button>
		</div>
		<div class="col-md-3 well">
			<p>
				<?php echo $row->answer_d; ?>
			</p> 
			<button type="button" class="btn btn-success btn-lg btn-block">
				Select this answer
			</button>
		</div>
	</div>
		<?php }
	?>
</div>
</div>


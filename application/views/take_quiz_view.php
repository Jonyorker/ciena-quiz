<div class="container">
<h2>Quiz name</h2>
<ul class="list-group">
</ul>

<div class="container-fluid">
  	<?php 
  		echo form_open('/Quiz/answers', 'class="form-horizontal", id="ciena-form"');
  		echo form_hidden('quiz_id', $quiz_id);
  		$index = 0;
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
			<?php echo form_radio('user_answer['.$index.']', 'a', FALSE); ?>
		</div>
		<div class="col-md-3 well">
			<p>
				<?php echo $row->answer_b; ?>
			</p> 
			<?php echo form_radio('user_answer['.$index.']', 'b', FALSE); ?>
		</div>
		<div class="col-md-3 well">
			<p>
				<?php echo $row->answer_c; ?>
			</p> 
			<?php echo form_radio('user_answer['.$index.']', 'c', FALSE); ?>
		</div>
		<div class="col-md-3 well">
			<p>
				<?php echo $row->answer_d; ?>
			</p> 
			<?php echo form_radio('user_answer['.$index.']', 'd', FALSE); ?>
		</div>

	</div>
		<hr>
		<?php 
		$index++;
		}
		echo form_submit('', 'Submit answers', array('class' => 'btn btn-success btn-lg'));
		echo form_close();
	?>
</div>
</div>


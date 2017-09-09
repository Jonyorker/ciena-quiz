<div class="container">
<h2>Quiz Results</h2>
<ul class="list-group">
</ul>

<div class="container-fluid">
	<?php
	$index = 0;
	foreach ($questions->result() as $row) { 
	$user_answer = $this->quiz_model->user_answer($row->question_id);
	$right_choice = $row->right_choice;
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4 well">
					<p>Question Text :
						<?php echo $row->question_text; ?>
					</p>
				</div>
				<div class="col-md-4 well">
					<p>User Answer :
						<?php echo $user_answer ?>
					</p>
				</div>
				<div class="col-md-4 well">
					<p>
						<?php 
							if ($user_answer == $right_choice) {
								echo "Correct!";
							}
							else {
								echo 'The correct answer was :';
								if ($right_choice == 1) {
									echo $row->answer_a;
								}
								elseif ($right_choice == 2) {
									echo $row->answer_b;
								}
								elseif ($right_choice == 3) {
									echo $row->answer_c;
								}
								else {
									echo $row->answer_d;
								}
							}

						?>
					</p>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<?php
	$index++; 
	}
	?>
</div>
<?php echo anchor('', 'Return Home', array('title' => 'Return Home', 'class' => 'btn btn-primary btn-lg btn-block')); ?>
</div>


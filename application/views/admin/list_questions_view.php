<div class="container">
<h2>Edit Questions</h2>
<ul class="list-group">

</ul>

<div class="list-group">
  	<?php 
		foreach ($questions->result() as $row) {
			$question = $row->question_text;
			$id = $row->question_id;
			echo anchor('/Admin_panel/retrieve_question_value/'.$id, $question, array('title' => $question, 'class' => 'list-group-item')); 
		}
	?>
</div>
  <!-- Button (Double) -->
  		<div class="col-md-4">
			<?php echo anchor('/Admin_panel/delete_quiz/'.$quiz_id, 'Delete Quiz', array('title' => 'Delete Quiz', 'class' => 'btn btn-warning btn-lg btn-block')); ?>
		</div>
		<div class="col-md-4">
			<?php echo anchor('/Admin_panel/edit_add_question/'.$quiz_id, 'Add Question', array('title' => 'Add Question', 'class' => 'btn btn-primary btn-lg btn-block')); ?>
		</div>
   

</div>
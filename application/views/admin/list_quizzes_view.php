<div class="container">
<h2 class="text-center">Edit Quiz</h2>
<hr>
<ul class="list-group">

</ul>

<div class="list-group">
  	<?php 
		foreach ($quizzes->result() as $row) {
			$name = $row->quiz_name;
			$id = $row->quiz_id;
			echo anchor('/Admin_panel/list_questions/'.$id.'/'.$name, $name, array('title' => $name, 'class' => 'list-group-item')); 
		}
	?>
</div>

</div>
<div class="container">
<h2>Select Questions</h2>
<ul class="list-group">

</ul>

<div class="list-group">
  	<?php 
		foreach ($quizzes->result() as $row) {
			$name = $row->quiz_name;
			$id = $row->quiz_id;
			echo anchor('/Quiz/take_quiz/'.$id.'/'.$name, $name, array('title' => $name, 'class' => 'list-group-item')); 
		}
	?>
</div>

</div>
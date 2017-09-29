<div class="container">
<h2 class="starter-template">Select Quiz</h2>
<hr>
<ul class="list-group">

</ul>

<div class="list-group">
  	<?php 
		foreach ($quizzes->result() as $row) {
			$name = $row->quiz_name;
			$id = $row->quiz_id;
			echo anchor('/Quiz/start/'.$id, $name, array('title' => $name, 'class' => 'list-group-item')); 
		}
	?>
</div>

</div>
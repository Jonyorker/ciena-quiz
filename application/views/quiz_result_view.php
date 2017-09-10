<div class="container">
<h2>Quiz Results for <?php echo urldecode($this->session->userdata('quiz_name')); ?></h2>
<ul class="list-group">
</ul>

<div class="container-fluid">
	<div class="row">
	<p>
		<?php
		if ($percentage >= 75) {
			echo 'Congratulations, you scored '.$percentage.'%';
		}
		else {
			echo 'Looks like you have some studying to do, you scored '.$percentage.'%';
		}
		?>
	</p>
	</div>
</div>
<?php echo anchor('', 'Return Home', array('title' => 'Return Home', 'class' => 'btn btn-primary btn-lg btn-block')); ?>
</div>


<?php
	if (!is_null($this->session->userdata('quiz_bg_img'))) { ?>
		<style type="text/css">
		body {
			background-image: url("<?php echo base_url()."/public/img/".$this->session->userdata('quiz_bg_img'); ?>");
			background-size: cover;
		}
		</style>
		<img src="<?php echo base_url()."/public/img/logo.png"; ?>" class="img-responsive" id="logo">
<?php }	?>
<div class="container">	
	<h2 class="starter-template">Quiz Results for <?php echo urldecode($this->session->userdata('quiz_name')); ?></h2>
<hr>
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
<?php echo anchor('/User/destroy_session/', 'Return Home', array('title' => 'Return Home', 'class' => 'btn btn-ciena-yes btn-lg btn-block')); ?>
</div>


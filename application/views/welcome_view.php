    <div class="container">

      <div class="starter-template">
        <h1>Ciena Quiz</h1>
        <p class="lead">See how smart you are</p>
      </div>
      <div class="row row-eq-height">
	      <div class="col-md-12 well">
	      <?php echo form_open('Welcome/Quiz', 'class="form-new", id="ciena-form"'); ?>
	      <div class="form-group">
			<?php echo form_label('User Name', 'user_name', array('class' => 'col-md-3')); ?>
			<div class="col-md-9">
			<?php echo form_input('user_name','', array('placeholder' => 'User Name', 'class' => 'form-control')); ?>
			</div>
			<div class="col-md-12">
			<?php echo form_submit('submit', 'Next', array('class' => 'btn btn-default pull-right')); ?>
	      </div>

	      <?php echo form_close(); ?>
      </div>

    </div>
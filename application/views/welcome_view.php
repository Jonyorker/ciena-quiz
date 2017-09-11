    <div class="container">

      <div class="starter-template">
        <h1>Ciena Quiz</h1>
        <p class="lead">See how smart you are</p>
      </div>
      <div class="row row-eq-height">
	      <div class="col-md-6 well">
	      <h2>Login</h2>
	      <?php echo form_open('Welcome/quiz_login', 'class="form-new", id="ciena-form"'); ?>
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
	      <div class="col-md-6 well">
	      <h2>Continue Without logging in</h2>
	      <?php echo form_open('User/anonymous', 'class="form-new", id="ciena-form"'); ?>
	      <div class="form-group">
			<?php echo form_hidden('user_id', 'anonymous'); ?>
			<div class="col-md-12">
			<?php echo form_submit('submit', 'Next', array('class' => 'btn btn-default pull-right')); ?>
	      </div>

	      <?php echo form_close(); ?>
      	</div>

    </div>
    </div>
    </div>
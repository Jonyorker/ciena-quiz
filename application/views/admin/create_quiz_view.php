    <div class="container">
    <?php echo form_open('/Admin_panel/store_quiz', 'class="form-horizontal", id="ciena-form"'); ?>
<fieldset>

<!-- Form Name -->
<legend>Create Quiz</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Quiz Name</label>  
  <div class="col-md-8">
  <?php echo form_input('quiz_name','', array('placeholder' => 'Quiz Name', 'class' => 'form-control input-md')); ?>
  <span class="help-block">enter quiz name</span>  
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="anonymous">Allow Anonymous?</label>
  <div class="col-md-4">
  <div class="checkbox">
    <label for="radios-0">
      <?php echo form_checkbox('anonymous', TRUE, FALSE); ?>
      Allow Anonymous access to quiz?
    </label>
  </div>
  </div>
  </div>

<div class="form-group">
  <label class="col-md-4 control-label" for="button1id"></label>
  <div class="col-md-8">
  	<?php echo form_submit('', 'Add Question', array('class' => 'btn btn-success btn-lg btn-block')); ?>
  </div>
</div>

</fieldset>
<?php echo form_close(); ?>
</div>
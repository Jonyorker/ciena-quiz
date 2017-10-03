<div class="container"> 
  <?php echo form_open('/Admin_panel/create_question', 'class="form-horizontal", id="ciena-form"'); ?>
  <?php echo form_hidden('quiz_name', $quiz_name); ?>
  <?php echo form_hidden('quiz_id', $quiz_id); ?>
<fieldset>

<!-- Form Name -->
<h2 class="text-center">Add Question for Quiz "<?php echo $quiz_name; ?>"</h2>
<hr>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-2 control-label" for="question_text">Question Text</label>
  <div class="col-md-10">                     
    <?php echo form_textarea('question_text','', array('placeholder' => 'Question text', 'class' => 'form-control')); ?>     
  </div>
</div>

<!-- Multiple Radios (inline) -->
<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-2 control-label" for="right_choice">Proper Answer?</label>
  <div class="col-md-4">
    <?php 
    $options = array(
      '1' => '1',
      '2' => '2',
      '3' => '3',
      '4' => '4',
      );
    echo form_dropdown('right_choice', $options, '', 'class="form-control"');
    ?>
  </div>
</div>

<!-- Textarea -->



<div class="row">
  <div class="form-group">
  <label class="col-md-2 control-label" for="ans_1">Answer 1</label>
  <div class="col-md-4">
    <?php echo form_textarea('answer_a','', array('placeholder' => 'Answer 1 text', 'class' => 'form-control')); ?>                    
  </div>


<!-- Textarea -->
  <label class="col-md-2 control-label" for="ans_2">Answer 2</label>
  <div class="col-md-4">                     
    <?php echo form_textarea('answer_b','', array('placeholder' => 'Answer 2 text', 'class' => 'form-control')); ?> 
  </div>
</div>
</div>
<!-- Textarea -->
<div class="row">
  <div class="form-group">
  <label class="col-md-2 control-label" for="ans_3">Answer 3</label>
  <div class="col-md-4">                     
    <?php echo form_textarea('answer_c','', array('placeholder' => 'Answer 3 text', 'class' => 'form-control')); ?> 
  </div>


<!-- Textarea -->

  <label class="col-md-2 control-label" for="ans_4">Answer 4</label>
  <div class="col-md-4">                     
    <?php echo form_textarea('answer_d','', array('placeholder' => 'Answer 4 text', 'class' => 'form-control')); ?> 
  </div>
</div>
</div>
<div class="row">
<div class="form-group">
  <label class="col-md-2 control-label" for="ans_4">Extra Info</label>
  <div class="col-md-10">                     
    <?php echo form_textarea('extra_info','', array('placeholder' => 'Extra info after user answers', 'class' => 'form-control skinny')); ?> 
  </div>
</div>
</div>


<!-- Button (Double) -->
<div class="form-group">
  <div class="col-md-4 pull-right">
    <?php echo form_submit('finish', 'Finish', array('class' => 'btn btn-ciena-no btn-lg')); ?>
    <?php echo form_submit('more', 'Add Question', array('class' => 'btn btn-ciena-yes btn-lg')); ?>
  </div>
</div>

</fieldset>
</form>

</div>
<div class="container">
  <?php echo form_open('/Admin_panel/edit_question_save', 'class="form-horizontal", id="ciena-form"'); ?>
  <?php echo form_hidden('question_id', $question['question_id']); ?>
<fieldset>

<!-- Form Name -->
<legend>Edit Question</legend>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="question_text">Question Text</label>
  <div class="col-md-8">                     
    <?php echo form_textarea('question_text', $question['question_text'], array('placeholder' => 'Question text', 'class' => 'form-control')); ?>     
  </div>
</div>

<!-- Multiple Radios (inline) -->
<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="right_choice">Proper Answer?</label>
  <div class="col-md-4">
    <?php 
    $options = array(
      '1' => '1',
      '2' => '2',
      '3' => '3',
      '4' => '4',
      );
    echo form_dropdown('right_choice', $options, $question['right_choice'], 'class="form-control"');
    ?>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="ans_1">Answer 1</label>
  <div class="col-md-8">
    <?php echo form_textarea('answer_a', $question['answer_a'], array('placeholder' => 'Answer 1 text', 'class' => 'form-control')); ?>                    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="ans_2">Answer 2</label>
  <div class="col-md-8">                     
    <?php echo form_textarea('answer_b', $question['answer_b'], array('placeholder' => 'Answer 2 text', 'class' => 'form-control')); ?> 
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="ans_3">Answer 3</label>
  <div class="col-md-8">                     
    <?php echo form_textarea('answer_c', $question['answer_c'], array('placeholder' => 'Answer 3 text', 'class' => 'form-control')); ?> 
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="ans_4">Answer 4</label>
  <div class="col-md-8">                     
    <?php echo form_textarea('answer_d', $question['answer_d'], array('placeholder' => 'Answer 4 text', 'class' => 'form-control')); ?> 
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="button1id"></label>
  <div class="col-md-4">
    <?php echo anchor('/Admin_panel/delete_question/'.$question['question_id'], 'Delete Question', array('title' => 'Delete Question', 'class' => 'btn btn-warning btn-lg')); ?>
    <?php echo form_submit('save', 'Save Changes', array('class' => 'btn btn-success btn-lg')); ?>
  </div>
</div>

</fieldset>
</form>

</div>
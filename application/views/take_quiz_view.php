<?php
  if (!is_null($this->session->userdata('quiz_bg_img'))) { ?>
    <style type="text/css">
    body {
      background-image: url("<?php echo base_url()."/public/img/".$this->session->userdata('quiz_bg_img'); ?>");
      background-size: cover;
    }
    </style>
    <img src="<?php echo base_url()."/public/img/logo.png"; ?>" class="img-responsive" id="logo">
<?php } ?>
<div class="container"> 
  <h2 class="starter-template"><?php echo urldecode($this->session->userdata('quiz_name')); ?></h2>
<hr>
 
<div class="container-fluid"> 
    <div class="row"> 
    <div class="col-md-12"> 
    <?php echo form_open('/Quiz/answer', 'class="form-horizontal", id="ciena-form"'); ?>
    <?php echo form_hidden('user_id', $this->session->userdata('user_id')); ?>
    <?php echo form_hidden('quiz_id', $this->session->userdata('quiz_id')); ?>
    <?php echo form_hidden('question_id', $question['question_id']); ?>
      <h3> 
        Question 
      </h3> 
      <p class="h3"> 
        <?php echo $question['question_text']; ?> 
      </p> 
    </div> 
  </div> 
  <div class="row"> 
    <hr>
    <div class="col-md-3 "> 
      <p class="h3"> 
        <?php echo $question['answer_a'] ?> 
      </p>  
    </div> 
    <div class="col-md-3 "> 
      <p class="h3"> 
        <?php echo $question['answer_b']; ?> 
      </p>  
    </div> 
    <div class="col-md-3 "> 
      <p class="h3"> 
        <?php echo $question['answer_c']; ?> 
      </p>   
    </div> 
    <div class="col-md-3 "> 
      <p class="h3"> 
        <?php echo $question['answer_d']; ?> 
      </p>  
    </div> 
  </div>
  <div class="row"> 
    <hr>
    <div class="col-md-3 "> 
      <?php echo form_button(array('name' => 'user_answer', 'id' => 'answer_a', 'value' => '1', 'type' => 'submit', 'content' => 'Select', 'class' => 'btn btn-ciena-yes btn-sm')); ?> 
    </div> 
    <div class="col-md-3 ">  
      <?php echo form_button(array('name' => 'user_answer', 'id' => 'answer_b', 'value' => '2', 'type' => 'submit', 'content' => 'Select', 'class' => 'btn btn-ciena-yes btn-sm')); ?> 
    </div> 
    <div class="col-md-3 ">  
      <?php echo form_button(array('name' => 'user_answer', 'id' => 'answer_c', 'value' => '3', 'type' => 'submit', 'content' => 'Select', 'class' => 'btn btn-ciena-yes btn-sm')); ?> 
    </div> 
    <div class="col-md-3 "> 
      <?php echo form_button(array('name' => 'user_answer', 'id' => 'answer_d', 'value' => '4', 'type' => 'submit', 'content' => 'Select', 'class' => 'btn btn-ciena-yes btn-sm')); ?>  
    </div> 
  </div> 
</div> 
</div> 
<div class="container"> 
<h2><?php echo urldecode($this->session->userdata('quiz_name')); ?></h2> 
 
<div class="container-fluid">
<?php if ($user_answer == $right_choice) { ?>
  <div class="row">
    <div class="col-md-12">
      <h3>
        Correct!
      </h3> 
      <?php echo anchor('/Quiz/next_question', $button_text, array('title' => 'Return Home', 'class' => 'btn btn-primary btn-lg btn-block')); ?>
    </div>
  </div>
  <?php
}
else {
?>
  <div class="row">
    <div class="col-md-12">
      <h3>
        The proper answer is :
      </h3>
      <p>
        <?php echo $right_choice_text; ?>
      </p>
      <p>
        <?php echo $extra_info; ?>
      </p> 
      <?php echo anchor('/Quiz/next_question', $button_text, array('title' => 'Return Home', 'class' => 'btn btn-primary btn-lg btn-block')); ?>
    </div>
  </div>
</div>
<?php 
};
?>
</div> 
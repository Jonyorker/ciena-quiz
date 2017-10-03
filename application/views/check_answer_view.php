<h2 class="starter-template"><?php echo urldecode($this->session->userdata('quiz_name')); ?></h2>
<hr>
 
<div class="container-fluid">
<?php if ($user_answer == $right_choice) { ?>
  <div class="row">
    <div class="col-md-12">
      <h3>
        Correct!
      </h3>
      <p class="lead" id="extra_info">
        <?php echo $extra_info; ?>
      </p>  
      <?php echo anchor('/Quiz/next_question', $button_text, array('title' => 'Return Home', 'class' => 'btn btn-ciena-yes btn-lg btn-block')); ?>
    </div>
  </div>
  <?php
}
else {
?>
  <div class="row">
    <div class="col-md-12">
      <h3>
        The proper answer is : <?php echo $right_choice_text; ?>
      </h3>
      <p class="lead" id="extra_info">
        <?php echo $extra_info; ?>
      </p> 
      <?php echo anchor('/Quiz/next_question', $button_text, array('title' => 'Return Home', 'class' => 'btn btn-ciena-yes btn-lg btn-block')); ?>
    </div>
  </div>
</div>
<?php 
};
?>
</div>
<script>
$(document).ready(function(){
        $('#extra_info').css('visibility','visible').hide().fadeIn('slow');
    });
</script> 
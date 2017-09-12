<div class="container"> 
 
<div class="container-fluid"> 
    <div class="row"> 
    <div class="col-md-12"> 
      <h4 class="text-center"> 
        Ciena Networks Presents 
      </h4> 
      <p class="text-center h1"> 
        <?php echo $this->session->userdata('quiz_name'); ?> 
      </p> 
    </div> 
  </div> 
  <div class="row"> 
    <?php echo anchor('/Quiz/take_quiz/'.$this->session->userdata('quiz_id').'/'.$this->session->userdata('quiz_name'), 'Begin Quiz', array('title' => $this->session->userdata('quiz_name'), 'class' => 'btn btn-primary btn-lg btn-block'));  ?>
  </div> 
</div> 
</div> 
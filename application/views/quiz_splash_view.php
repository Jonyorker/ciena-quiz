<div class="container"> 
 
<div class="container-fluid"> 
    <div class="row"> 
    <div class="col-md-12"> 
      <h4 class="text-center"> 
        Ciena Networks Presents 
      </h4> 
      <p class="text-center h1"> 
        <?php echo urldecode($this->session->userdata('quiz_name')); ?> 
      </p> 
    </div> 
  </div> 
  <div class="row" style="padding-top: 5%"> 
  <div class="col-md-12 text-center">
    <?php echo anchor('/Quiz/take_quiz/'.$this->session->userdata('quiz_id').'/'.$this->session->userdata('quiz_name'), 'Begin Quiz', array('title' => $this->session->userdata('quiz_name'), 'class' => 'btn btn-success btn-lg '));  ?>
    </div>
  </div> 
</div> 
</div> 
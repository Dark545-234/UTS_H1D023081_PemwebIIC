<?php
  if(!$this->session->userdata('user')){
    redirect('user/loginPage');
  }
?>
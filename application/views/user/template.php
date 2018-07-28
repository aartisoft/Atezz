<?php
if($this->session->userdata('SESSION_USER_ID'))
{    
     
    $this->load->view($theme . '/includes/header');    
    $this->load->view($theme . '/modules/' . $module .'/'.$page);
    $this->load->view($theme . '/includes/footer');
}
else
{
    $this->load->view($theme . '/includes/header');    
    if($module=="gig_preview" ||$module=="search" || $module=="user_profile" ||   $module=="buy_service"  ||   $module=="terms" ||   $module=="forget_password" ||   $module=="pages" ||   $module=="plano_premium" ||   $module=="projeto_solidario" )
    {
     $this->load->view($theme . '/modules/' . $module .'/'.$page);   
    }
 else {
        $this->load->view('user/modules/gigs/index');
    }
    
    $this->load->view($theme . '/includes/footer');
 
}
?>
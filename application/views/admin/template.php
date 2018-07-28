<?php
if (isset($this->session->userdata['id'])) {      	
    $this->load->view($theme . '/includes/header');
    $this->load->view($theme . '/includes/navbar');
    $this->load->view($theme . '/includes/sidebar');
    $this->load->view($theme . '/modules/' . $module . '/' . $page);
    $this->load->view($theme . '/includes/footer');
} else {     
    $this->load->view($theme . '/pages/login');
}
?>
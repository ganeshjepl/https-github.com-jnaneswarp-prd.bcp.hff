<?php
/*cheking user IP*/
$data['doc_css_path']        = $this->config->item('doc_css_path');
$data['doc_js_path']        = $this->config->item('doc_js_path');
$data['doc_plugin_path']    = $this->config->item('doc_plugin_path');
$data['doc_js_ext']         = $this->config->item('js_ext');
$data['doc_css_ext']        = $this->config->item('css_ext');
$data['doc_images']         = $this->config->item('doc_images');
$data['site_url']           = site_url();
$this->load->view('doctor/header_login',$data);
$this->load->view($content);
?>
<script>
    var site_url='<?php echo site_url();?>';
    var Dashboard  ='<?php echo getUrl('doctorDashboard') ;?>';
</script>
<?php 
$this->load->view('doctor/footer_login');
?>

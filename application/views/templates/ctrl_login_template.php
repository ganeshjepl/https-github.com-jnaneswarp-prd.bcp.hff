<?php
/*cheking user IP*/
$data['ctrl_css_path']       = $this->config->item('ctrl_css_path');
$data['ctrl_js_path']        = $this->config->item('ctrl_js_path');
$data['ctrl_plugin_path']    = $this->config->item('ctrl_plugin_path');
$data['ctrl_css_ext']        = $this->config->item('css_ext');
$data['ctrl_js_ext']         = $this->config->item('js_ext');
$data['ctrl_images']         = $this->config->item('ctrl_images');

$this->load->view('ctrl/header_login' ,$data);
?>
<script>
    var site_url='<?php echo site_url();?>';
    var Dashboard  ='<?php echo getUrl('Dashboard') ;?>';
</script>
<?php
$this->load->view($content);
$this->load->view('ctrl/footer_login');
?>
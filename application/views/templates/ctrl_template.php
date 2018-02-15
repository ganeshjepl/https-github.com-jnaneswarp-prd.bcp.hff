
<?php
/*cheking user IP*/
$data['ctrl_css_path']        = $this->config->item('ctrl_css_path');
$data['ctrl_js_path']        = $this->config->item('ctrl_js_path');
$data['ctrl_plugin_path']    = $this->config->item('ctrl_plugin_path');
$data['ctrl_css_ext']         = $this->config->item('css_ext');
$data['ctrl_js_ext']         = $this->config->item('js_ext');
$data['ctrl_images']         = $this->config->item('ctrl_images');
$data['site_url']           = site_url();
$imgs =$this->config->item('ctrl_images');

$this->load->view('ctrl/ctrl_header' ,$data);
$this->load->view('ctrl/ctrl_leftmenu');
$this->load->view($content);
$this->load->view('ctrl/ctrl_footer');

?>
<script>
    var site_url='<?php echo site_url();?>';
    var bcpList  ='<?php echo getUrl('bcpList') ;?>';
    	var imgs   = '<?php echo $imgs ?>';
</script>

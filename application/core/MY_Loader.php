<?php 
	class MY_Loader extends CI_Loader {
		public function __construct()
		{
			parent::__construct();
			$CI =  &get_instance();
			$CI->load = $this;
		}
		public function template($template_name, $vars = array(), $return = FALSE)
		{
			if($return):
			$content  = $this->view('templates/header', $vars, $return);
			$content .= $this->view($template_name, $vars, $return);
			$content .= $this->view('templates/footer', $vars, $return);

			return $content;
		else:
			$this->view('templates/header', $vars);
			$this->view($template_name, $vars);
			$this->view('templates/footer', $vars);
		endif;
		}
	}
?>

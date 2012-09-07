<?php
    if ( ! function_exists('gview'))
    {
        function gview($view, $data)
        {
           global $template;
           $ci = &get_instance();
           $data['view'] = $view;
           $ci->load->view('layouts/'.$template.'/gopang_page_view', $data);
        }
	}
/* End of file gopang_template.php */
/* Location: ./system/application/helpers/gopang_template.php */
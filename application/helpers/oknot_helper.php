<?php
    if ( ! function_exists('oknot'))
    {
        function oknot($status)
        {
          global $template;
          $assets = base_url(). "application/views/layouts/" .$template. "/img";
           if ($status == 1) {
             return '<img src="'.$assets.'/ok.gif"/>';
           } else {
              return '<img src="'.$assets.'/not.gif"/>';
           }
        }
	}
/* End of file gopang_template.php */
/* Location: ./system/application/helpers/gopang_template.php */
<?php 

if ( ! function_exists('form_dropdown_data')) {
    
    function form_dropdown_data($select, $table_name)
    {
        $ci = &get_instance();
        $select_data = implode(',', $select);
        $result = $ci->db->select("$select_data")->get("$table_name")->result_array();

        $dropdown = array(''=>'-- Select Data --');
        foreach($result as $r) {
            $dropdown[$r[$select[0]]] = $r[$select[1]];
        }
        return $dropdown;
    }
}
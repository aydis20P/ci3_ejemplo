<?php 

if ( ! function_exists('get_by'))
{
    function get_by($db, $table, $row = 'x', $field = FALSE){
        if ($field === FALSE)
                {
                        $query = $db->get($table);
                        return $query->result_array();
                }

                $query = $db->get_where($table, array($row => $field));
                return $query->result_array();
    }
}
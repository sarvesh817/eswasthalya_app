<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('get_customer_type')) {
    function get_customer_type() {
        return array("Normal" => "Normal","HNI" => "HNI");
    }
}

if (!function_exists('get_status')) {
    function get_status() {
        return array("Active" => "Active","Disabled" => "Disabled");
    }
}

if (!function_exists('query_record')) {
    function query_record($record, $params) {
        $data = array();
        foreach ($record['list'] as $key => $value) {
            $i = 0;
            foreach ($value as $v) {
                $data[$key][$i] = $v;
                $i++;
            }
        }
        $json_data = array(
            "draw" => intval($params['draw']),
            "recordsTotal" => intval($record['totalRecords']),
            "recordsFiltered" => intval($record['totalRecords']),
            "data" => $data
        );
        return json_encode($json_data);
    }

}

if (!function_exists('notification_count')) {
    function notification_count($caseType){

        $CI = & get_instance();
        $business_channel = $CI->session->userdata('business_channel');
        $businessChannel  = str_replace(',', '","', $business_channel);
        $ic_ids = $CI->session->userdata('ic_id');
        $user_branch = $CI->session->userdata('branch');

        if($caseType=="NORMAL"){

            $condition = 'baq.case_type="NORMAL" AND (baq.caller_case_status="Open" OR baq.caller_case_status="Pending")';
            $branchCC = str_replace(',', '","', $user_branch);
            $condition .= ' AND tc.branch IN("'.$branchCC.'")';
            $CI->db->select("baq.qrc_id");
            $CI->db->from("bpo_add_qrc baq");
            $CI->db->join('tbl_case tc', 'tc.c_id=baq.c_id', 'left');
            $CI->db->where($condition);

        } else if($caseType=="VMER"){

            $condition = 'baq.case_type="VMER" AND (baq.caller_case_status="Open" OR baq.caller_case_status="Pending")';
            $CI->db->select("baq.qrc_id");
            $CI->db->from("bpo_add_qrc baq");
            $CI->db->join('mer_case mc', 'mc.c_id=baq.c_id', 'left');
            $CI->db->where($condition);

        } else if($caseType=="ImmidiatePM"){

            $condition = 'is_deleted="No" AND case_status="Immediate Action"';
            
            $branchCC = str_replace(',', '","', $user_branch);
            $condition .= ' AND branch IN("'.$branchCC.'")';
            //$condition .= ' AND business_channel IN ("'.$businessChannel.'")';
            //echo $condition;
            $CI->db->select("c_id");
            $CI->db->from('tbl_case');
            $CI->db->where($condition);
            
        } else if($caseType=="ImmidiateVM"){

            $condition = 'mer_case_status="Immediate Action"';
            $CI->db->select("c_id");
            $CI->db->from('mer_case');
            $CI->db->where($condition);
        }

        $query = $CI->db->get();
        //echo $CI->db->last_query();exit();
        if($query->num_rows()>0){
            $result = $query->num_rows();
            return $result;
        }else{
            return "";
        }
    }
}


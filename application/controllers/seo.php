<?php
Class Seo extends MY_Controller {

    function sitemap()
    {
        $result = $this->db->get('articles');
        $data['data'] = $result->result_array();//select urls from DB to Array
        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view("sitemap",$data);
    }
}
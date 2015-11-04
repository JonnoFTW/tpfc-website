<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends MY_Admin {

    function __construct(){
		parent::__construct();
        $this->data['msg'] = '';
    }
    
    function index(){
        // List galleries
        $result = $this->db->get('galleries');
        $this->data['gallery'] = $result->result_array();
        $this->data['main_content'] .=  $this->load->view('admin/admin_gallery_list',$this->data,true);
        $this->load->view('default',$this->data);
	}
    
    public function new_gallery(){
        if(!$this->input->post('title')){
            $this->data['error'] = "Please provide a title for the new gallery";
            $this->gallery();
            return;
        }
        $this->db->insert('galleries',array('created'=>date('Y-m-d'),'description'=>$this->input->post('descr'),'title'=>$this->input->post('title')));
        
        redirect('admin/gallery/gid/'.$this->db->insert_id());
    }
    
    function gid($gid = false) {
        if(!$gid) {
            redirect('admin/gallery');
        } else {
            // Show this gallery if it exists, 
            // give a form to update gallery info
            // form over all images to update descriptions
            // another form to upload images.
            $result = $this->db->get_where('galleries',array('gid'=>$gid));
            if($result->num_rows() == 0) {
                // No such gallery
                $this->data['main_content'] .=  $this->load->view('admin/gallery_error',$this->data,true);
            } else {
                // Gallery exists, show the photos with forms
                $row = $result->row_array();
                $this->data['gTitle'] = $row['title'];
                $this->data['gDescr'] = $row['description'];
                $result = $this->db->join('images','images.gid = galleries.gid')->get_where('galleries',array('galleries.gid'=>$gid));
                $this->data['gid'] = $gid;
                $this->data['images'] = $result->result_array();
                $this->data['main_content'] .=  $this->load->view('admin/gallery_update',$this->data,true);
            }
        }
        $this->load->view('default',$this->data);
    }
    
    function update_images() {
        // Take in ajax of {id:description}
        // and update for those images accordingly
        if(!$this->input->is_ajax_request()) {
            echo "Do not access this page directly";
            return;
        }
        $out = array();
        if($data = json_decode($this->input->post('images'),true)){
            $imgs = array(); 
            foreach($data as $k=>$v) {
                if($v['delete'])
                    $out[] = $this->delete($k);
                else
                    $imgs[] = array("iid"=>$k,
                                    "description"=>$v['description'],
                                    "title"=>$v['title']
                                );
            }
         //  var_dump($imgs);
            $this->db->update_batch('images',$imgs,"iid");
            $out[] = "Updated ".$this->db->affected_rows(). " images";
            
        } else {
            echo "An error occurred, nothing was updated";
        }
        echo ul($out);
    }
    function update_gallery() {
        $title = $this->input->post('name');
        $descr = $this->input->post('description');
        $this->db->update('galleries',
            array("title"=>$title,
                  "description"=>$descr),
            array("gid"=>$this->input->post('gid')));
        $this->data['msg'] = "The gallery Was updated";
        $this->gid($this->input->post('gid'));
    }
    function delete($iid) {
        // Delete the specified image
        // Check it exists
        $result = $this->db->get_where('images',array('iid'=>$iid));
        if($result->num_rows() == 0) {
            return "Image does not exist";
        } else {
            $img = $result->row_array();
            unlink('assets/images/gallery/'.$img['link']);
            unlink('assets/images/thumbs/'.$img['link']);
            $this->db->delete('images',array('iid'=>$img['iid']));
            return "Deleted image ".$iid;
        }
    }
    function delete_gallery($gid = false) {
        // Delete the specified gallery and associated images
        $res = $this->db->get_where('galleries',array("gid"=>$gid));
        if($res->num_rows() == 0) {
            echo "No such gallery exists!";
        } else {
            $this->db->delete('galleries',array('gid'=>$gid));
            $res = $this->db->get_where('images',array("gid"=>$gid));
            foreach($res->result_array() as $v) {
                unlink('assets/images/gallery/'.$v['link']);
                unlink('assets/images/thumbs/'.$v['link']);
            }
            $this->db->delete('images',array('gid'=>$gid));
            $this->data['msg'] = heading("Deleted gallery ".$gid,3);
            $this->index();
        }
    }
    function add_image() {
        // Take in the post info
        $gid = $this->input->post('gid');
        // make sure the gallery exists,
        $result = $this->db->get_where('galleries',array('gid'=>$gid));
        if($result->num_rows() == 0) {
            $this->data['msg'] = 'That gallery does not exist! The image was not saved';
        } else {
            // Insert record to db
            // upload image, use insert_id to make file name
            // Make thumbnail
            $config['upload_path'] = 'assets/images/gallery/';
            $config['allowed_types'] = 'jpg'; 
            $config['encrypt_name'] = true;
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload()) {
                $this->data['msg'] = 'There was an error during upload: '.$this->upload->display_errors();
            } else {
                // Process image and generate thumb using imagick
                $this->data['msg'] = 'Image uploaded successfully';
                $imgData = $this->upload->data();
                $this->db->insert('images',array(
                    'link'=>$imgData['file_name'],
                    'uploaded'=>date('Y-m-d H:i'),
                    'gid'=>$gid,
                    'title'=>htmlentities($this->input->post('title')),
                    'description'=>htmlentities($this->input->post('description')))
                );
                $this->make_thumb($imgData['full_path']);

            }
        }
        // Show gallery again with a message
        $this->gid($gid);
    }
    private function make_thumb($img) {
        $image = new Imagick($img);
        $image->thumbnailImage(120,0);
        $thumbname = 'assets/images/thumbs/'.end(explode('/',$img));
        $image->writeImage($thumbname);
        $image->clear();
        $image->destroy();
    }

    /** 
      * imports all the old galleries and their images from the xml in the folders
      */
    function import() {
        return;
        // Clear the old galleries
        $res = $this->db->get('galleries');
        foreach($res->result_array() as $v) {
            $this->delete_gallery($v['gid']);
        }
        // Get the old galleries
        $folders = array_filter(glob('../*'),'is_dir');
        $this->remove_value($folders,"../new");
        $this->remove_value($folders,"../cgi-bin");
        foreach($folders as $v) {
            $albfile = end(glob($v.'/*.alb'));
            echo "Loading from $v: $albfile</br>\n";
            if(!$albfile) {
                echo "<li>xml file missing</li>\n</ul>\n";
                continue;
            }
            $xml = $this->xml2array(file_get_contents($albfile));
            if(is_array($xml['webalbum']['description']['line'])) 
                $descr = implode('\n',$xml['webalbum']['description']['line']);
            else
                $descr = $xml['webalbum']['description']['line'];
            
            $this->db->insert('galleries',
                array('created'=>date('Y-m-d'),
                'description'=>$descr,
                'title'=>$xml['webalbum']['title'])
            );
            echo "<ul>\n";
            $titles = array();
            $gid = $this->db->insert_id();
            foreach($xml['webalbum']['photographs']['photo'] as $i) {
                $title   = $i['title'];
                $descr = '';
                if(isset($i['caption']))  {
                    if(is_array($i['caption']['line']))
                        $descr = implode("\n ",$i['caption']['line']);
                    else
                        $descr = $i['caption']['line'];
                }
                $count = '';
                if(isset($titles[$title])) {
                    $titles[$title]++;
                    $count = strval($titles[$title]);
                } else {
                    $titles[$title] = 1;
                }
                    
                $imgname = strtolower(preg_replace("/[^a-z0-9]+/i",  '', $title)).$count.'.jpg'; 
                echo "<li>$title: $imgname, $descr</li>\n";
                
                $ext   = '.jpg';
                mt_srand();
                $filename = md5(uniqid(mt_rand())).$ext;
                copy($v.'/'.$imgname,'assets/images/gallery/'.$filename);
                $this->db->insert('images',
                    array(
                    'link'=>$filename,
                    'uploaded'=>date('Y-m-d H:i'),
                    'gid'=>$gid,
                    'title'=>$title,
                    'description'=>htmlentities($descr))
                );
                $this->make_thumb('assets/images/gallery/'.$filename);
            }
            echo "</ul>";
        }
        echo "Finished";
        die();
    }
    function remove_value(&$arr,$val) {
        if(($key = array_search($val, $arr)) !== false) {
            unset($arr[$key]);
        }
    }
    function test(){
        var_dump($this->xml2array(file_get_contents('../WVFC07_Olympic_Park_surrounds/WVFC07OlympicParksurround.alb')));
    }
    /** 
     * xml2array() will convert the given XML text to an array in the XML structure. 
     * Link: http://www.bin-co.com/php/scripts/xml2array/ 
     * Arguments : $contents - The XML text 
     *                $get_attributes - 1 or 0. If this is 1 the function will get the attributes as well as the tag values - this results in a different array structure in the return value.
     *                $priority - Can be 'tag' or 'attribute'. This will change the way the resulting array sturcture. For 'tag', the tags are given more importance.
     * Return: The parsed XML in an array form. Use print_r() to see the resulting array structure. 
     * Examples: $array =  xml2array(file_get_contents('feed.xml')); 
     *              $array =  xml2array(file_get_contents('feed.xml', 1, 'attribute')); 
     */ 
    function xml2array($contents, $get_attributes=1, $priority = 'tag') { 
        if(!$contents) return array(); 

        if(!function_exists('xml_parser_create')) { 
            //print "'xml_parser_create()' function not found!"; 
            return array(); 
        } 

        //Get the XML parser of PHP - PHP must have this module for the parser to work 
        $parser = xml_parser_create(''); 
        xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); # http://minutillo.com/steve/weblog/2004/6/17/php-xml-and-character-encodings-a-tale-of-sadness-rage-and-data-loss 
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0); 
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1); 
        xml_parse_into_struct($parser, trim($contents), $xml_values); 
        xml_parser_free($parser); 

        if(!$xml_values) return;//Hmm... 

        //Initializations 
        $xml_array = array(); 
        $parents = array(); 
        $opened_tags = array(); 
        $arr = array(); 

        $current = &$xml_array; //Refference 

        //Go through the tags. 
        $repeated_tag_index = array();//Multiple tags with same name will be turned into an array 
        foreach($xml_values as $data) { 
            unset($attributes,$value);//Remove existing values, or there will be trouble 

            //This command will extract these variables into the foreach scope 
            // tag(string), type(string), level(int), attributes(array). 
            extract($data);//We could use the array by itself, but this cooler. 

            $result = array(); 
            $attributes_data = array(); 
             
            if(isset($value)) { 
                if($priority == 'tag') $result = $value; 
                else $result['value'] = $value; //Put the value in a assoc array if we are in the 'Attribute' mode
            } 

            //Set the attributes too. 
            if(isset($attributes) and $get_attributes) { 
                foreach($attributes as $attr => $val) { 
                    if($priority == 'tag') $attributes_data[$attr] = $val; 
                    else $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
                } 
            } 

            //See tag status and do the needed. 
            if($type == "open") {//The starting of the tag '<tag>' 
                $parent[$level-1] = &$current; 
                if(!is_array($current) or (!in_array($tag, array_keys($current)))) { //Insert New tag 
                    $current[$tag] = $result; 
                    if($attributes_data) $current[$tag. '_attr'] = $attributes_data; 
                    $repeated_tag_index[$tag.'_'.$level] = 1; 

                    $current = &$current[$tag]; 

                } else { //There was another element with the same tag name 

                    if(isset($current[$tag][0])) {//If there is a 0th element it is already an array 
                        $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result; 
                        $repeated_tag_index[$tag.'_'.$level]++; 
                    } else {//This section will make the value an array if multiple tags with the same name appear together
                        $current[$tag] = array($current[$tag],$result);//This will combine the existing item and the new item together to make an array
                        $repeated_tag_index[$tag.'_'.$level] = 2; 
                         
                        if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well
                            $current[$tag]['0_attr'] = $current[$tag.'_attr']; 
                            unset($current[$tag.'_attr']); 
                        } 

                    } 
                    $last_item_index = $repeated_tag_index[$tag.'_'.$level]-1; 
                    $current = &$current[$tag][$last_item_index]; 
                } 

            } elseif($type == "complete") { //Tags that ends in 1 line '<tag />' 
                //See if the key is already taken. 
                if(!isset($current[$tag])) { //New Key 
                    $current[$tag] = $result; 
                    $repeated_tag_index[$tag.'_'.$level] = 1; 
                    if($priority == 'tag' and $attributes_data) $current[$tag. '_attr'] = $attributes_data;

                } else { //If taken, put all things inside a list(array) 
                    if(isset($current[$tag][0]) and is_array($current[$tag])) {//If it is already an array... 

                        // ...push the new element into that array. 
                        $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result; 
                         
                        if($priority == 'tag' and $get_attributes and $attributes_data) { 
                            $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data; 
                        } 
                        $repeated_tag_index[$tag.'_'.$level]++; 

                    } else { //If it is not an array... 
                        $current[$tag] = array($current[$tag],$result); //...Make it an array using using the existing value and the new value
                        $repeated_tag_index[$tag.'_'.$level] = 1; 
                        if($priority == 'tag' and $get_attributes) { 
                            if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well
                                 
                                $current[$tag]['0_attr'] = $current[$tag.'_attr']; 
                                unset($current[$tag.'_attr']); 
                            } 
                             
                            if($attributes_data) { 
                                $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data; 
                            } 
                        } 
                        $repeated_tag_index[$tag.'_'.$level]++; //0 and 1 index is already taken 
                    } 
                } 

            } elseif($type == 'close') { //End of tag '</tag>' 
                $current = &$parent[$level-1]; 
            } 
        } 
         
        return($xml_array); 
    }  
}
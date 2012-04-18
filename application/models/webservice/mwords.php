<?php

class MWords extends CI_Model{
 
	function MWords()
        {
            parent::__construct();
        }
 
	function getAllProductByPagination($num, $offset)
	{

		$data = array();
	    $Q = $this->db->get('products', $num, $offset);
	    if ($Q->num_rows() > 0){
	    	foreach ($Q->result_array() as $row){
	        	$data[] = $row;
	    	}
	    }
	    $Q->free_result();    
	    return $data;
	}
	
	
	function getProductByPagination($num, $offset) {

		$data = array();
		$this->db->where('status', 'active');
		$Q = $this->db->get('products', $num, $offset);
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[] = $row;
			}
		}
	    $Q->free_result();    
	    return $data;
	}
	
	
	
	
	
	function getProductsByCategoryByPagination($catid, $num, $offset) {

		$data = array();
		$this->db->where('category_id', id_clean($catid));
		$this->db->where('status', 'active');
	    $Q = $this->db->get('products', $num, $offset);
	    if ($Q->num_rows() > 0){
	    	foreach ($Q->result_array() as $row){
	        	$data[] = $row;
	    	}
	    }
	    $Q->free_result();    
	    return $data;
	}

	
 
 
	function getProduct($id){
	    $data = array();
	    $options = array('id' => id_clean($id));
	    $Q = $this->db->get_where('products',$options,1);
	    if ($Q->num_rows() > 0){
	      $data = $Q->row_array();
	    }
	
	    $Q->free_result();    
	    return $data;    
	 }
	 

         
         
	function getAllProducts()
	{
	    $data = array();

            $this->db->select('id,francais,mahorais,category_id');
	    $this->db->where('status', 'active');
	    $Q = $this->db->get('products');
	    if ($Q->num_rows() > 0)
	    {
		foreach ($Q->result_array() as $row)
		{
		    //$data[] = $row;
                    $data[] = array( 'word' => array (
		        "id" => $row['id'],
		        "francais"  => $row['francais'],
		        "mahorais"  => $row['mahorais'],
                        "parentThemeID"  =>$row['category_id']
		    ));
		}
	    }
	    $Q->free_result();    
	    return $data; 
 	}
        
 
	function getProductsByCategory($catid)
	{
    	$data = array();
    	$this->db->select('id,francais,mahorais,category_id');
    	$this->db->where('category_id', id_clean($catid));
    	$this->db->where('status', 'active');
    	$this->db->order_by('francais','asc');
	//$this->db->limit(3);
    	$Q = $this->db->get('products');

     	if ($Q->num_rows() > 0)
     	{
       		foreach ($Q->result_array() as $row)
       		{
        		//$data[] = $row;
			$data[] = array (
		        "id" => intval($row['id']),
		        "fr"  => $row['francais'],
		        "ma"  => $row['mahorais'],
                        "p_id"  => intval($row['category_id'])
		    );
       		}
    	}
	    $Q->free_result();
	    return $data; 
	} 
 

	function getMainFeature()
	{
    	$data = array();
    	$this->db->select("id,francais,mahorais");
     	$this->db->where('status', 'active');
     	$this->db->order_by("rand()"); 
     	$this->db->limit(1);
     	$Q = $this->db->get('products');
     	
     	if ($Q->num_rows() > 0)
     	{
	       	foreach ($Q->result_array() as $row)
	       	{
		        $data = array (
		         	"id"        => $row['id'],
		         	"francais"  => $row['francais'],
		        	"mahorais"  => $row['mahorais']
                                
		         );
	       	}
    	}
    
    $Q->free_result();    
    return $data;  
 
}

	function getProductsByGroup($skip)
	{
   		$data = array();

     	$this->db->select('id,francais,mahorais');
     	$this->db->where('id', id_clean($skip));
     	$this->db->where('status', 'active');
     	$this->db->order_by('francais','asc');
     	$this->db->limit(1);
     	$Q = $this->db->get('products');
     	
	    if ($Q->num_rows() > 0)
     	{
	       	foreach ($Q->result_array() as $row)
	       	{
		        $data = array (
		         	"id" => $row['id'],
		         	"francais" => $row['francais'],
		        	"mahorais" => $row['mahorais']
		         );
	       	}
    	}
    	$Q->free_result(); 
    	return $data; 
} 
 
 
	function getRandomProducts($limit)
	{	
		$data = array();
		$temp = array();
		
		if ($limit == 0)
		{
			$limit=3;
		}
		
		$this->db->select("id,francais,mahorais,category_id");

		//$this->db->where('id');
		//$this->db->where('id !=', id_clean($skip));
		$this->db->order_by("rand()");
		//$this->db->order_by("category_id","asc");
		$this->db->limit(100);
		$Q = $this->db->get('products');

		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{	
		         $temp[$row['category_id']] = array(
		         	"id" => $row['id'],
		         	"francais" => $row['francais'],
		         	"mahorais" => $row['mahorais']
		         );
			}
		}
	
		shuffle($temp);
		
		if (count($temp))
		{
			for ($i=1;$i<=$limit; $i++)
			{
				$data[] = array_shift($temp);
			}
		}
		$Q->free_result();
		return $data;
	}


	
		
	function search($term)
	{
		$data = array();
		$this->db->select('id,francais,mahorais,example,status');
		$this->db->like('francais',db_clean($term));
		$this->db->or_like('mahorais',db_clean($term));
		$this->db->or_like('id',db_clean($term));
	    $this->db->order_by('francais','asc');
	    //$this->db->where('status','active');
	    $this->db->limit(50);
	    $Q = $this->db->get('products');
	    if ($Q->num_rows() > 0){
	       foreach ($Q->result_array() as $row){
	         $data[] = $row;
	       }
	    }
	    $Q->free_result();    
	    return $data;
	}
 

 function addProduct(){
	$data = array( 
		'francais' => db_clean($_POST['francais']),
		'mahorais' => db_clean($_POST['mahorais']),
		'example' => db_clean($_POST['example'],5000),
		'status' => db_clean($_POST['status'],8),
		'category_id' => id_clean($_POST['category_id'])
	);

	if ($_FILES){
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '200';
		$config['remove_spaces'] = true;
		$config['overwrite'] = false;
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);	
	
		if (strlen($_FILES['image']['name'])){
			if(!$this->upload->do_upload('image')){
				$this->upload->display_errors();
				exit();
			}
			$image = $this->upload->data();
		
			if ($image['file_name']){
				$data['image'] = "/images/".$image['file_name'];
		
			}
		}
		
		
		if (strlen($_FILES['thumbnail']['name'])){
			if(!$this->upload->do_upload('thumbnail')){
				$this->upload->display_errors();
				exit();
			}
			$thumb = $this->upload->data();
	
			if ($thumb['file_name']){
				$data['thumbnail'] = "/images/".$thumb['file_name'];
		
			}
		}
	}
	$this->db->insert('products', $data);
 }
 
 
 function updateProduct(){
	$data = array( 
		'francais' => db_clean($_POST['francais']),
		'mahorais' => db_clean($_POST['mahorais']),
		'example' => db_clean($_POST['example'],5000),
		'status' => db_clean($_POST['status'],8),
		'category_id' => id_clean($_POST['category_id'])
	);
	if ($_FILES){
		
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '200';
		$config['remove_spaces'] = true;
		$config['overwrite'] = false;
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);	
	
	    if (strlen($_FILES['image']['name'])){
			if(!$this->upload->do_upload('image')){
				$this->upload->display_errors();
				exit();
			}
			$image = $this->upload->data();
		
			if ($image['file_name']){
				$data['image'] = "/images/".$image['file_name'];
		
			}
		}
		
		if (strlen($_FILES['thumbnail']['name'])){
			if(!$this->upload->do_upload('thumbnail')){
				$this->upload->display_errors();
				exit();
			}
			$thumb = $this->upload->data();
		
			if ($thumb['file_name']){
				$data['thumbnail'] = "/images/".$thumb['file_name'];
		
			}
		}
	}
 	$this->db->where('id', $_POST['id']);
	$this->db->update('products', $data);	
 	

 }
 
 
 function deleteProduct($id){
 	$data = array('status' => 'inactive');
 	$this->db->where('id', id_clean($id));
	$this->db->update('products', $data);	
 }
	
	
  function batchUpdate(){
  	var_dump($this->input->post('p_id'));
  	
  	if (count($this->input->post('p_id'))){
  		$data = array('category_id' => id_clean($this->input->post('category_id')),
  					'grouping' => db_clean($this->input->post('grouping'))
  					);
  		$idlist = implode(",",array_values($this->input->post('p_id')));
		$where = "id in ($idlist)";
  		$this->db->where($where);
  		$this->db->update('products',$data);
  		$this->session->set_flashdata('message', 'Products updated');
  	}else{
    	$this->session->set_flashdata('message', 'Nothing to update!');
	} 
  
  }

 function exportCsv(){
 	$this->load->dbutil();
 	$Q = $this->db->query("select * from products");
 	return $this->dbutil->csv_from_result($Q,",","\n");
 }
 
 	function importCsv()
 	{
 	
		$config['upload_path'] = './csv/';
		$config['allowed_types'] = 'csv';
		$config['max_size'] = '2000';
		$config['remove_spaces'] = true;
		$config['overwrite'] = true;
		$this->load->library('upload', $config);
	  	$this->load->library('CSVReader');
	  
	  	var_dump($this->upload->do_upload('csvfile'));
	  	
		if(!$this->upload->do_upload('csvfile'))
		{
			
			$this->upload->display_errors();
			exit();
			
		}
		$csv = $this->upload->data();
		$path = $csv['full_path'];
		
		return $this->csvreader->parseFile($path);
	}
 
 function csv2db(){
 	unset($_POST['submit']);
 	unset($_POST['csvgo']);
 	
 	foreach ($_POST as $line => $data){
 		if (isset($data['id'])){
 			$this->db->where('id',$data['id']);
 			unset($data['id']);
 			$this->db->update('products',$data);	
 		}else{
 			$this->db->insert('products',$data);
 		}
 	}
 }
 
 
 function reassignProducts(){
 	$data = array('category_id' => $this->input->post('categories'));
	$idlist = implode(",",array_keys($this->session->userdata('orphans')));
	$where = "id in ($idlist)";
 	$this->db->where($where);
 	$this->db->update('products',$data);
 } 
 
 
 function getAssignedColors($id){
 	$data = array();
 	$this->db->select('color_id');
 	$this->db->where('product_id',id_clean($id));
 	$Q = $this->db->get('products_colors');
    if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row['color_id'];
       }
    }
    $Q->free_result();    
    return $data; 	
 }
 
 
 function getAssignedSizes($id){
 	$data = array();
 	$this->db->select('size_id');
 	$this->db->where('product_id',id_clean($id));
 	$Q = $this->db->get('products_sizes');
    if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row['size_id'];
       }
    }
    $Q->free_result();    
    return $data; 	
 } 
}//end class
?>
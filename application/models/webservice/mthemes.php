<?php

class MThemes extends CI_Model{

	function MThemes(){
		parent::__construct();
	}


    function getCategory($id)
    {
        $data = array();
        $options = array('id' =>id_clean($id));
        $Q = $this->db->get_where('categories',$options,1);
        if ($Q->num_rows() > 0){
          $data = $Q->row_array();
        }
    
        $Q->free_result();    
        return $data;
     }
     
     
        function getAllCategories(){
            $data = array();
            $this->db->select('id,name, parentid');
	    
            $Q = $this->db->get('categories');
	    
            if ($Q->num_rows() > 0){
              foreach ($Q->result_array() as $row){
                
                    //$data[] = $row;
		if($row['parentid'])
		{
			$data[] = array( 'theme' => array(
			'id' => intval($row['id']),
			'name' => $row['name'],
			'words' => $this->MWords->getProductsByCategory($row['id'])
		    ));
		}

              }
           }
           $Q->free_result();  
           return $data; 
        }

    
    
    

	function getSubCategoriesByPagination($catid, $num, $offset)
	{
		$data = array();
		$this->db->select('id,name,description');
	    $this->db->where('parentid', id_clean($catid));
	    $this->db->where('status', 'active');
	    $this->db->order_by('name','asc');
	    $Q = $this->db->get('categories', $num, $offset);
	    if ($Q->num_rows() > 0){
	      foreach ($Q->result_array() as $row){
	       		$data[] = array(
	       			'id' => $row['id'], 
	       			'name' => $row['name'], 
	       			'description' => $row['description']
	       		);
	      	}
	    }
	    $Q->free_result();
	    return $data;
	}
	 
 
 
 
 
 function getSubCategories($catid){
     $data = array();
     $this->db->select('id,name,description');
     $this->db->where('parentid', id_clean($catid));
     $this->db->where('status', 'active');
     $this->db->order_by('name','asc');
     $Q = $this->db->get('categories');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){

       		$data[] = array(
       			'id' => $row['id'], 
       			'name' => $row['name'], 
       			'description' => $row['description']
       		);
       	}
    }
    $Q->free_result();  
    
    return $data;
 }

 
 
 
 
 

	function getCategoriesNav()
	{
		$data = array();
    	$this->db->select('id,name,parentid');
     	$this->db->where('status', 'active');
     	$this->db->order_by('id','asc');
     	$this->db->order_by('name','asc');
     	$this->db->group_by('parentid,id');
     	$Q = $this->db->get('categories');
     	if ($Q->num_rows() > 0){
	       	foreach ($Q->result() as $row){
				if ($row->parentid > 0){
					$data[0][$row->parentid]['children'][$row->id] = $row->name;
				}
				else
				{
					$data[0][$row->id]['name'] = $row->name;
				}
			}
    	}
    	
    	$Q->free_result(); 
    	return $data; 
	}



 function getCategoriesDropDown(){
     $data = array();
     $this->db->select('id,name');
     $this->db->where('parentid !=',0);
     $Q = $this->db->get('categories');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data; 
 }

	
 function getTopCategories(){
     $data[0] = 'root';
     $this->db->where('parentid',0);
     $Q = $this->db->get('categories');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data; 
 }	


	
 function addCategory(){
	$data = array( 
		'name' => db_clean($_POST['name']),
		'description' =>  db_clean($_POST['description'],5000),
		'status' =>  db_clean($_POST['status'],8),
		'parentid' => id_clean($_POST['parentid'])
	
	);

	$this->db->insert('categories', $data);	 
 }
 
 function updateCategory(){
	$data = array( 
		'name' =>  db_clean($_POST['name']),
		'description' =>  db_clean($_POST['description'],5000),
		'status' =>  db_clean($_POST['status'],8),
		'parentid' =>  id_clean($_POST['parentid'])
	
	);

 	$this->db->where('id', id_clean($_POST['id']));
	$this->db->update('categories', $data);	
 
 }
 
 function deleteCategory($id){
 	$data = array('status' => 'inactive');
 	$this->db->where('id', id_clean($id));
	$this->db->update('categories', $data);	
 }
 
 function exportCsv(){
 	$this->load->dbutil();
 	$Q = $this->db->query("select * from categories");
 	return $this->dbutil->csv_from_result($Q,",","\n");
 }
 
 
 function checkOrphans($id){
 	$data = array();
 	$this->db->select('id,francais');
 	$this->db->where('category_id',id_clean($id));
 	$Q = $this->db->get('products');
    if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['francais'];
       }
    }
    $Q->free_result();  
    return $data;  	
 
 }
 

	
}

?>
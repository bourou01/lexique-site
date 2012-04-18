<?php

class MOrders extends CI_Model {
	
	function MOrders()
	{
    	parent::__construct();
 	}
 	
 	
 	public function addCartInProfile($userId, $productId)
 	{
 		// on verifie si a existe
 		$query = $this->db->get_where('user_profiles', array('user_id' => $userId, 'product_id' => $productId));
		
 		if (!count($query->row(0)))
 		{
	 		$data = array(
	 				'id' => 0,
	               	'user_id' => $userId,
	               	'product_id' => $productId
	         		);
	
			$result = $this->db->insert('user_profiles', $data); 
	
			if ($result)
			{
				// added
				$this->session->set_flashdata('message', 'Ajoute');			
				return true;
			}
			else
			{
				// error
				$this->session->set_flashdata('message', 'Erreur');
				return false;
			}
 		}
 		else
 		{
 			// existe deja
 			$this->session->set_flashdata('message', 'Existe deja');
 			return false;
 		}

 	}
 	
 	public function getCartFromProfile($id)
 	{
 		$data = array();
    	$this->db->select('product_id');
    	$this->db->where('user_id', id_clean($id));
    	//$this->db->order_by('product_id','asc');
    	$Q = $this->db->get('user_profiles');

     	if ($Q->num_rows() > 0)
     	{
       		foreach ($Q->result_array() as $row)
       		{
        		$data[] = $this->MProducts->getProduct($row['product_id']);
       		}
    	}
	    $Q->free_result();
 		return $data;
 	}
 	
 	public function getCartFromProfileByPagination($id, $num, $offset)
 	{
 		$data = array();
    	$this->db->select('product_id');
    	$this->db->where('user_id', id_clean($id));
    	//$this->db->order_by('product_id','asc');
    	$Q = $this->db->get('user_profiles', $num, $offset);

     	if ($Q->num_rows() > 0)
     	{
       		foreach ($Q->result_array() as $row)
       		{
        		$data[] = $this->MProducts->getProduct($row['product_id']);
       		}
    	}
	    $Q->free_result();
 		return $data;
 	}
 	
 	
 	
 	
 	
 	
 	
 	

 	public function removeCartFromProfile($userId, $productId)
 	{
 		
 		// un peu plus de sŽcuritŽ quand mme;

 		$this->db->delete('user_profiles', array(
 								'user_id' => $userId, 
 								'product_id' =>$productId
 		)); 


 	}
 	
 	
 	
 	
 	
	function updateCart($productid,$fullproduct){

		$this->session->set_flashdata('conf_msg', "We've added this product to your cart."); 

}




 
}//end class
?>
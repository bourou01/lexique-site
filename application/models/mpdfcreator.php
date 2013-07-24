<?php

class MPdfCreator extends CI_Model {

	function MPdfCreator()
        {
	    parent::__construct();
	}

        
        function downloadCat($cat_id)
	{
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		
		prep_pdf(); // creates the footer for the document we are creating.
 
                $db_data = $this->MProducts->getProductsByCategory($cat_id);
		$cathegory_name = $this->MCats->getCategory($cat_id);

		
		setlocale(LC_CTYPE, 'fr_FR.UTF-8');

		$cathegory_name['name'] = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $cathegory_name['name']);
		
		$pdf_data = array();
		
		foreach ($db_data as $row)
		{
			$pdf_data[]=array(
					  'francais' => iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['francais']),
					  'mahorais' => iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['mahorais'])
					  );
		}
		

	
		$col_names = array(
			'francais' => 'Francais',
			'mahorais' => 'Mahorais'
			
		);
		
		//$this->cezpdf->ezTable($db_data, $col_names, 'Contact List', array('width'=>550));
		
		$warning = "Des mise a jour sont faites regulierement, n'oubliez pas de telecharger les nouvelles versions.";
		
		$this->cezpdf->addText(50,800,8,$warning,0,10);
		
		$this->cezpdf->Rectangle(43,795,500,18);
		
		$this->cezpdf->ezTable($pdf_data,$col_names,'Parlons Mahorais - '.$cathegory_name['name'], array(
						'width'=>500,
						'col_names'=>array(
							'francais'=>array('width'=>225, 'justification'=>'left')
							,'mahorais'=>array('width'=>225, 'justification'=>'left'))
			));
		 
		 
		
		$this->cezpdf->ezStream();
	}

	
}

?>
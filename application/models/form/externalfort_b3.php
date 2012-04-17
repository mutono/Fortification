<?php 
/*model to handle ExternaFort_B3 form data*/
class ExternalFort_B3 extends CI_Model{
	//the variables 
	var $inspection_registry_no='';
	var $inspection_date='';
	var $factory_name=''; #reversed back to an id in the db
	var $factory_rep=''; #reversed back to an id in the db
	var $address=''; #of the factory?
	var $telephone=''; #of the factory?
	var $areas_visited=''; #string off all the checkbox values
	var $compliances_list='';
	var $suggestions='';
	var $health_officer=''; #reversed back to an id in the db
	var $factory_reps=''; #factory representative who receives the compounds?
	var $ho_signature=''; #health officer signature
	var $ro_signature=''; #factory representative officer signature
	var $ro_signature_date=''; #factory representative officer signature date
	var $ho_signature_date=''; #date ho signed
	var $supervisor_name=''; #name of supervisor to the health officer
	var $s_signature_date=''; #date supervisor signed the form
	var $query_response=''; #response after query execution
	
	function __construct()
    {
        // The user defined Model constructor
        parent::__construct();
		$this->load->helper('array');
    }
	
	 function get_all_records()
    {
        $query = $this->db->get('externalfortifiedb3');
        return $query->result();
    }
	
	//function submits a new record to the db
	function insert_record()
	{
		//receive the form data as posted and sanitize before sending to the db
		$this->$inspection_registry_no=$this->input->post('inspection_registry');
		$this->$inspection_date=$this->input->post('inspections_date');
		$this->$factory_name=$this->input->post('factory_name');
		$this->$factory_rep=$this->input->post('factory_rep');
		$this->$address=$this->input->post('address');
		$this->$telephone=$this->input->post('telephone');
		$this->$areas_visited=$this->input->post('areas_visited');
		$this->$compliances_list=$this->input->post('compliances_list');
		$this->$suggestions=$this->input->post('suggestions');
		$this->$health_officer=$this->input->post('health_officer');
		$this->$factory_reps=$this->input->post('factory_reps');
		$this->$ro_signature_date=$this->input->post('roSignature');
		$this->$ho_signature=$this->input->post('ho_signature');
		$this->$ho_signature_date=$this->input->post('ho_signature_date');
		$this->$supervisor_name=$this->input->post('supervisor_name');
		$this->$s_signature_date=$this->input->post('s_signature_date');
		
		//execute the sql
		 $query=$this->db->query($this->db->insert('externalfortifiedb3', $this)); 
		 
		 //provide feedback
		 if($this->$query)
		 {
			$this->$query_response='ok';
		 }
		 else
		 {
			 $this->$query_response='fail';
		 }
         return $this->query_response;
	     
		 
       } //end of insert_record()

      //other functions shall follow here

}     // end of the class definition
?>
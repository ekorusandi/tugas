<?php
class Products_model extends CI_Model {

    var $ProductName  = '';
    var $SupplierID = '';
    

    function __construct()
    {        
        parent::__construct();
    }
    //fungsi yang mengambil data dari database, dihubungkan di controller products
    function get_products($a,$b)
	{
		$this->db->order_by('ProductName', 'ASC');
		$data = $this->db->get('products', $a,$b);
		return $data->result();
	}
    function get_products_by_id($id)
    {
        $this->db->where('ProductID',$id);
        $query = $this->db->get('products');
        return $query->row();
    }
	
	

    function insert_entry()
    {
        $this->ProductName  = $this->input->post('ProductName',true); 
		$this->SupplierID  = $this->input->post('SupplierID',true);        
        return $this->db->insert('products', $this);
    }

    function update_entry()
    {
        $this->ProductName  = $this->input->post('ProductName',true); 
        $this->SupplierID   = $this->input->post('SupplierID',true);         
        return $this->db->update('products', $this, array('ProductID' => $this->input->post('id',true)));
    }

    function hapus($id)
    {
        $this->db->where('ProductID',$id);
        return $this->db->delete('products');
    }

    function cek_dependensi($id)
    {
        $this->db->where('ProductID',$id);
        $query = $this->db->count_all('products');
        return ($query==0) ? true : false;
    }
}
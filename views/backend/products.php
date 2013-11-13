<<<<<<< HEAD
			<h1><?=$title;?></h1>

			<!-- Table (TABLE) -->
			<br />
			<?php
			   echo anchor(site_url('backend/products/form/insert/'),'Add',' class="input-submit"');	
			?>
			<br />
			<table>
				<tr>
					<th>No</th>
					<th>Actions</th>					    
				    <th>Products Name</th>
				    <th>Supplier ID</th>
					<th>Category ID</th>
					<th>QuantityPerUnit</th>
					<th>UnitPrice</th>
					<th>UnitsInStock</th>
					<th>UnitsOnOrder</th>
					<th>ReorderLevel</th>
					<th>Discontinued</th>
					
				</tr>
				<?php
					//$no=0;
					foreach($array_product as $row):	
					$id=$row->ProductID;	
					$no++;	
					$css=($no%2==1)? '' : 'class="bg"';
				?>
				<tr <?=$css;?> >
					<td><?=$no;?>.</td>
				    <td><?=anchor(site_url('backend/products/process/delete/'.$id),'[delete]').' | '.
				    	   anchor(site_url('backend/products/form/update/'.$id),'[update]');?></td>				    
				    <td><?=$row->ProductName;?></td>
				    <td><?=$row->SupplierID;?></td>
					<td><?=$row->CategoryID;?></td>
					<td><?=$row->QuantityPerUnit;?></td>
					<td><?=$row->UnitPrice;?></td>
					<td><?=$row->UnitsInStock;?></td>
					<td><?=$row->UnitsOnOrder;?></td>
					<td><?=$row->ReorderLevel;?></td>
					<td><?=$row->Discontinued;?></td>
										
				</tr>
								<?php  endforeach; ?>
				</table>
				<!--Menampilkan Paging-->
				<div class="halaman">Halaman : <?php echo $halaman;?></div>
		
=======
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct()
    {	
        parent::__construct();   
        $this->load->model('Products_model','datamodel');
		$this->load->helper('Url');
		$this->load->library('Pagination');//load library
    }
	   
	public function index($id='')
	{
		$data['title']='List Of Products';	
		$jml = $this->db->get('products');
		//pengaturan pagination
		$config['base_url'] = base_url().'backend/products/index';//alamat dimana terdapat pagination
		$config['total_rows'] = $jml->num_rows();//jumlah row data
		$config['per_page'] = 7;//jumlah data yang ditampilkan perhalaman
		$config['last_link'] = 'Akhir';
		$config['first_link'] = 'Awal';
		$config['uri_segment'] = 4;
		//inisialisasi config
			$this->pagination->initialize($config);	 
		//membuat pagination
			$data['halaman'] = $this->pagination->create_links();
		//membuat nomor
		  $data['no'] = $id;
		//tamplikan data
			$data['array_product'] = $this->datamodel->get_products($config['per_page'], $id);
			$this->mytemplate->loadBackend('products',$data);
		
		 
}

	public function form($mode,$id='')
	{
		$data['title']=($mode=='insert')? 'Add Products' : 'Update Products';				
		$data['products'] = ($mode=='update') ? $this->datamodel->get_products_by_id($id) : '';
		$this->mytemplate->loadBackend('frmproducts',$data);	
	}

	public function process($mode,$id='')
	{
		
		if(($mode=='insert') || ($mode=='update'))
		{
			$result = ($mode=='insert') ? $this->datamodel->insert_entry() : $this->datamodel->update_entry();
		}else if($mode=='delete'){
			$result = $this->datamodel->hapus($id);			
		}	
		if ($result) redirect(site_url('backend/products'),'location');
	}
	
	private function dependensi($id)
	{
		return $this->datamodel->cek_dependensi($id);
	}
	
	

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

>>>>>>> 4821dad9a3d94f235c23af0b61d92ae44ea91579

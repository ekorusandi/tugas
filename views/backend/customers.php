<<<<<<< HEAD
			<h1><?=$title;?></h1>

			<!-- Table (TABLE) -->
			<br />
			<?php
			   echo anchor(site_url('backend/customers/form/insert/'),'Add',' class="input-submit"');	
			?>
			<br />
			<table>
				<tr>
					<th>No</th>
					<th>Actions</th>					    
				    <th>Company Name</th>
				    <th>Contact Name</th>				   				   
				</tr>
				<?php
					$no=0;
					foreach($array_customers as $row):	
					$id=$row->CustomerID;	
					$no++;	
					$css=($no%2==1)? '' : 'class="bg"';
				?>
				<tr <?=$css;?> >
					<td><?=$no;?>.</td>
				    <td><?=anchor(site_url('backend/customers/process/delete/'.$id),'[delete]').' | '.
				    	   anchor(site_url('backend/customers/form/update/'.$id),'[update]');?></td>				    
				    <td><?=$row->CompanyName;?></td>
				    <td><?=$row->ContactName;?></td>				    
				</tr>
				<?php  endforeach; ?>
			</table>

		
=======
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends CI_Controller {

	public function __construct()
    {
        parent::__construct();   
        $this->load->model('Customers_model','datamodel');     
    }
	   
	public function index()
	{
		$data['title']='List Of Customers';	
		$data['array_customers'] = $this->datamodel->get_customers();
		$this->mytemplate->loadBackend('customers',$data);
	}

	public function form($mode,$id='')
	{
		$data['title']=($mode=='insert')? 'Add Customers' : 'Update Customers';				
		$data['customers'] = ($mode=='update') ? $this->datamodel->get_customers_by_id($id) : '';
		$this->mytemplate->loadBackend('frmcustomers',$data);	
	}

	public function process($mode,$id='')
	{
		
		if(($mode=='insert') || ($mode=='update'))
		{
			$result = ($mode=='insert') ? $this->datamodel->insert_entry() : $this->datamodel->update_entry();
		}else if($mode=='delete'){
			$result = $this->datamodel->hapus($id);			
		}	
		if ($result) redirect(site_url('backend/customers'),'location');
	}
	
	private function dependensi($id)
	{
		return $this->datamodel->cek_dependensi($id);
	}
	
	

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

>>>>>>> 4821dad9a3d94f235c23af0b61d92ae44ea91579

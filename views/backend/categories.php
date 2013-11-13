<<<<<<< HEAD
			<h1><?=$title;?></h1>

			<!-- Table (TABLE) -->
			<br />
			<?php
			   echo anchor(site_url('backend/categories/form/insert/'),'Add',' class="input-submit"');	
			?>
			<br />
			<table>
				<tr>
					<th>No</th>
					<th>Actions</th>					    
				    <th>Categories Name</th>
				    <th>Description</th>				   				   
				</tr>
				<?php
					$no=0;
					foreach($array_categories as $row):	
					$id=$row->CategoryID;	
					$no++;	
					$css=($no%2==1)? '' : 'class="bg"';
				?>
				<tr <?=$css;?> >
					<td><?=$no;?>.</td>
				    <td><?=anchor(site_url('backend/categories/process/delete/'.$id),'[delete]').' | '.
				    	   anchor(site_url('backend/categories/form/update/'.$id),'[update]');?></td>				    
				    <td><?=$row->CategoryName;?></td>
				    <td><?=$row->Description;?></td>				    
				</tr>
				<?php  endforeach; ?>
			</table>

		
=======
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function __construct()
    {
        parent::__construct();   
        $this->load->model('Categories_model','datamodel');     
    }
	   
	public function index()
	{
		$data['title']='List Of Categories';	
		$data['array_categories'] = $this->datamodel->get_categories();
		$this->mytemplate->loadBackend('categories',$data);
	}

	public function form($mode,$id='')
	{
		$data['title']=($mode=='insert')? 'Add Categories' : 'Update Categories';				
		$data['categories'] = ($mode=='update') ? $this->datamodel->get_categories_by_id($id) : '';
		$this->mytemplate->loadBackend('frmcategories',$data);	
	}

	public function process($mode,$id='')
	{
		
		if(($mode=='insert') || ($mode=='update'))
		{
			$result = ($mode=='insert') ? $this->datamodel->insert_entry() : $this->datamodel->update_entry();
		}else if($mode=='delete'){
			$result = $this->datamodel->hapus($id);			
		}	
		if ($result) redirect(site_url('backend/categories'),'location');
	}
	
	private function dependensi($id)
	{
		return $this->datamodel->cek_dependensi($id);
	}
	
	

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

>>>>>>> 4821dad9a3d94f235c23af0b61d92ae44ea91579

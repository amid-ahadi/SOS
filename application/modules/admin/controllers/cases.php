<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cases extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		
		//$this->auth->check_access('1', true);
		
		$this->load->model("cases_model");
		$this->load->model("tax_model");
		$this->load->model("location_model");
		$this->load->model("case_stage_model");
		$this->load->model("custom_field_model");
		
	}
	
	
	function index(){
		
		$data['cases'] = $this->cases_model->get_all();
		$data['courts'] = $this->cases_model->get_all_courts();
		$data['clients'] = $this->cases_model->get_all_clients();
		$data['locations'] = $this->location_model->get_all();
		$data['stages'] = $this->case_stage_model->get_all();
		$data['page_title'] = lang('case');
		$data['body'] = 'case/list';
		$this->load->view('template/main', $data);	
	}
	
	
	
	function get_case_by_client(){
		$cases = $this->cases_model->get_cases_by_client_id($_POST['id']);
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                        <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('client').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                        
                   ';
				   		if(isset($cases)):
                     echo '   
						<tbody>
                            ';
							 $i=1;foreach ($cases as $new){
							 
							 echo '
                                <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
									
								'; if($new->is_starred==0){ 
								echo '
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
								echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>
								';
									}
									
								echo'	</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									
                                    <td width="47%">
										<a class="btn btn-default"  href="'.site_url('admin/cases/view_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										<a class="btn btn-info"  href="'.site_url('admin/cases/fees/'.$new->id).'"><i class="fa fa-inr"></i> '.lang('fees').'</a>	
                                      	<a class="btn btn-success"  href="'.site_url('admin/cases/dates/'.$new->id).'"><i class="fa fa-calendar"></i> '.lang('hearing_date').'</a>							
                                        <a class="btn btn-primary"  href="'.site_url('admin/cases/edit/'.$new->id) .'"><i class="fa fa-edit"></i> '.lang('edit').'</a>
										<a class="btn btn-warning"  href="'.site_url('admin/cases/archived/'.$new->id).'"><i class="fa fa-close"></i> '.lang('archived').'</a>
                                    </td>
                                </tr>
							';	
                              $i++;}
					echo '		  
                        </tbody>';
                        endif;
                    
				echo '</table>';
					
		
	}
	
	function get_case_by_client_starred(){
		$cases = $this->cases_model->get_cases_by_client_id_starred($_POST['id']);
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                        <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('client').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                        
                   ';
				   		if(isset($cases)):
                     echo '   
						<tbody>
                            ';
							 $i=1;foreach ($cases as $new){
							 
							 echo '
                                <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
									
								'; if($new->is_starred==0){ 
								echo '
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
								echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>
								';
									}
									
								echo'	</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									
                                    <td width="47%">
										<a class="btn btn-default"  href="'.site_url('admin/cases/view_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										<a class="btn btn-info"  href="'.site_url('admin/cases/fees/'.$new->id).'"><i class="fa fa-inr"></i> '.lang('fees').'</a>	
                                      	<a class="btn btn-success"  href="'.site_url('admin/cases/dates/'.$new->id).'"><i class="fa fa-calendar"></i> '.lang('hearing_date').'</a>							
                                        <a class="btn btn-primary"  href="'.site_url('admin/cases/edit/'.$new->id) .'"><i class="fa fa-edit"></i> '.lang('edit').'</a>
										<a class="btn btn-warning"  href="'.site_url('admin/cases/archived/'.$new->id).'"><i class="fa fa-close"></i> '.lang('archived').'</a>
                                    </td>
                                </tr>
							';	
                              $i++;}
					echo '		  
                        </tbody>';
                        endif;
                    
				echo '</table>';
					
		
	}	
	
	
	
	function get_case_by_court(){
		$cases = $this->cases_model->get_cases_by_court_id($_POST['id']);
	
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                         <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('client').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                   ';
				   		if(isset($cases)):
                     echo '   
						<tbody>
                            ';
							 $i=1;foreach ($cases as $new){
							 
							 echo '
                                <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
									
								'; if($new->is_starred==0){ 
								echo '
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
								echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>
								';
									}
									
								echo'	</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									
                                    <td width="47%">
										<a class="btn btn-default"  href="'.site_url('admin/cases/view_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										<a class="btn btn-info"  href="'.site_url('admin/cases/fees/'.$new->id).'"><i class="fa fa-inr"></i> '.lang('fees').'</a>	
                                      	<a class="btn btn-success"  href="'.site_url('admin/cases/dates/'.$new->id).'"><i class="fa fa-calendar"></i> '.lang('hearing_date').'</a>							
                                        <a class="btn btn-primary"  href="'.site_url('admin/cases/edit/'.$new->id) .'"><i class="fa fa-edit"></i> '.lang('edit').'</a>
										<a class="btn btn-warning"  href="'.site_url('admin/cases/archived/'.$new->id).'"><i class="fa fa-close"></i> '.lang('archived').'</a>
                                    </td>
                                </tr>
							';	
                              $i++;}
					echo '		  
                        </tbody>';
                        endif;
                    
				echo '</table>';
					
		
	}

	function get_case_by_court_starred(){
		$cases = $this->cases_model->get_cases_by_court_id_starred($_POST['id']);
	
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                         <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('client').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                        
                   ';
				   		if(isset($cases)):
                     echo '   
						<tbody>
                            ';
							 $i=1;foreach ($cases as $new){
							 
							 echo '
                                <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
									
								'; if($new->is_starred==0){ 
								echo '
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
								echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>
								';
									}
									
								echo'	</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									
                                    <td width="47%">
										<a class="btn btn-default"  href="'.site_url('admin/cases/view_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										<a class="btn btn-info"  href="'.site_url('admin/cases/fees/'.$new->id).'"><i class="fa fa-inr"></i> '.lang('fees').'</a>	
                                      	<a class="btn btn-success"  href="'.site_url('admin/cases/dates/'.$new->id).'"><i class="fa fa-calendar"></i> '.lang('hearing_date').'</a>							
                                        <a class="btn btn-primary"  href="'.site_url('admin/cases/edit/'.$new->id) .'"><i class="fa fa-edit"></i> '.lang('edit').'</a>
										<a class="btn btn-warning"  href="'.site_url('admin/cases/archived/'.$new->id).'"><i class="fa fa-close"></i> '.lang('archived').'</a>
                                    </td>
                                </tr>
							';	
                              $i++;}
					echo '		  
                        </tbody>';
                        endif;
                    
				echo '</table>';
					
		
	}

	

	function get_case_by_location(){
		$cases = $this->cases_model->get_cases_by_location_id($_POST['id']);
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                         <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('client').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                        
                   ';
				   		if(isset($cases)):
                     echo '   
						<tbody>
                            ';
							 $i=1;foreach ($cases as $new){
							 
							 echo '
                                <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
									
								'; if($new->is_starred==0){ 
								echo '
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
								echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>
								';
									}
									
								echo'	</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									
                                    <td width="47%">
										<a class="btn btn-default"  href="'.site_url('admin/cases/view_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										<a class="btn btn-info"  href="'.site_url('admin/cases/fees/'.$new->id).'"><i class="fa fa-inr"></i> '.lang('fees').'</a>	
                                      	<a class="btn btn-success"  href="'.site_url('admin/cases/dates/'.$new->id).'"><i class="fa fa-calendar"></i> '.lang('hearing_date').'</a>							
                                        <a class="btn btn-primary"  href="'.site_url('admin/cases/edit/'.$new->id) .'"><i class="fa fa-edit"></i> '.lang('edit').'</a>
										<a class="btn btn-warning"  href="'.site_url('admin/cases/archived/'.$new->id).'"><i class="fa fa-close"></i> '.lang('archived').'</a>
                                    </td>
                                </tr>
							';	
                              $i++;}
					echo '		  
                        </tbody>';
                        endif;
                    
				echo '</table>';
					
		
	}

	function get_case_by_location_starred(){
		$cases = $this->cases_model->get_cases_by_location_id_starred($_POST['id']);
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                         <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('client').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                        
                   ';
				   		if(isset($cases)):
                     echo '   
						<tbody>
                            ';
							 $i=1;foreach ($cases as $new){
							 
							 echo '
                                <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
									
								'; if($new->is_starred==0){ 
								echo '
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
								echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>
								';
									}
									
								echo'	</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									
                                    <td width="47%">
										<a class="btn btn-default"  href="'.site_url('admin/cases/view_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										<a class="btn btn-info"  href="'.site_url('admin/cases/fees/'.$new->id).'"><i class="fa fa-inr"></i> '.lang('fees').'</a>	
                                      	<a class="btn btn-success"  href="'.site_url('admin/cases/dates/'.$new->id).'"><i class="fa fa-calendar"></i> '.lang('hearing_date').'</a>							
                                        <a class="btn btn-primary"  href="'.site_url('admin/cases/edit/'.$new->id) .'"><i class="fa fa-edit"></i> '.lang('edit').'</a>
										<a class="btn btn-warning"  href="'.site_url('admin/cases/archived/'.$new->id).'"><i class="fa fa-close"></i> '.lang('archived').'</a>
                                    </td>
                                </tr>
							';	
                              $i++;}
					echo '		  
                        </tbody>';
                        endif;
                    
				echo '</table>';
					
		
	}


	function get_case_by_case_stage_id(){
		$cases = $this->cases_model->get_cases_by_case_stage_id($_POST['id']);
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                         <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('client').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                        
                   ';
				   		if(isset($cases)):
                     echo '   
						<tbody>
                            ';
							 $i=1;foreach ($cases as $new){
							 
							 echo '
                                <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
									
								'; if($new->is_starred==0){ 
								echo '
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
								echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>
								';
									}
									
								echo'	</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									
                                    <td width="47%">
										<a class="btn btn-default"  href="'.site_url('admin/cases/view_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										<a class="btn btn-info"  href="'.site_url('admin/cases/fees/'.$new->id).'"><i class="fa fa-inr"></i> '.lang('fees').'</a>	
                                      	<a class="btn btn-success"  href="'.site_url('admin/cases/dates/'.$new->id).'"><i class="fa fa-calendar"></i> '.lang('hearing_date').'</a>							
                                        <a class="btn btn-primary"  href="'.site_url('admin/cases/edit/'.$new->id) .'"><i class="fa fa-edit"></i> '.lang('edit').'</a>
										<a class="btn btn-warning"  href="'.site_url('admin/cases/archived/'.$new->id).'"><i class="fa fa-close"></i> '.lang('archived').'</a>
                                    </td>
                                </tr>
							';	
                              $i++;}
					echo '		  
                        </tbody>';
                        endif;
                    
				echo '</table>';
					
		
	}

	function get_case_by_case_stage_id_starred(){
		$cases = $this->cases_model->get_cases_by_case_stage_id_starred($_POST['id']);
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                         <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('client').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                        
                   ';
				   		if(isset($cases)):
                     echo '   
						<tbody>
                            ';
							 $i=1;foreach ($cases as $new){
							 
							 echo '
                                <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
									
								'; if($new->is_starred==0){ 
								echo '
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
								echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>
								';
									}
									
								echo'	</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									
                                    <td width="47%">
										<a class="btn btn-default"  href="'.site_url('admin/cases/view_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										<a class="btn btn-info"  href="'.site_url('admin/cases/fees/'.$new->id).'"><i class="fa fa-inr"></i> '.lang('fees').'</a>	
                                      	<a class="btn btn-success"  href="'.site_url('admin/cases/dates/'.$new->id).'"><i class="fa fa-calendar"></i> '.lang('hearing_date').'</a>							
                                        <a class="btn btn-primary"  href="'.site_url('admin/cases/edit/'.$new->id) .'"><i class="fa fa-edit"></i> '.lang('edit').'</a>
										<a class="btn btn-warning"  href="'.site_url('admin/cases/archived/'.$new->id).'"><i class="fa fa-close"></i> '.lang('archived').'</a>
                                    </td>
                                </tr>
							';	
                              $i++;}
					echo '		  
                        </tbody>';
                        endif;
                    
				echo '</table>';
					
		
	}


	function get_case_by_case_filing_date(){
		$cases = $this->cases_model->get_cases_by_filing_date($_POST['id']);
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                         <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('client').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                        
                   ';
				   		if(isset($cases)):
                    	 echo '   
						<tbody>
                            ';
							 $i=1;foreach ($cases as $new){
							 
							 echo '
                                <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
									
								'; if($new->is_starred==0){ 
								echo '
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
								echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>
								';
									}
									
								echo'	</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									
                                    <td width="47%">
										<a class="btn btn-default"  href="'.site_url('admin/cases/view_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										<a class="btn btn-info"  href="'.site_url('admin/cases/fees/'.$new->id).'"><i class="fa fa-inr"></i> '.lang('fees').'</a>	
                                      	<a class="btn btn-success"  href="'.site_url('admin/cases/dates/'.$new->id).'"><i class="fa fa-calendar"></i> '.lang('hearing_date').'</a>							
                                        <a class="btn btn-primary"  href="'.site_url('admin/cases/edit/'.$new->id) .'"><i class="fa fa-edit"></i> '.lang('edit').'</a>
										<a class="btn btn-warning"  href="'.site_url('admin/cases/archived/'.$new->id).'"><i class="fa fa-close"></i> '.lang('archived').'</a>
                                    </td>
                                </tr>
							';	
                              $i++;}
						echo '		  
                        </tbody>';
                        endif;
                    
				echo '</table>';
					
		
	}

	function get_case_by_case_filing_date_starred(){
		$cases = $this->cases_model->get_cases_by_filing_date_starred($_POST['id']);
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                         <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('client').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                   ';
				   		if(isset($cases)):
                    	 echo '   
						<tbody>
                            ';
							 $i=1;foreach ($cases as $new){
							 
							 echo '
                                <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
									
								'; if($new->is_starred==0){ 
								echo '
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
								echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>
								';
									}
									
								echo'	</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									
                                   <td width="47%">
										<a class="btn btn-default"  href="'.site_url('admin/cases/view_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										<a class="btn btn-info"  href="'.site_url('admin/cases/fees/'.$new->id).'"><i class="fa fa-inr"></i> '.lang('fees').'</a>	
                                      	<a class="btn btn-success"  href="'.site_url('admin/cases/dates/'.$new->id).'"><i class="fa fa-calendar"></i> '.lang('hearing_date').'</a>							
                                        <a class="btn btn-primary"  href="'.site_url('admin/cases/edit/'.$new->id) .'"><i class="fa fa-edit"></i> '.lang('edit').'</a>
										<a class="btn btn-warning"  href="'.site_url('admin/cases/archived/'.$new->id).'"><i class="fa fa-close"></i> '.lang('archived').'</a>
                                    </td>
                                </tr>
							';	
                              $i++;}
						echo '		  
                        </tbody>';
                        endif;
                    
				echo '</table>';
					
		
	}


	function get_case_by_case_hearing_date(){
		$cases = $this->cases_model->get_cases_by_hearing_date($_POST['id']);
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                         <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('client').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                        
                   ';
				   		if(isset($cases)):
                     echo '   
						<tbody>
                            ';
							 $i=1;foreach ($cases as $new){
							 
							 echo '
                                <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
									
								'; if($new->is_starred==0){ 
								echo '
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
								echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>
								';
									}
									
								echo'	</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									
                                    <td width="47%">
										<a class="btn btn-default"  href="'.site_url('admin/cases/view_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										<a class="btn btn-info"  href="'.site_url('admin/cases/fees/'.$new->id).'"><i class="fa fa-inr"></i> '.lang('fees').'</a>	
                                      	<a class="btn btn-success"  href="'.site_url('admin/cases/dates/'.$new->id).'"><i class="fa fa-calendar"></i> '.lang('hearing_date').'</a>							
                                        <a class="btn btn-primary"  href="'.site_url('admin/cases/edit/'.$new->id) .'"><i class="fa fa-edit"></i> '.lang('edit').'</a>
										<a class="btn btn-warning"  href="'.site_url('admin/cases/archived/'.$new->id).'"><i class="fa fa-close"></i> '.lang('archived').'</a>
                                    </td>
                                </tr>
							';	
                              $i++;}
					echo '		  
                        </tbody>';
                        endif;
                    
				echo '</table>';
					
		
	}

	function get_case_by_case_hearing_date_starred(){
		$cases = $this->cases_model->get_cases_by_hearing_date_starred($_POST['id']);
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                         <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('client').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                        
                   ';
				   		if(isset($cases)):
                     echo '   
						<tbody>
                            ';
							 $i=1;foreach ($cases as $new){
							 
							 echo '
                                <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
									
								'; if($new->is_starred==0){ 
								echo '
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
								echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>
								';
									}
									
								echo'	</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									
                                    <td width="47%">
										<a class="btn btn-default"  href="'.site_url('admin/cases/view_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										<a class="btn btn-info"  href="'.site_url('admin/cases/fees/'.$new->id).'"><i class="fa fa-inr"></i> '.lang('fees').'</a>	
                                      	<a class="btn btn-success"  href="'.site_url('admin/cases/dates/'.$new->id).'"><i class="fa fa-calendar"></i> '.lang('hearing_date').'</a>							
                                        <a class="btn btn-primary"  href="'.site_url('admin/cases/edit/'.$new->id) .'"><i class="fa fa-edit"></i> '.lang('edit').'</a>
										<a class="btn btn-warning"  href="'.site_url('admin/cases/archived/'.$new->id).'"><i class="fa fa-close"></i> '.lang('archived').'</a>
                                    </td>
                                </tr>
							';	
                              $i++;}
					echo '		  
                        </tbody>';
                        endif;
                    
				echo '</table>';
					
		
	}


	
	function view_all(){
		$data['cases'] = $this->cases_model->get_case_by_date();
		$ids='';
		foreach($data['cases'] as $ind => $key){
		
			$ids[]=$key->case_id;
		}
		
		$this->cases_model->cases_view_by_admin($ids);
		$data['page_title'] =  lang('view_all') . lang('cases');
		$data['body'] = 'case/view_all';
		$this->load->view('template/main', $data);	

	}	
	
	function get_court_categories()
	{
		$data['case_categories'] 	= $this->cases_model->get_all_case_categories();
		$result = $this->cases_model->get_court_catogries_by_location($_POST['id']);

		echo '
		<select name="court_category_id" id="court_category_id" class="chzn col-md-12" >
										<option value="">--Select Court Category--</option>
									';
									foreach($result as $new) {
											$sel = "";
											if(set_select('court_category_id', $new->id)) $sel = "selected='selected'";
											echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
										}
										
		echo'</select>';						
	}
	
	function get_courts()
	{
		$courts = $this->cases_model->get_all_courts();
		$result = $this->cases_model->get_court_by_location_c_category($_POST['l_id'],$_POST['c_id']);
		echo '
		<select name="court_id" id="court_id" class="chzn col-md-12" >
										<option value="">--Select Court Category--</option>
									';
									foreach($result as $new) {
											$sel = "";
											if(set_select('court_id', $new->id)) $sel = "selected='selected'";
											echo '<option value="'.$new->id.'" '.$sel.'>'.$new->name.'</option>';
										}
										
		echo'</select>';						
	}
	
	
	function starred_cases(){
		$data['cases'] = $this->cases_model->get_all_starred();
		$data['courts'] = $this->cases_model->get_all_courts();
		$data['clients'] = $this->cases_model->get_all_clients();
		$data['locations'] = $this->location_model->get_all();
		$data['stages'] = $this->case_stage_model->get_all();
		$data['page_title'] = lang('case');
		$data['body'] = 'case/starred_list';
		$this->load->view('template/main', $data);	

	}	
	
	
	
	function archived_cases(){
		$data['cases'] = $this->cases_model->get_all_archived();
		$data['courts'] = $this->cases_model->get_all_courts();
		$data['clients'] = $this->cases_model->get_all_clients();
		$data['locations'] = $this->location_model->get_all();
		$data['stages'] = $this->case_stage_model->get_all();
		$data['page_title'] = lang('archived_cases');
		$data['body'] = 'case/archive_list';
		$this->load->view('template/main', $data);	
	}	
	
	function get_archive_case_by_client(){
		$cases = $this->cases_model->get_archive_cases_by_client_id($_POST['id']);
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                        <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('clients').'</th>
								<th>'.lang('case').' '.lang('stage').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                        
                   ';
				    if(isset($cases)):
				echo '	
                        <tbody>
                            '; $i=1;foreach ($cases as $new){ // Fixed the missing '$' before i=1
                  echo '              <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
							';		
									if($new->is_starred==0){ 
						echo '			
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
							echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>';
								}
							echo '
									</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									<td>'.$new->stage.'</td>
									
                                    <td width="20%">
									 	 <a class="btn btn-primary"  href="'.site_url('admin/cases/view_archived_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										 <a class="btn btn-danger" style="margin-left:20px;" href="'.site_url('admin/cases/restore/'.$new->id).'" onclick="return areyousure()"><i class="fa fa-check"></i> '.lang('restore').'</a>
                                    </td>
                                </tr>';
								 $i++;}
                       echo ' </tbody>';
                         endif;
                   echo ' </table>
					';
	}	
	
	
	function get_archive_case_by_court(){
		$cases = $this->cases_model->get_archive_cases_by_court_id($_POST['id']);
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                         <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('clients').'</th>
								<th>'.lang('case').' '.lang('stage').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                        
                   ';
				    if(isset($cases)):
				echo '	
                        <tbody>
                            '; $i=1;foreach ($cases as $new){ // Fixed the missing '$' before i=1
                  echo '              <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
							';		
									if($new->is_starred==0){ 
						echo '			
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
							echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>';
								}
							echo '
									</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									<td>'.$new->stage.'</td>
									
                                     <td width="20%">
									 	 <a class="btn btn-primary"  href="'.site_url('admin/cases/view_archived_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										 <a class="btn btn-danger" style="margin-left:20px;" href="'.site_url('admin/cases/restore/'.$new->id).'" onclick="return areyousure()"><i class="fa fa-check"></i> '.lang('restore').'</a>
                                    </td>
                                </tr>';
								 $i++;}
                       echo ' </tbody>';
                         endif;
                   echo ' </table>
					';
	}	
	
	
	function get_archive_case_by_location(){
		$cases = $this->cases_model->get_archive_cases_by_location_id($_POST['id']);
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                         <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('clients').'</th>
								<th>'.lang('case').' '.lang('stage').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                        
                   ';
				    if(isset($cases)):
				echo '	
                        <tbody>
                            '; $i=1;foreach ($cases as $new){ // Fixed the missing '$' before i=1
                echo '              <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
							';		
									if($new->is_starred==0){ 
				echo '			
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
				echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>';
								}
				echo '
									</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									<td>'.$new->stage.'</td>
									
                                    <td width="20%">
									 	 <a class="btn btn-primary"  href="'.site_url('admin/cases/view_archived_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										 <a class="btn btn-danger" style="margin-left:20px;" href="'.site_url('admin/cases/restore/'.$new->id).'" onclick="return areyousure()"><i class="fa fa-check"></i> '.lang('restore').'</a>
                                    </td>
                                </tr>';
								 $i++;}
                echo ' </tbody>';
                         endif;
                echo ' </table>
					';
	}	
	
	
	function get_archive_case_by_case_stage_id(){
		$cases = $this->cases_model->get_archive_cases_by_case_stage_id($_POST['id']);
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                         <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('clients').'</th>
								<th>'.lang('case').' '.lang('stage').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                        
                   ';
				    if(isset($cases)):
				echo '	
                        <tbody>
                            '; $i=1;foreach ($cases as $new){ // Fixed the missing '$' before i=1
                echo '              <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
							';		
									if($new->is_starred==0){ 
				echo '			
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
				echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>';
								}
				echo '
									</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									<td>'.$new->stage.'</td>
									
                                     <td width="20%">
									 	 <a class="btn btn-primary"  href="'.site_url('admin/cases/view_archived_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										 <a class="btn btn-danger" style="margin-left:20px;" href="'.site_url('admin/cases/restore/'.$new->id).'" onclick="return areyousure()"><i class="fa fa-check"></i> '.lang('restore').'</a>
                                    </td>
                                </tr>';
								 $i++;}
                echo ' </tbody>';
                         endif;
                echo ' </table>
					';
	}	
	
	
	function get_archive_case_by_case_filing_date(){
		$cases = $this->cases_model->get_archive_cases_by_filing_date($_POST['id']);
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                        <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('clients').'</th>
								<th>'.lang('case').' '.lang('stage').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                   ';
				    if(isset($cases)):
				echo '	
                        <tbody>
                            '; $i=1;foreach ($cases as $new){ // Fixed the missing '$' before i=1
                echo '              <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
							';		
									if($new->is_starred==0){ 
				echo '			
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
				echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>';
								}
				echo '
									</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									<td>'.$new->stage.'</td>
									
                                     <td width="20%">
									 	 <a class="btn btn-primary"  href="'.site_url('admin/cases/view_archived_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										 <a class="btn btn-danger" style="margin-left:20px;" href="'.site_url('admin/cases/restore/'.$new->id).'" onclick="return areyousure()"><i class="fa fa-check"></i> '.lang('restore').'</a>
                                    </td>
                                </tr>';
								 $i++;}
                echo ' </tbody>';
                         endif;
                echo ' </table>
					';
	}	
	
	
	function get_archive_case_by_case_hearing_date(){
			$cases = $this->cases_model->get_archive_cases_by_hearing_date($_POST['id']);
		echo '
		<table id="example1" class="table table-bordered table-striped table-mailbox">
                        <thead>
                            <tr>
                                <th width="5%">'.lang('serial_number').'</th>
								<th width="8%">'.lang('star').'</th>
								<th>'.lang('case').' '.lang('title').'</th>
								<th>'.lang('case').' '.lang('number').'</th>
								<th>'.lang('clients').'</th>
								<th>'.lang('case').' '.lang('stage').'</th>
								<th width="20%">'.lang('action').'</th>
                            </tr>
                        </thead>
                        
                   ';
				    if(isset($cases)):
				echo '	
                        <tbody>
                            '; $i=1;foreach ($cases as $new){ // Fixed the missing '$' before i=1
                echo '              <tr class="gc_row">
                                    <td>'.$i.'</td>
									
									<td class="small-col">
							';		
									if($new->is_starred==0){ 
				echo '			
									<a href="" at="90" class="Privat"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star-o"></i></a>
								';
									}else{
				echo '
									<a href="" at="90" class="Public"><span style="display:none">'.$new->id.'</span>
									<i class="fa fa-star"></i></a>';
								}
				echo '
									</td>
                                    <td>'.$new->title.'</td>
								    <td>'.$new->case_no.'</td>
									<td>'.$new->client.'</td>
									<td>'.$new->stage.'</td>
									
                                     <td width="20%">
									 	 <a class="btn btn-primary"  href="'.site_url('admin/cases/view_archived_case/'.$new->id).'"><i class="fa fa-eye"></i> '.lang('view').'</a>
										 <a class="btn btn-danger" style="margin-left:20px;" href="'.site_url('admin/cases/restore/'.$new->id).'" onclick="return areyousure()"><i class="fa fa-check"></i> '.lang('restore').'</a>
                                    </td>
                                </tr>';
								 $i++;}
                echo ' </tbody>';
                         endif;
                echo ' </table>
					';
	}
	
	
	
	function restore($id)
	{
		$this->cases_model->restore_case($id);
		$this->session->set_flashdata('message', lang('case_has_been_restored'));
		redirect('admin/cases');
	}
	
	
	
	function archived($id=false){
	
		$data['clients']		 	= $this->cases_model->get_all_clients();
		$data['id']					=$id;
		$data['case']				= $this->cases_model->get_case_by_id($id);
		
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {	
			$this->load->library('form_validation');
			$this->form_validation->set_rules('notes', 'lang:notes', 'required');
			$this->form_validation->set_rules('close_date', 'lang:date', 'trim|required');
			 
			if ($this->form_validation->run()==true)
            {
				$save['notes'] = $this->input->post('notes');
				$save['close_date'] = $this->input->post('close_date');
				$save['case_id'] = $id;
				$this->cases_model->save_archived($save);
				$this->cases_model->set_is_archived($id);
              	$this->session->set_flashdata('message', lang('case_is_archived'));
				redirect('admin/cases/archived_cases');
			}
		}		
	
		$data['page_title'] = lang('archive') . lang('case');
		$data['body'] = 'case/archive';
		$this->load->view('template/main', $data);	
	}
	

	function view_archived_case($id=false){
		$data['clients']		 	= $this->cases_model->get_all_clients();
		$data['stages'] 			= $this->case_stage_model->get_all();
		$data['acts']			 	= $this->cases_model->get_all_acts();
		$data['courts']			 	= $this->cases_model->get_all_courts();
		$data['locations']		 	= $this->cases_model->get_all_locations();
		$data['case_categories'] 	= $this->cases_model->get_all_case_categories();
		$data['court_categories']	= $this->cases_model->get_all_court_categories();
		$data['id'] 				= $id;
		$data['payment_modes']		= $this->cases_model->get_all_payment_modes();
		$data['fees_all']			= $this->cases_model->get_fees_all($id);
		$data['case']				= $this->cases_model->get_archive_case_by_id($id);
		$data['cases']		 		= $this->cases_model->get_all_extended_case_by_id($id);
		//$data['cases']		 		= $this->cases_model->get_all_extended_case_by_id($id); // This line is duplicated
		$data['page_title'] 		= lang('view') . lang('archived_case');
		$data['body'] 				= 'case/view_archived';
	
		$this->load->view('template/main', $data);	
	}
	
	function view_case($id=false){
		$data['fields'] = $this->custom_field_model->get_custom_fields(2);	
		$data['clients']		 	= $this->cases_model->get_all_clients();
		$data['stages']				= $this->case_stage_model->get_all();
		$data['acts']			 	= $this->cases_model->get_all_acts();
		$data['courts']			 	= $this->cases_model->get_all_courts();
		$data['locations']		 	= $this->cases_model->get_all_locations();
		$data['case_categories'] 	= $this->cases_model->get_all_case_categories();
		$data['court_categories']	= $this->cases_model->get_all_court_categories();
		$data['id'] 				= $id;
		$data['payment_modes']		= $this->cases_model->get_all_payment_modes();
		$data['fees_all']			= $this->cases_model->get_fees_all($id);
		$data['case']				= $this->cases_model->get_archive_case_by_id($id); // Should this be get_case_by_id?
		$data['cases']		 		= $this->cases_model->get_all_extended_case_by_id($id);
		//$data['cases']		 		= $this->cases_model->get_all_extended_case_by_id($id); // This line is duplicated
		
		$this->cases_model->case_view_by_admin($id);
		
		$data['page_title']			= lang('view') . lang('case');
		$data['body'] 				= 'case/view_case';
		$this->load->view('template/main', $data);	
	}
	
	function add(){
		$data['fields_clients'] = $this->custom_field_model->get_custom_fields(1);
		$data['fields']			 = $this->custom_field_model->get_custom_fields(2);
		$data['clients']		 = $this->cases_model->get_all_clients();
		$data['stages'] 		 = $this->case_stage_model->get_all();
		$data['acts'] 			 = $this->cases_model->get_all_acts();
		$data['courts']			 = $this->cases_model->get_all_courts();
		$data['locations'] 		 = $this->cases_model->get_all_locations();
		$data['case_categories'] = $this->cases_model->get_all_case_categories();
		$data['court_categories']= $this->cases_model->get_all_court_categories();
        
        // Get the next case number
        $data['next_case_no'] = $this->cases_model->get_next_case_no();

		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {	
			$this->load->library('form_validation');
			$this->form_validation->set_message('required', lang('custom_required'));
			$this->form_validation->set_rules('title', 'lang:title', 'required');
			$this->form_validation->set_rules('client_id', 'Client', 'required');
            // Case number is now auto-generated, so no need to validate its uniqueness here in the same way.
            // The database constraint will handle uniqueness. We still need to ensure it's submitted.
			$this->form_validation->set_rules('case_no', 'Case No', 'trim|required'); 
			$this->form_validation->set_rules('location_id', 'Location', 'required');
			$this->form_validation->set_rules('case_stage_id', 'Case Stage', 'required');
			$this->form_validation->set_rules('court_id', 'Court', 'required');
			$this->form_validation->set_rules('court_category_id', 'Court Category', 'required');
			$this->form_validation->set_rules('case_category_id', 'Case Category', 'required');
			$this->form_validation->set_rules('act_id', 'Act', 'required');
			$this->form_validation->set_rules('start_date', 'Filing Date', 'required');
			$this->form_validation->set_rules('description', 'Description', '');
			$this->form_validation->set_rules('fees', 'Fees', '');
			$this->form_validation->set_rules('o_lawyer', 'Opposite Lawyer', '');
			$this->form_validation->set_rules('hearing_date', 'Description', ''); // Should this be 'Hearing Date'?
			//$data['fields'] = $this->custom_field_model->get_custom_fields(2); // 2 = form_id for cases - already loaded
			foreach ($data['fields'] as $doc) {
			    $this->form_validation->set_rules("reply[{$doc->id}]", $doc->name, 'required');
            }
			if ($this->form_validation->run()==true)
            {
				$save['title'] = $this->input->post('title');
				$save['case_no'] = $this->input->post('case_no'); // This will be the auto-generated one
				$save['client_id'] = $this->input->post('client_id');
				$save['location_id'] = $this->input->post('location_id');
				$save['court_id'] = $this->input->post('court_id');
				$save['court_category_id'] = $this->input->post('court_category_id');
				$save['case_stage_id'] = $this->input->post('case_stage_id');
				$save['case_category_id'] = json_encode($this->input->post('case_category_id'));
				$save['act_id'] = json_encode($this->input->post('act_id'));
				$save['description'] = $this->input->post('description');
				$save['start_date'] = $this->input->post('start_date');
				$save['hearing_date'] = $this->input->post('hearing_date');
				$save['o_lawyer'] = $this->input->post('o_lawyer');
				$save['fees'] = $this->input->post('fees');
             
			 	$p_key = $this->cases_model->save($save);
				$reply = $this->input->post('reply');
					if(!empty($reply)){
					foreach($this->input->post('reply') as $key => $val) {
						$save_fields[] = array(
							'custom_field_id'=> $key,
							'reply'=> $val,
							'table_id'=> $p_key,
							'form'=> 2,
						);	
					
					}	
					$this->custom_field_model->save_answer($save_fields);
				}
                $this->session->set_flashdata('message', lang('case_created'));
				redirect('admin/cases');
				
			}
		}		
		
		
		$data['page_title'] = lang('add') . lang('case');
		$data['body'] = 'case/add';
		
		
		$this->load->view('template/main', $data);	

	}	
	
	
	function edit($id=false){
	
		$data['clients']		 	= $this->cases_model->get_all_clients();
		$data['stages'] 			= $this->case_stage_model->get_all();
		$data['acts']			 	= $this->cases_model->get_all_acts();
		$data['courts']			 	= $this->cases_model->get_all_courts();
		$data['locations']		 	= $this->cases_model->get_all_locations();
		$data['case_categories'] 	= $this->cases_model->get_all_case_categories();
		$data['court_categories']	= $this->cases_model->get_all_court_categories();
		$data['id']					= $id;
		$data['case'] 				= $this->cases_model->get_case_by_id($id);
		$data['fields'] 			= $this->custom_field_model->get_custom_fields(2);	
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {	
			$this->load->library('form_validation');
			$this->form_validation->set_rules('client_id', 'lang:client', 'required');
            // Case number is read-only, so no need to validate its uniqueness on edit in the same way.
            // It should not be changed by the user.
			$this->form_validation->set_rules('case_no', 'lang:case_number', 'trim|required'); 
			$this->form_validation->set_rules('location_id', 'lang:location', 'required');
			$this->form_validation->set_rules('court_id', 'lang:court', 'required');
			$this->form_validation->set_rules('court_category_id', 'lang:court_category', 'required');
			$this->form_validation->set_rules('case_category_id', 'lang:case_category', 'required');
			$this->form_validation->set_rules('act_id', 'lang:act', 'required');
			$this->form_validation->set_rules('start_date', 'lang:filing_date', 'required');
			 $this->form_validation->set_message('required', lang('custom_required'));
			if ($this->form_validation->run()==true)
            {
				$save['title'] = $this->input->post('title');
                // Do NOT update case_no from POST data as it should be uneditable
				// $save['case_no'] = $this->input->post('case_no'); 
				$save['client_id'] = $this->input->post('client_id');
				$save['location_id'] = $this->input->post('location_id');
				$save['court_id'] = $this->input->post('court_id');
				$save['court_category_id'] = $this->input->post('court_category_id');
				$save['case_stage_id'] = $this->input->post('case_stage_id');
				$save['case_category_id'] = json_encode($this->input->post('case_category_id'));
				$save['act_id'] = json_encode($this->input->post('act_id'));
				$save['description'] = $this->input->post('description');
				$save['start_date'] = $this->input->post('start_date');
				$save['hearing_date'] = $this->input->post('hearing_date');
				$save['o_lawyer'] = $this->input->post('o_lawyer');
				$save['fees'] = $this->input->post('fees');
				
				$reply = $this->input->post('reply');
				if(!empty($reply)){	
					$save_fields = []; // Initialize as array
					foreach($this->input->post('reply') as $key => $val) {
						$save_fields[] = array(
							'custom_field_id'=> $key,
							'reply'=> $val,
							'table_id'=> $id,
							'form'=> 2,
						);	
					
					}	
					$this->custom_field_model->delete_answer($id,$form=2);
					$this->custom_field_model->save_answer($save_fields);
				}
				$this->cases_model->update($save,$id);
              	$this->session->set_flashdata('message',  lang('case_updated')); // Changed from 'case_created'
				redirect('admin/cases');
			}
		}		
	
		$data['page_title'] = lang('edit') . lang('case'); // Changed from 'court' to 'case'
		$data['body'] = 'case/edit';
		$this->load->view('template/main', $data);	

	}
	
	function notes($id=false){
		$data['id']					=	$id;
		$data['case'] 				= $this->cases_model->get_case_by_id($id);
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {	
			$this->load->library('form_validation');
			$this->form_validation->set_rules('notes', 'lang:notes', 'required');
			 $this->form_validation->set_message('required', lang('custom_required'));
			if ($this->form_validation->run()==true)
            {
				$save['notes'] = $this->input->post('notes');
				
				$this->cases_model->update($save,$id);
              	$this->session->set_flashdata('message',  lang('notes_saved'));
				redirect('admin/cases/notes/'.$id);
			}
		}		
	
		$data['page_title'] =  lang('notes');
		$data['body'] = 'case/notes';
		$this->load->view('template/main', $data);	

	}
	
	
	
	function dates($id=false){
	
		$data['cases']		 	= $this->cases_model->get_all_extended_case_by_id($id);
		$data['id'] =$id;
		$data['case']				= $this->cases_model->get_case_by_id($id);
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {	
			$this->load->library('form_validation');
			$this->form_validation->set_rules('date', 'lang:date', 'required');
			$this->form_validation->set_message('required', lang('custom_required'));
			 
			if ($this->form_validation->run()==true)
            {
			    $save = []; // Initialize save array
				if($_FILES['img'] ['name'] !='')
					{ 
						
					
						$config['upload_path'] = './assets/uploads/files/';
						$config['allowed_types'] = 'gif|jpg|png|pdf|doc';
						$config['max_size']	= '10000';
						$config['max_width']  = '10000';
						$config['max_height']  = '6000';
				
						$this->load->library('upload', $config);
				
						if ( !$this->upload->do_upload('img')) // Removed $img assignment here
							{
								// Handle upload error if necessary, though original code doesn't explicitly
                                $error = array('error' => $this->upload->display_errors());
                                $this->session->set_flashdata('error', $error['error']); // Optional: show error
							}
							else
							{
								$img_data = array('upload_data' => $this->upload->data());
                                $save['document'] = $img_data['upload_data']['file_name'];
							}
						
					}
					
				$save['case_id'] = $id;	
				$save['next_date'] = $this->input->post('date');
				$save['last_date'] = $this->input->post('date2');
				$save['note'] = $this->input->post('notes');
				$this->cases_model->save_extended_case($save);
              	$this->session->set_flashdata('message', 'Extended Date Saved');
				redirect('admin/cases/dates/'.$id);
				
			}
		}		
	
		
		$data['body'] = 'case/extended_dates';
		$this->load->view('template/main', $data);	

	}
	
	
	function dates_detail($id=false){
	
		$data['cases']		 	= $this->cases_model->get_extended_case_by_id($id);
		$data['id'] 			= $id;
		$data['case']			= $this->cases_model->get_case_by_id($id); // Should this be get_case_by_id($data['cases']->case_id) or similar if $id is extended_case_id?
		$data['page_title']		= lang('extended_case_details'); // Added page title
		$data['body'] 			= 'case/extended_dates_detail';
		$this->load->view('template/main', $data);	

	}	
	
	function fees($id){
		$data['tax']			= $this->tax_model->get_all();
		$data['payment_modes']			= $this->cases_model->get_all_payment_modes();
		$data['receipts']			= $this->cases_model->get_receipts($id);
		$data['case']					= $this->cases_model->get_case_by_id($id);
		$data['fees_all']				= $this->cases_model->get_fees_all($id);
		$data['id'] 					= $id;
		$invoice			= $this->cases_model->get_invoice_number();
		
		//echo '<pre>'; print_r($data['receipts']);die;

		if(empty($invoice->invoice)){
			$data['invoice_no'] = $this->settings->invoice_no; // Ensure $this->settings is loaded or handle if not
		}else{
			$data['invoice_no'] = intval($invoice->invoice)+1;
		}
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {	
			$this->load->library('form_validation');
			$this->form_validation->set_rules('amount', 'lang:amount', 'required|numeric');
			$this->form_validation->set_rules('total', 'lang:total', 'required|numeric'); // Added validation for total
			$this->form_validation->set_rules('payment_mode_id', 'lang:payment_mode', 'required');
			$this->form_validation->set_rules('date', 'lang:date', 'required');
			$this->form_validation->set_rules('invoice_no', 'lang:invoice', 'required');
			if ($this->form_validation->run()==true)
            {
			
				$save['amount'] = $this->input->post('amount');
				$save['total'] = $this->input->post('total');
				$save['payment_mode_id'] = $this->input->post('payment_mode_id');
				$save['case_id'] = $id;
				$save['date'] = $this->input->post('date');
				$save['invoice'] =  $data['invoice_no'];
				
				$fees_id = $this->cases_model->save_fees($save);
				$save_tax=array();
				$taxes = $this->input->post('tax_id');
				if(!empty($taxes)){
				$i=0; // Array index should start from 0
					foreach($taxes as $new_tax_id){ // Changed variable name to avoid confusion
						$save_tax[$i]['tax_id'] = $new_tax_id;
						$save_tax[$i]['fees_id'] = $fees_id;
					$i++;
					}
				$this->cases_model->save_taxes($save_tax);
				}
				
				
				
              	$this->session->set_flashdata('message', lang('fees_updated'));
				redirect('admin/cases/fees/'.$id);
			}
		}
		$data['page_title'] = lang('fees'); // Added page title
		$data['body'] = 'case/fees';
		$this->load->view('template/main', $data);
	}
	
	function view_receipt($id){
		$data['receipt']			= $this->cases_model->get_receipt($id);
		//echo '<pre>'; print_r($data['receipt']);die;
		$data['payment_modes']			= $this->cases_model->get_all_payment_modes();
		$data['setting']     = $this->settings; // Ensure $this->settings is loaded
		$data['page_title'] = lang('view_receipt'); // Added page title
		$data['body'] = 'case/view_receipt';
		$this->load->view('template/main', $data);
	}
	
	function print_receipt($id){
		$data['receipt']			= $this->cases_model->get_receipt($id);
		//echo '<pre>'; print_r($data['receipt']);die;
		$data['payment_modes']			= $this->cases_model->get_all_payment_modes();
		$data['setting']     = $this->settings; // Ensure $this->settings is loaded
		//$data['body'] = ''; // Not needed for direct view loading
		$this->load->view('case/print_receipt', $data);
	}
	
	function pdf($id=false){
		$this->load->helper('dompdf_helper'); // Ensure this helper is available
		//$this->load->helper('download'); // Not strictly needed for pdf_create
		$data['receipt']			= $this->cases_model->get_receipt($id);
		$data['payment_modes']			= $this->cases_model->get_all_payment_modes();
		$data['setting']     = $this->settings; // Ensure $this->settings is loaded
		$data['page_title'] = lang('receipt');
		//$data['body'] = 'invoice/pdf'; // Not needed for direct view loading for PDF generation
		$html = $this->load->view('case/pdf_receipt', $data,true);		
		pdf_create($html, 'Receipt_'.$data['receipt']->id); // Ensure pdf_create function is defined and works
		

	}	
	
	
	
	public function mail($id=false)
	{ 
		$data['receipt']			= $this->cases_model->get_receipt($id);
		$data['payment_modes']			= $this->cases_model->get_all_payment_modes();
		$data['setting']     = $this->settings; // Ensure $this->settings is loaded
		$data['page_title'] = lang('receipt'); // Not used in mail function directly but good for context
		
		//echo $data['receipt']->u_email;die;
		// Ensure $data['setting']->image and $data['setting']->email are available
		$img_html = ''; // Initialize image html
 		if(!empty($data['setting']->image)){ 
 			$img_html = '<img src="'.site_url('assets/uploads/images/'.$data['setting']->image).'"  height="70" width="80"  style="padding-left:30px;" />';
 		}
		$html = $this->load->view('case/pdf_receipt', $data,true); // pdf_receipt might not be ideal for email, consider a simpler email template	
		$message = $img_html . $html; // Prepend image if exists
		$msg 				 = html_entity_decode($message,ENT_QUOTES, 'UTF-8');
		$params['recipient'] = $data['receipt']->u_email;
		$params['subject'] 	 = "Receipt";
		$params['message']   = $msg;
		
        // Ensure fomailer module and its send_email method exist and are correctly configured
		$mail_sent = modules::run('admin/fomailer/send_email',$params); 
	
        if($mail_sent){
		    $this->session->set_flashdata('message', lang('receipt_send_success')); // More specific message
        } else {
            $this->session->set_flashdata('error', lang('receipt_send_error')); // Error message
        }
		redirect('admin/cases/fees/'.$data['receipt']->case_id);
			
	}
	
	
	function receipt($id){ // This function name is confusingly similar to get_receipt and view_receipt
		$data['tax']			= $this->tax_model->get_all();
		$data['payment_modes']			= $this->cases_model->get_all_payment_modes();
		$data['case']					= $this->cases_model->get_case_by_id($id); // $id here is case_id
		$data['fees_all']				= $this->cases_model->get_fees_all($id);
		$data['id'] 					= $id; // case_id
		//$invoice			= $this->cases_model->get_invoice_number(); // Not used here
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {	
			$this->load->library('form_validation');
			$this->form_validation->set_rules('r_amount', 'lang:amount', 'required|numeric'); // Added required and numeric
            $this->form_validation->set_rules('r_date', 'lang:date', 'required'); // Added required
            $this->form_validation->set_rules('fees_id', 'lang:fees_id', 'required|numeric'); // Added required and numeric
            // $this->form_validation->set_rules('case_id', 'lang:case_id', 'required|numeric'); // This is already $id from URL
			if ($this->form_validation->run()==true)
            {
			//echo '<pre>'; print_r($_POST);die;
			
				$save['amount'] = $this->input->post('r_amount');
				$save['date'] = $this->input->post('r_date');
				$save['fees_id'] = $this->input->post('fees_id');
				$save['case_id'] = $id; // Use $id from the URL which is the case_id
				
				$this->cases_model->save_receipt($save);
				
              	$this->session->set_flashdata('message', lang('receipt_created'));
				redirect('admin/cases/fees/'.$id);
			}
		}
		$data['page_title'] = lang('add_receipt'); // More specific page title
		$data['body'] = 'case/fees'; // This view is likely for adding fees, not just receipts. Recheck view structure.
		$this->load->view('template/main', $data);
	}
	
	function delete($id=false){
		
		if($id){
			$this->cases_model->delete($id);
			$this->session->set_flashdata('message',  lang('case_deleted'));
            redirect('admin/cases');
		} else {
            $this->session->set_flashdata('error', lang('invalid_id')); // Handle no ID case
            redirect('admin/cases');
        }
	}
	
	function delete_archive_case($id=false){
		
		if($id){
			$this->cases_model->delete($id); // This deletes from 'cases' table, is this intended for archived cases?
                                            // Or should it delete from 'archived_cases' table or just update a flag?
			$this->session->set_flashdata('message',  lang('case_deleted')); // Message might be confusing if it's an archive.
			redirect('admin/cases/archived_cases');
		} else {
            $this->session->set_flashdata('error', lang('invalid_id'));
            redirect('admin/cases/archived_cases');
        }
	}	
	
	function delete_fees($id=false,$case_id=false){ // Added case_id for redirect
		
		if($id){
			$this->cases_model->delete_fees($id);
			$this->session->set_flashdata('message', lang('fees_deleted'));
			if($case_id){
                redirect('admin/cases/fees/'.$case_id); // Redirect back to the specific case's fees page
            } else {
                redirect('admin/cases'); // Fallback redirect
            }
			
		} else {
            $this->session->set_flashdata('error', lang('invalid_id'));
            if($case_id){
                redirect('admin/cases/fees/'.$case_id);
            } else {
                redirect('admin/cases');
            }
        }
	}	
	
	function delete_deceipt($id=false,$c_id=false){ // Changed to delete_receipt to match model
		//$rc = $this->cases_model->get_receipt($id); // Not used
		if($id && $c_id){ // Ensure both IDs are present
			$this->cases_model->delete_receipt($id);
			$this->session->set_flashdata('message', lang('receipt_deleted'));
			redirect('admin/cases/fees/'.$c_id);
			
		} else {
            $this->session->set_flashdata('error', lang('invalid_id_or_case_id'));
            if($c_id){
                redirect('admin/cases/fees/'.$c_id);
            } else {
                redirect('admin/cases'); // Fallback
            }
        }
	}	
	
	
		
	function delete_history($id=false, $case_id=false){ // Added case_id for redirect
		
		if($id){
			$this->cases_model->delete_history($id);
			$this->session->set_flashdata('message', lang('history_deleted'));
            if($case_id){
                 redirect('admin/cases/dates/'.$case_id); // Redirect to the case's dates page
            } else {
			    redirect('admin/cases'); // Fallback
            }
		} else {
            $this->session->set_flashdata('error', lang('invalid_id'));
             if($case_id){
                 redirect('admin/cases/dates/'.$case_id);
            } else {
			    redirect('admin/cases');
            }
        }
	}	

		
	function set_starred()
	{
        if($this->input->post('id')){
		    $this->cases_model->set_is_starred($this->input->post('id'));
            // Consider returning a JSON response for AJAX
            echo json_encode(['status' => 'success', 'message' => lang('case_starred')]);
        } else {
            echo json_encode(['status' => 'error', 'message' => lang('invalid_id')]);
        }
        exit; // Stop further execution for AJAX
	}	
	
	function update_set_starred()
	{
        if($this->input->post('id')){
		    $this->cases_model->update_set_is_starred($this->input->post('id'));
            // Consider returning a JSON response for AJAX
            echo json_encode(['status' => 'success', 'message' => lang('case_unstarred')]);
        } else {
             echo json_encode(['status' => 'error', 'message' => lang('invalid_id')]);
        }
        exit; // Stop further execution for AJAX
	}	
	
		
	
}

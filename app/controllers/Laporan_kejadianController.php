<?php 
/**
 * Laporan_kejadian Page Controller
 * @category  Controller
 */
class Laporan_kejadianController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "laporan_kejadian";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("laporan_kejadian.id_laporan", 
			"laporan_kejadian.tanggal_kejadian", 
			"laporan_kejadian.tanggal_entry_kejadian", 
			"laporan_kejadian.lokasi_jalan", 
			"laporan_kejadian.rt", 
			"laporan_kejadian.rw", 
			"laporan_kejadian.dusun", 
			"laporan_kejadian.desa_kelurahan", 
			"laporan_kejadian.Kecamatan", 
			"laporan_kejadian.jenis_kejadian_bencana", 
			"laporan_kejadian.kronologi_kejadian", 
			"laporan_kejadian.kerugian_usulan_rp", 
			"laporan_kejadian.kerugian_pengajuan_dana_td", 
			"laporan_kejadian.kerugian_realisasi", 
			"laporan_kejadian.data_korban_kerusakan", 
			"laporan_kejadian.keterangan_bantuan", 
			"laporan_kejadian.petugas_entry", 
			"user.username AS user_username");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				laporan_kejadian.id_laporan LIKE ? OR 
				laporan_kejadian.tanggal_kejadian LIKE ? OR 
				laporan_kejadian.tanggal_entry_kejadian LIKE ? OR 
				laporan_kejadian.lokasi_jalan LIKE ? OR 
				laporan_kejadian.rt LIKE ? OR 
				laporan_kejadian.rw LIKE ? OR 
				laporan_kejadian.dusun LIKE ? OR 
				laporan_kejadian.desa_kelurahan LIKE ? OR 
				laporan_kejadian.Kecamatan LIKE ? OR 
				laporan_kejadian.jenis_kejadian_bencana LIKE ? OR 
				laporan_kejadian.kronologi_kejadian LIKE ? OR 
				laporan_kejadian.kerugian_usulan_rp LIKE ? OR 
				laporan_kejadian.kerugian_pengajuan_dana_td LIKE ? OR 
				laporan_kejadian.kerugian_realisasi LIKE ? OR 
				laporan_kejadian.data_korban_kerusakan LIKE ? OR 
				laporan_kejadian.keterangan_bantuan LIKE ? OR 
				laporan_kejadian.petugas_entry LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "laporan_kejadian/search.php";
		}
		$db->join("user", "laporan_kejadian.petugas_entry = user.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("laporan_kejadian.id_laporan", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Laporan Kejadian";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("laporan_kejadian/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("laporan_kejadian.id_laporan", 
			"laporan_kejadian.tanggal_kejadian", 
			"laporan_kejadian.tanggal_entry_kejadian", 
			"laporan_kejadian.lokasi_jalan", 
			"laporan_kejadian.rt", 
			"laporan_kejadian.rw", 
			"laporan_kejadian.dusun", 
			"laporan_kejadian.desa_kelurahan", 
			"laporan_kejadian.Kecamatan", 
			"laporan_kejadian.jenis_kejadian_bencana", 
			"laporan_kejadian.kronologi_kejadian", 
			"laporan_kejadian.kerugian_usulan_rp", 
			"laporan_kejadian.kerugian_pengajuan_dana_td", 
			"laporan_kejadian.kerugian_realisasi", 
			"laporan_kejadian.data_korban_kerusakan", 
			"laporan_kejadian.keterangan_bantuan", 
			"laporan_kejadian.petugas_entry", 
			"user.username AS user_username");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("laporan_kejadian.id_laporan", $rec_id);; //select record based on primary key
		}
		$db->join("user", "laporan_kejadian.petugas_entry = user.id", "INNER");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Laporan Kejadian";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("laporan_kejadian/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("tanggal_kejadian","tanggal_entry_kejadian","jenis_kejadian_bencana","kronologi_kejadian","lokasi_jalan","rt","rw","dusun","desa_kelurahan","Kecamatan","kerugian_usulan_rp","kerugian_pengajuan_dana_td","kerugian_realisasi","data_korban_kerusakan","keterangan_bantuan","petugas_entry");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal_kejadian' => 'required',
				'jenis_kejadian_bencana' => 'required',
				'kronologi_kejadian' => 'required',
				'lokasi_jalan' => 'required',
				'rt' => 'required',
				'rw' => 'required',
				'dusun' => 'required',
				'desa_kelurahan' => 'required',
				'Kecamatan' => 'required',
				'kerugian_usulan_rp' => 'required',
				'kerugian_pengajuan_dana_td' => 'required',
				'kerugian_realisasi' => 'required',
				'data_korban_kerusakan' => 'required',
				'keterangan_bantuan' => 'required',
				'petugas_entry' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal_kejadian' => 'sanitize_string',
				'jenis_kejadian_bencana' => 'sanitize_string',
				'kronologi_kejadian' => 'sanitize_string',
				'lokasi_jalan' => 'sanitize_string',
				'rt' => 'sanitize_string',
				'rw' => 'sanitize_string',
				'dusun' => 'sanitize_string',
				'desa_kelurahan' => 'sanitize_string',
				'Kecamatan' => 'sanitize_string',
				'kerugian_usulan_rp' => 'sanitize_string',
				'kerugian_pengajuan_dana_td' => 'sanitize_string',
				'kerugian_realisasi' => 'sanitize_string',
				'data_korban_kerusakan' => 'sanitize_string',
				'keterangan_bantuan' => 'sanitize_string',
				'petugas_entry' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['tanggal_entry_kejadian'] = format_date('Y-m-d H:i:s');
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("laporan_kejadian");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Laporan Kejadian";
		$this->render_view("laporan_kejadian/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id_laporan","tanggal_kejadian","tanggal_entry_kejadian","jenis_kejadian_bencana","kronologi_kejadian","lokasi_jalan","rt","rw","dusun","desa_kelurahan","Kecamatan","kerugian_usulan_rp","kerugian_pengajuan_dana_td","kerugian_realisasi","data_korban_kerusakan","keterangan_bantuan","petugas_entry");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal_kejadian' => 'required',
				'jenis_kejadian_bencana' => 'required',
				'kronologi_kejadian' => 'required',
				'lokasi_jalan' => 'required',
				'rt' => 'required',
				'rw' => 'required',
				'dusun' => 'required',
				'desa_kelurahan' => 'required',
				'Kecamatan' => 'required',
				'kerugian_usulan_rp' => 'required',
				'kerugian_pengajuan_dana_td' => 'required',
				'kerugian_realisasi' => 'required',
				'data_korban_kerusakan' => 'required',
				'keterangan_bantuan' => 'required',
				'petugas_entry' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal_kejadian' => 'sanitize_string',
				'jenis_kejadian_bencana' => 'sanitize_string',
				'kronologi_kejadian' => 'sanitize_string',
				'lokasi_jalan' => 'sanitize_string',
				'rt' => 'sanitize_string',
				'rw' => 'sanitize_string',
				'dusun' => 'sanitize_string',
				'desa_kelurahan' => 'sanitize_string',
				'Kecamatan' => 'sanitize_string',
				'kerugian_usulan_rp' => 'sanitize_string',
				'kerugian_pengajuan_dana_td' => 'sanitize_string',
				'kerugian_realisasi' => 'sanitize_string',
				'data_korban_kerusakan' => 'sanitize_string',
				'keterangan_bantuan' => 'sanitize_string',
				'petugas_entry' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['tanggal_entry_kejadian'] = format_date('Y-m-d H:i:s');
			if($this->validated()){
				$db->where("laporan_kejadian.id_laporan", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("laporan_kejadian");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("laporan_kejadian");
					}
				}
			}
		}
		$db->where("laporan_kejadian.id_laporan", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Laporan Kejadian";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("laporan_kejadian/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id_laporan","tanggal_kejadian","tanggal_entry_kejadian","jenis_kejadian_bencana","kronologi_kejadian","lokasi_jalan","rt","rw","dusun","desa_kelurahan","Kecamatan","kerugian_usulan_rp","kerugian_pengajuan_dana_td","kerugian_realisasi","data_korban_kerusakan","keterangan_bantuan","petugas_entry");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'tanggal_kejadian' => 'required',
				'jenis_kejadian_bencana' => 'required',
				'kronologi_kejadian' => 'required',
				'lokasi_jalan' => 'required',
				'rt' => 'required',
				'rw' => 'required',
				'dusun' => 'required',
				'desa_kelurahan' => 'required',
				'Kecamatan' => 'required',
				'kerugian_usulan_rp' => 'required',
				'kerugian_pengajuan_dana_td' => 'required',
				'kerugian_realisasi' => 'required',
				'data_korban_kerusakan' => 'required',
				'keterangan_bantuan' => 'required',
				'petugas_entry' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal_kejadian' => 'sanitize_string',
				'jenis_kejadian_bencana' => 'sanitize_string',
				'kronologi_kejadian' => 'sanitize_string',
				'lokasi_jalan' => 'sanitize_string',
				'rt' => 'sanitize_string',
				'rw' => 'sanitize_string',
				'dusun' => 'sanitize_string',
				'desa_kelurahan' => 'sanitize_string',
				'Kecamatan' => 'sanitize_string',
				'kerugian_usulan_rp' => 'sanitize_string',
				'kerugian_pengajuan_dana_td' => 'sanitize_string',
				'kerugian_realisasi' => 'sanitize_string',
				'data_korban_kerusakan' => 'sanitize_string',
				'keterangan_bantuan' => 'sanitize_string',
				'petugas_entry' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("laporan_kejadian.id_laporan", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("laporan_kejadian.id_laporan", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("laporan_kejadian");
	}
}

<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("laporan_kejadian/add");
$can_edit = ACL::is_allowed("laporan_kejadian/edit");
$can_view = ACL::is_allowed("laporan_kejadian/view");
$can_delete = ACL::is_allowed("laporan_kejadian/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Laporan Kejadian</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id_laporan']) ? urlencode($data['id_laporan']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_laporan">
                                        <th class="title"> Id Laporan: </th>
                                        <td class="value"> <?php echo $data['id_laporan']; ?></td>
                                    </tr>
                                    <tr  class="td-tanggal_kejadian">
                                        <th class="title"> Tanggal Kejadian: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['tanggal_kejadian']; ?>" 
                                                data-pk="<?php echo $data['id_laporan'] ?>" 
                                                data-url="<?php print_link("laporan_kejadian/editfield/" . urlencode($data['id_laporan'])); ?>" 
                                                data-name="tanggal_kejadian" 
                                                data-title="Enter Tanggal Kejadian" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['tanggal_kejadian']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-tanggal_entry_kejadian">
                                        <th class="title"> Tanggal Entry Kejadian: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tanggal_entry_kejadian']; ?>" 
                                                data-pk="<?php echo $data['id_laporan'] ?>" 
                                                data-url="<?php print_link("laporan_kejadian/editfield/" . urlencode($data['id_laporan'])); ?>" 
                                                data-name="tanggal_entry_kejadian" 
                                                data-title="Enter Tanggal Entry Kejadian" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['tanggal_entry_kejadian']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-lokasi_jalan">
                                        <th class="title"> Lokasi Jalan: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['lokasi_jalan']; ?>" 
                                                data-pk="<?php echo $data['id_laporan'] ?>" 
                                                data-url="<?php print_link("laporan_kejadian/editfield/" . urlencode($data['id_laporan'])); ?>" 
                                                data-name="lokasi_jalan" 
                                                data-title="Enter Lokasi Jalan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['lokasi_jalan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-rt">
                                        <th class="title"> Rt: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['rt']; ?>" 
                                                data-pk="<?php echo $data['id_laporan'] ?>" 
                                                data-url="<?php print_link("laporan_kejadian/editfield/" . urlencode($data['id_laporan'])); ?>" 
                                                data-name="rt" 
                                                data-title="Enter Rt" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['rt']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-rw">
                                        <th class="title"> Rw: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['rw']; ?>" 
                                                data-pk="<?php echo $data['id_laporan'] ?>" 
                                                data-url="<?php print_link("laporan_kejadian/editfield/" . urlencode($data['id_laporan'])); ?>" 
                                                data-name="rw" 
                                                data-title="Enter Rw" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['rw']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-dusun">
                                        <th class="title"> Dusun: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['dusun']; ?>" 
                                                data-pk="<?php echo $data['id_laporan'] ?>" 
                                                data-url="<?php print_link("laporan_kejadian/editfield/" . urlencode($data['id_laporan'])); ?>" 
                                                data-name="dusun" 
                                                data-title="Enter Dusun" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['dusun']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-desa_kelurahan">
                                        <th class="title"> Desa Kelurahan: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['desa_kelurahan']; ?>" 
                                                data-pk="<?php echo $data['id_laporan'] ?>" 
                                                data-url="<?php print_link("laporan_kejadian/editfield/" . urlencode($data['id_laporan'])); ?>" 
                                                data-name="desa_kelurahan" 
                                                data-title="Enter Desa Kelurahan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['desa_kelurahan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Kecamatan">
                                        <th class="title"> Kecamatan: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Kecamatan']; ?>" 
                                                data-pk="<?php echo $data['id_laporan'] ?>" 
                                                data-url="<?php print_link("laporan_kejadian/editfield/" . urlencode($data['id_laporan'])); ?>" 
                                                data-name="Kecamatan" 
                                                data-title="Enter Kecamatan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Kecamatan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-jenis_kejadian_bencana">
                                        <th class="title"> Jenis Kejadian Bencana: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['jenis_kejadian_bencana']; ?>" 
                                                data-pk="<?php echo $data['id_laporan'] ?>" 
                                                data-url="<?php print_link("laporan_kejadian/editfield/" . urlencode($data['id_laporan'])); ?>" 
                                                data-name="jenis_kejadian_bencana" 
                                                data-title="Enter Jenis Kejadian Bencana" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['jenis_kejadian_bencana']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-kronologi_kejadian">
                                        <th class="title"> Kronologi Kejadian: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['kronologi_kejadian']; ?>" 
                                                data-pk="<?php echo $data['id_laporan'] ?>" 
                                                data-url="<?php print_link("laporan_kejadian/editfield/" . urlencode($data['id_laporan'])); ?>" 
                                                data-name="kronologi_kejadian" 
                                                data-title="Enter Kronologi Kejadian" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['kronologi_kejadian']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-kerugian_usulan_rp">
                                        <th class="title"> Kerugian Usulan Rp: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['kerugian_usulan_rp']; ?>" 
                                                data-pk="<?php echo $data['id_laporan'] ?>" 
                                                data-url="<?php print_link("laporan_kejadian/editfield/" . urlencode($data['id_laporan'])); ?>" 
                                                data-name="kerugian_usulan_rp" 
                                                data-title="Enter Kerugian Usulan Rp" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['kerugian_usulan_rp']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-kerugian_pengajuan_dana_td">
                                        <th class="title"> Kerugian Pengajuan Dana Td: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['kerugian_pengajuan_dana_td']; ?>" 
                                                data-pk="<?php echo $data['id_laporan'] ?>" 
                                                data-url="<?php print_link("laporan_kejadian/editfield/" . urlencode($data['id_laporan'])); ?>" 
                                                data-name="kerugian_pengajuan_dana_td" 
                                                data-title="Enter Kerugian Pengajuan Dana Td" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['kerugian_pengajuan_dana_td']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-kerugian_realisasi">
                                        <th class="title"> Kerugian Realisasi: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['kerugian_realisasi']; ?>" 
                                                data-pk="<?php echo $data['id_laporan'] ?>" 
                                                data-url="<?php print_link("laporan_kejadian/editfield/" . urlencode($data['id_laporan'])); ?>" 
                                                data-name="kerugian_realisasi" 
                                                data-title="Enter Kerugian Realisasi" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['kerugian_realisasi']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-data_korban_kerusakan">
                                        <th class="title"> Data Korban Kerusakan: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['data_korban_kerusakan']; ?>" 
                                                data-pk="<?php echo $data['id_laporan'] ?>" 
                                                data-url="<?php print_link("laporan_kejadian/editfield/" . urlencode($data['id_laporan'])); ?>" 
                                                data-name="data_korban_kerusakan" 
                                                data-title="Enter Data Korban Kerusakan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['data_korban_kerusakan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-keterangan_bantuan">
                                        <th class="title"> Keterangan Bantuan: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['keterangan_bantuan']; ?>" 
                                                data-pk="<?php echo $data['id_laporan'] ?>" 
                                                data-url="<?php print_link("laporan_kejadian/editfield/" . urlencode($data['id_laporan'])); ?>" 
                                                data-name="keterangan_bantuan" 
                                                data-title="Enter Keterangan Bantuan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['keterangan_bantuan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-petugas_entry">
                                        <th class="title"> Petugas Entry: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("user/view/" . urlencode($data['petugas_entry'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['user_username'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-save"></i> Export
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                    <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                        <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                        </a>
                                        <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                        <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                            <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                            </a>
                                            <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                            <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                </a>
                                                <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                    <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                    </a>
                                                    <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                    <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                        <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                        </a>
                                                    </div>
                                                </div>
                                                <?php if($can_edit){ ?>
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("laporan_kejadian/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("laporan_kejadian/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                    <i class="fa fa-times"></i> Delete
                                                </a>
                                                <?php } ?>
                                            </div>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <!-- Empty Record Message -->
                                            <div class="text-muted p-3">
                                                <i class="fa fa-ban"></i> No Record Found
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

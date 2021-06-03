 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Breadcrumbs-->
     <ol class="breadcrumb">
         <li class="breadcrumb-item">
             <a href="<?= base_url('kaprodi') ?>">Dashboard</a>
         </li>
         <li class="breadcrumb-item active">Perlu Di Proses</li>
     </ol>

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>


     <!-- Main content -->
     <section class="content">
         <div class="container-fluid">

             <!-- Main row -->
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header">

                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <?php if ($this->session->flashdata('message')) {
                                    echo '<div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                                    echo $this->session->flashdata('message');
                                    echo '</div>';
                                }
                                ?>
                             <?php if ($this->session->flashdata('form_error')) : ?>
                                 <div class="alert alert-danger" role="alert">
                                     <?php echo $this->session->flashdata('form_error'); ?>
                                 </div>
                             <?php endif; ?>
                             <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                 <div class="row">
                                     <div class="col-sm-12">
                                         <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info" id="datatables">
                                             <thead>
                                                 <tr>
                                                     <th>No</th>
                                                     <th>Nama</th>
                                                     <th>NIM</th>
                                                     <th>Departemen</th>
                                                     <th>Program Studi</th>
                                                     <th>Judul TA</th>
                                                     <th>Dosbing 1</th>
                                                     <th>Dosbing 2</th>
                                                     <th>Status</th>
                                                     <th>Aksi</th>

                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $id = 1;
                                                    foreach ($data as $row) {
                                                        if ($row->id_prodi == $_SESSION['id_prodi']) {
                                                    ?>
                                                         <tr>
                                                             <td><?= $id++; ?></td>
                                                             <td><?php echo $row->nama; ?></td>
                                                             <td><?php echo $row->nim; ?></td>
                                                             <td><?php echo $row->departemen; ?></td>
                                                             <td><?php echo $row->program_studi; ?></td>
                                                             <td><?php echo $row->judul_ta; ?></td>
                                                             <td><?php echo $row->nama_dosbing1; ?></td>
                                                             <td><?php echo $row->nama_dosbing2; ?></td>

                                                             <td align="center"><?php switch ($row->status_prodi) {
                                                                                    case 0: ?><a class="btn btn-sm btn btn-outline-warning">Proses</a><?php break;
                                                                                                                                                    case 1: ?><a data-toggle="modal" data-target="#detail_revisi<?= $row->id ?>" class="btn btn-sm btn btn-outline-danger">Revisi</a><?php break;
                                                                                                                                                                                                                                                                                    case 3: ?> <a class="btn btn-sm btn btn-outline-success ">Disetujui</a><?php break;
                                                                                                                                                                                                                                                                                                                                                } ?></td>

                                                             <td>
                                                                 <a href="<?= base_url('Kaprodi/detail_data') . '/' . $row->id; ?>" class="btn btn-sm btn-success btn-sm">Detail</a>

                                                                 <a href="<?= base_url('Kaprodi/setuju') . '/' . $row->id; ?>" class="btn btn-sm btn btn-outline-success">Setujui</a>

                                                                 <a data-toggle="modal" data-target="#tolak_prodi<?= $row->id ?>" class="btn btn-sm btn btn-outline-danger">Tolak</a>

                                                                 <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletemodal"><i class="fas fa-trash"></i></button>
                                                             </td>





                                                         </tr>
                                                 <?php }
                                                    }
                                                    ?>
                                             </tbody>
                                         </table>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <!-- Modal lihat Revisi Prodi-->

                         <?php foreach ($data as $row) { ?>

                             <div class="modal fade" id="detail_revisi<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered" role="document">
                                     <div class="modal-content">

                                         <div class="modal-body">

                                             <form id="myForm" action=" " method="post" enctype="multipart/form-data">

                                                 <div class="form-group">
                                                     <label for="ket_tolak_prodi">Keterangan*</label>
                                                     <input required type="text" class="form-control" id="ket_tolak_prodi" name="ket_tolak_prodi" maxlength="500" cols="10" rows="10" value="<?= $row->ket_tolak_prodi ?>" readonly>
                                                 </div>

                                         </div>

                                         </form>
                                     </div>
                                 </div>
                             </div>
                         <?php } ?>


                         <!-- Modal tolak prodi -->

                         <?php foreach ($data as $row) { ?>

                             <div class="modal fade" id="tolak_prodi<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered" role="document">
                                     <div class="modal-content">

                                         <div class="modal-body">

                                             <form id="myForm" action="<?php echo site_url('Kaprodi/tolak/' . $row->id); ?>" method="post" enctype="multipart/form-data">

                                                 <div class="form-group">
                                                     <label for="ket_tolak_prodi">Keterangan*</label>

                                                     <textarea class="form-control <?php echo form_error('ket_tolak_prodi') ? 'is-invalid' : '' ?>" type="text" name="ket_tolak_prodi" placeholder="Masukkan Isi Redaksi" maxlength="500" cols="5" rows="5"></textarea>


                                                 </div>

                                         </div>

                                         <div class="modal-footer">
                                             <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                             <input class="btn btn-success" type="submit" name="btn" value="Simpan" />
                                         </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         <?php } ?>

                         <!-- Modal Delete -->

                         <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin?</h5>
                                         <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">×</span>
                                         </button>
                                     </div>
                                     <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
                                     <div class="modal-footer">
                                         <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                         <a id="btn-delete" class="btn btn-danger" href="<?php echo site_url('Kaprodi/delete_pendataan_ta/' . $row->id) ?>">Delete</a>
                                     </div>
                                 </div>
                             </div>
                         </div>

                     </div>
                 </div>
             </div>
         </div>

     </section>
 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Breadcrumbs-->
     <ol class="breadcrumb">
         <li class="breadcrumb-item">
             <a href="<?= base_url('kaprodi') ?>">Dashboard</a>
         </li>
         <li class="breadcrumb-item active">TA Disetujui </li>
     </ol>

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>




 </div>
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


                 </div>
             </div>
         </div>
     </div>

 </section>
 <!-- Begin Page Content -->
 <div class="container-fluid">


     <!-- Breadcrumbs-->
     <ol class="breadcrumb">
         <li class="breadcrumb-item">
             <a href="<?= base_url('admin') ?>">Dashboard</a>
         </li>

         <li class="breadcrumb-item active">Data User</li>
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
                         <button class="btn btn-primary" data-toggle="modal" data-target="#tambahbaru"><i class="fas fa-plus fa-fw"></i>Tambah User Baru</button>

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
                                                 <th>Username</th>
                                                 <th>Gambar</th>
                                                 <th>Role ID</th>
                                                 <th>Action</th>

                                             </tr>
                                         </thead>
                                         <tbody>

                                             <?php $id = 1;
                                                foreach ($role as $s) { ?>
                                                 <tr>
                                                     <td><?= $id++; ?></td>
                                                     <td><?= $s->name; ?></td>
                                                     <td><?= $s->username; ?></td>
                                                     <td align=center><img style="width:100px;" src="<?php echo base_url('upload/user/' . $s->image); ?>" alt=""></td>
                                                     <td><?= $s->role; ?></td>

                                                     <td>
                                                         <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#update_user<?= $s->id ?>"><i class="fas fa-edit"></i></button>
                                                         <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletemodal"><i class="fas fa-trash"></i></button>
                                                     </td>
                                                 </tr>
                                             <?php } ?>
                                         </tbody>
                                         <tfoot>
                                             <tr>
                                                 <th>No</th>
                                                 <th>Nama</th>
                                                 <th>Username</th>
                                                 <th>Gambar</th>
                                                 <th>Role ID</th>
                                                 <th>Action</th>
                                             </tr>
                                         </tfoot>
                                     </table>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <!-- Modal add User-->
                     <div class="modal fade" id="tambahbaru" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-centered" role="document">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLongTitle">Tambah User Baru</h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 <div class="modal-body">
                                     <form id="myForm" action="<?php echo site_url('Admin/save_user') ?>" method="post" enctype="multipart/form-data">

                                         <div class="form-group">
                                             <label for="name">Nama*</label>
                                             <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama">
                                         </div>

                                         <div class="form-group">
                                             <label for="nim">NIM*</label>
                                             <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM">
                                         </div>

                                         <div class="form-group">
                                             <label for="username">Username*</label>
                                             <input type="username" class="form-control" id="username" name="username" placeholder="Masukkan Username">
                                         </div>

                                         <div class="form-group">
                                             <label for="password">Password*</label>
                                             <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                                         </div>

                                         <div class="form-group">
                                             <label for="image">Profil*</label>
                                             <input type="file" class="form-control" id="image" name="image" placeholder="Masukkan Profil">
                                         </div>

                                         <div class="form-group">
                                             <label for="role_id">Role ID*</label>
                                             <select required name="role_id" id="role_id" class="form-control">
                                                 <option value="">Pilih Role ID</option>
                                                 <?php foreach ($role_id as $a) { ?>
                                                     <option value="<?= $a->id; ?>"><?= $a->role; ?></option>
                                                 <?php } ?>
                                             </select>
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

                     <!-- Modal Delete User -->

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
                                     <a id="btn-delete" class="btn btn-danger" href="<?php echo site_url('Admin/delete_user/' . $s->id) ?>">Delete</a>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <!-- Modal Edit User -->
                     <?php foreach ($role as $s) { ?>

                         <div class="modal fade" id="update_user<?= $s->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                             <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <div class="modal-body">
                                         <form id="myForm" action="<?php echo site_url('Admin/update_user/' . $s->id); ?>" method="post" enctype="multipart/form-data">
                                             <div class="form-group">
                                                 <label for="name">Nama*</label>
                                                 <input type="text" class="form-control" id="name" name="name" value="<?= $s->name ?>" placeholder="Masukkan Nama">
                                             </div>

                                             <div class="form-group">
                                                 <label for="nim">NIM*</label>
                                                 <input type="text" class="form-control" id="nim" name="nim" value="<?= $s->nim ?>" placeholder="Masukkan NIM">
                                             </div>

                                             <div class="form-group">
                                                 <label for="username">Username*</label>
                                                 <input type="text" class="form-control" id="username" name="username" value="<?= $s->username ?>" placeholder="Masukkan E-Mail">
                                             </div>

                                             <div class="form-group">
                                                 <label for="password">Password*</label>
                                                 <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                                             </div>

                                             <div class="form-group">

                                                 <label for="file">Profil(png/jpg)*</label>
                                                 <input type="file" class="form-control" id="file" name="file">

                                             </div>

                                             <div class="form-group">
                                                 <label for="role_id">Role ID*</label>
                                                 <select required name="role_id" id="role_id" class="form-control">
                                                     <option value="">Pilih Role ID</option>
                                                     <?php foreach ($role_id as $a) { ?>
                                                         <option value="<?= $a->id; ?>"><?= $a->role; ?></option>
                                                     <?php } ?>
                                                 </select>
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
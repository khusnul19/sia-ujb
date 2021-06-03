 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Breadcrumbs-->
     <ol class="breadcrumb">
         <li class="breadcrumb-item">
             <a href="<?= base_url('user') ?>">Dashboard</a>
         </li>
         <li class="breadcrumb-item active">Pendataan TA</li>
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
                         <button class="btn btn-primary" data-toggle="modal" data-target="#tambahbaru"><i class="fas fa-plus fa-fw"></i>Tambah Data Baru</button>

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
                                                foreach ($data as $row) { ?>
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

                                                         <a href="<?= base_url('user/detail_data') . '/' . $row->id; ?>" class="btn btn-success btn-sm">Detail</a>

                                                         <?php if ($row->status_prodi == '0') {
                                                            ?>
                                                             <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#update<?= $row->id ?>"><i class="fas fa-edit"></i></button>
                                                             <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletemodal"><i class="fas fa-trash"></i></button>

                                                     </td>

                                                     <?php}?>



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

                     <!-- Modal add -->
                     <div class="modal fade" id="tambahbaru" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-centered" role="document">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Baru</h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 <div class="modal-body">
                                     <form id="myForm" action="<?php echo site_url('User/save_pendataan_ta') ?>" method="post" enctype="multipart/form-data">

                                         <div class="form-group">
                                             <label for="nama">Nama*</label>
                                             <input required type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" value="<?= $this->session->userdata('name') ?>" readonly>
                                         </div>

                                         <div class="form-group">
                                             <label for="nim">NIM*</label>
                                             <input required type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" value="<?= $this->session->userdata('nim') ?>" readonly>
                                         </div>

                                         <div class="form-group">
                                             <label for="departemen">Departemen*</label>
                                             <input required type="text" class="form-control" id="departemen" name="departemen" placeholder="Masukkan Departemen">
                                         </div>

                                         <div class="form-group">
                                             <label for="program_studi">Program Studi*</label>

                                             <select required name="program_studi" id="program_studi" class=" selectpicker form-control" data-live-search="true">
                                                 <option value="">Pilih Program Studi</option>
                                                 <option value="D4-Rekayasa Perancangan Mekanik">D4-Rekayasa Perancangan Mekanik</option>
                                                 <option value="D4-Teknologi Rekayasa Kimia Industri">D4-Teknologi Rekayasa Kimia Industri</option>
                                                 <option value="D4-Teknologi Rekayasa Otomasi">D4-Teknologi Rekayasa Otomasi</option>
                                                 <option value="D4-Teknologi Rekayasa Konstruksi Perkapalan">D4-Teknologi Rekayasa Konstruksi Perkapalan</option>
                                                 <option value="D4-Teknik Infrastruktur Sipil Dan Perancangan">D4-Teknik Infrastruktur Sipil Dan Perancangan</option>
                                                 <option value="D4-Perencanaan Tata Ruang Dan Pertanahan">D4-Perencanaan Tata Ruang Dan Pertanahan</option>
                                                 <option value="D4-Teknik Listrik Industri">D4-Teknik Listrik Industri</option>
                                                 <option value="D4-Manajemen dan Administrasi">D4-Manajemen Dan Administrasi</option>
                                                 <option value="D4-Informasi dan Hubungan Masyarakat">D4-Informasi Dan Hubungan Masyarakat</option>
                                                 <option value="D4-Akuntansi Perpajakan">D4-Akuntansi Perpajakan</option>
                                                 <option value="D4-Bahasa Asing Terapan">D4-Bahasa Asing Terapan</option>
                                                 <option value="D4-Teknologi Perencanaan Wilayah Dan Kota">D4-Teknologi Perencanaan Wilayah Dan Kota</option>
                                                 <option value="D3-Hubungan Masyarakat">D3-Hubungan Masyarakat</option>
                                                 <option value="D3-Akuntansi">D3-Akuntansi</option>
                                                 <option value="D3-Manajemen Perusahaan">D3-Manajemen Perusahaan</option>
                                                 <option value="D3-Administrasi Pajak">D3-Administrasi Pajak</option>
                                             </select>
                                         </div>



                                         <div class="form-group">
                                             <label for="nama_dosbing1">Nama Dosbing 1*</label>
                                             <input required type="text" class="form-control" id="nama_dosbing1" name="nama_dosbing1" placeholder="Masukkan Nama Dosbing 1">
                                         </div>

                                         <div class="form-group">
                                             <label for="nama_dosbing2">Nama Dosbing 2*</label>
                                             <input required type="text" class="form-control" id="nama_dosbing2" name="nama_dosbing2" placeholder="Masukkan Nama Dosbing 2">
                                         </div>

                                         <div class="form-group">
                                             <label for="judul_ta">Judul TA*</label>
                                             <input required type="text" class="form-control" id="judul_ta" name="judul_ta" placeholder="Masukkan Judul TA">
                                         </div>

                                         <div class="form-group">
                                             <label for="ket_ta">Keterangan TA*</label>
                                             <textarea class="form-control <?php echo form_error('ket_ta') ? 'is-invalid' : '' ?>" required type="text" name="ket_ta" placeholder="Masukkan Isi Redaksi" maxlength="500" cols="20" rows="20"></textarea>
                                         </div>

                                         <div class="form-group">
                                             <label for="jenis_luaran_ta">Jenis Luaran TA*</label>

                                             <select required name="jenis_luaran_ta" id="jenis_luaran_ta" class=" selectpicker form-control" data-live-search="true">
                                                 <option value="">Pilih Jenis Luaran</option>
                                                 <option value="Banner">Banner</option>
                                                 <option value="Prototipe">Prototipe</option>
                                                 <option value="Paten">Paten</option>
                                                 <option value="Poster">Poster</option>
                                             </select>
                                         </div>


                                         <div class="form-group">
                                             <label for="file">Upload File TA (pdf)*</label>

                                             <input required type="file" class="form-control" id="file" name="file1">
                                         </div>

                                         <div class="form-group">
                                             <label for="file">Upload Luaran TA (pdf)*</label>

                                             <input required type="file" class="form-control" id="file" name="file2">
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

                     <!-- Modal lihat Revisi Prodi-->

                     <?php foreach ($data as $row) { ?>

                         <div class="modal fade" id="detail_revisi<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                             <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">

                                     <div class="modal-body">

                                         <form id="myForm" action=" " method="post" enctype="multipart/form-data">

                                             <div class="form-group">
                                                 <label for="ket_tolak_prodi">Keterangan*</label>
                                                 <textarea class="form-control" type="text" id="ket_tolak_prodi" name="ket_tolak_prodi" maxlength="500" cols="5" rows="5" disabled><?php echo $row->ket_tolak_prodi; ?> </textarea>
                                             </div>

                                     </div>
                                     <div class="modal-footer">

                                         <div class="text-center">
                                             <a class="medium" href="<?= base_url('user/pendataan_ta');  ?>"><i class="fa fa-info-circle"></i> Silahkan Lakukan Pendataan Ulang?</a>
                                         </div>

                                     </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     <?php } ?>

                     <!-- Modal Edit -->

                     <?php foreach ($data as $row) { ?>

                         <div class="modal fade" id="update<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                             <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <div class="modal-body">
                                         <form id="myForm" action="<?php echo site_url('User/update_ta/' . $row->id); ?>" method="post" enctype="multipart/form-data">

                                             <div class="form-group">
                                                 <label for="nama">Nama*</label>
                                                 <input required type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" value="<?= $this->session->userdata('name') ?>" readonly>
                                             </div>

                                             <div class="form-group">
                                                 <label for="nim">NIM*</label>
                                                 <input required type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" value="<?= $this->session->userdata('nim') ?>" readonly>
                                             </div>

                                             <div class="form-group">
                                                 <label for="departemen">Departemen*</label>
                                                 <input required type="text" class="form-control" id="departemen" name="departemen" value="<?= $row->departemen ?>" placeholder="Masukkan Departemen">
                                             </div>

                                             <div class="form-group">
                                                 <label for="program_studi">Program Studi*</label>

                                                 <select name="program_studi" id="inputState" class="form-control" required>
                                                     <?php if ($row->program_studi == '') { ?>
                                                         <option selected>Pilih...</option>
                                                     <?php } else { ?>
                                                         <option selected><?php echo $row->program_studi; ?></option>
                                                     <?php } ?>
                                                     <option value="D4-Rekayasa Perancangan Mekanik">D4-Rekayasa Perancangan Mekanik</option>
                                                     <option value="D4-Teknologi Rekayasa Kimia Industri">D4-Teknologi Rekayasa Kimia Industri</option>
                                                     <option value="D4-Teknologi Rekayasa Otomasi">D4-Teknologi Rekayasa Otomasi</option>
                                                     <option value="D4-Teknologi Rekayasa Konstruksi Perkapalan">D4-Teknologi Rekayasa Konstruksi Perkapalan</option>
                                                     <option value="D4-Teknik Infrastruktur Sipil Dan Perancangan">D4-Teknik Infrastruktur Sipil Dan Perancangan</option>
                                                     <option value="D4-Perencanaan Tata Ruang Dan Pertanahan">D4-Perencanaan Tata Ruang Dan Pertanahan</option>
                                                     <option value="D4-Teknik Listrik Industri">D4-Teknik Listrik Industri</option>
                                                     <option value="D4-Manajemen dan Administrasi">D4-Manajemen Dan Administrasi</option>
                                                     <option value="D4-Informasi dan Hubungan Masyarakat">D4-Informasi Dan Hubungan Masyarakat</option>
                                                     <option value="D4-Akuntansi Perpajakan">D4-Akuntansi Perpajakan</option>
                                                     <option value="D4-Bahasa Asing Terapan">D4-Bahasa Asing Terapan</option>
                                                     <option value="D4-Teknologi Perencanaan Wilayah Dan Kota">D4-Teknologi Perencanaan Wilayah Dan Kota</option>
                                                     <option value="D3-Hubungan Masyarakat">D3-Hubungan Masyarakat</option>
                                                     <option value="D3-Akuntansi">D3-Akuntansi</option>
                                                     <option value="D3-Manajemen Perusahaan">D3-Manajemen Perusahaan</option>
                                                     <option value="D3-Administrasi Pajak">D3-Administrasi Pajak</option>
                                                 </select>
                                             </div>


                                             <div class="form-group">
                                                 <label for="nama_dosbing1">Nama Dosbing 1*</label>
                                                 <input required type="text" class="form-control" id="nama_dosbing1" name="nama_dosbing1" value="<?= $row->nama_dosbing1 ?>" placeholder="Masukkan Nama Dosbing 1">
                                             </div>

                                             <div class="form-group">
                                                 <label for="nama_dosbing2">Nama Dosbing 2*</label>
                                                 <input required type="text" class="form-control" id="nama_dosbing2" name="nama_dosbing2" value="<?= $row->nama_dosbing2 ?>" placeholder="Masukkan Nama Dosbing 2">
                                             </div>

                                             <div class="form-group">
                                                 <label for="judul_ta">Judul TA*</label>
                                                 <input required type="text" class="form-control" id="judul_ta" name="judul_ta" value="<?= $row->judul_ta ?>" placeholder="Masukkan Judul TA">
                                             </div>

                                             <div class="form-group">
                                                 <label for="ket_ta">Keterangan TA*</label>
                                                 <textarea class="form-control" required type="text" name="ket_ta" placeholder="Masukkan Isi Redaksi" maxlength="500" cols="20" rows="20"><?php echo $row->ket_ta; ?></textarea>
                                             </div>

                                             <div class="form-group">
                                                 <label for="jenis_luaran_ta">Jenis Luaran TA*</label>

                                                 <select name="jenis_luaran_ta" id="inputState" class="form-control" required>
                                                     <?php if ($row->jenis_luaran_ta == '') { ?>
                                                         <option selected>Pilih...</option>
                                                     <?php } else { ?>
                                                         <option selected><?php echo $row->jenis_luaran_ta; ?></option>
                                                     <?php } ?>
                                                     <option value="Banner">Banner</option>
                                                     <option value="Prototipe">Prototipe</option>
                                                     <option value="Paten">Paten</option>
                                                     <option value="Poster">Poster</option>
                                                 </select>
                                             </div>

                                             <div class="form-group">
                                                 <label for="file"> Upload File TA (pdf)* <?php echo $row->file_ta; ?> </label>

                                                 <input type="file" class="form-control" id="file">
                                             </div>

                                             <div class="form-group">
                                                 <label for="file"> Upload Luaran TA (pdf)* <?php echo $row->luaran_ta; ?></label>

                                                 <input type="file" class="form-control" id="file" name="file2">
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
                                     <a id="btn-delete" class="btn btn-danger" href="<?php echo site_url('User/delete_pendataan_ta/' . $row->id) ?>">Delete</a>
                                 </div>
                             </div>
                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </div>

 </section>
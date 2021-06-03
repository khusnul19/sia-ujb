<div class="content-wrapper">
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('kaprodi') ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Data TA</a>
            </li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>

        <!-- Page Heading -->
        <div class="text-center">
            <h1 class="h3 mb-2 text-gray-800"><strong> Detail Data Tugas Akhir </strong></h1>
        </div>
        <div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo $detail->nama ?>" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label>NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" value="<?php echo $detail->nim ?>" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Departemen</label>
                    <input type="text" class="form-control" id="departemen" name="departemen" placeholder="Masukkan Departemen" value="<?php echo $detail->departemen; ?>" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label>Program Studi</label>
                    <input type="text" class="form-control" id="program_studi" name="program_studi" placeholder="Masukkan Program Studi" value="<?php echo $detail->program_studi; ?>" disabled>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nama Dosbing 1</label>
                    <input type="text" class="form-control" id="nama_dosbing1" name="nama_dosbing1" placeholder="Masukkan Nama Dosbing 1" value="<?php echo $detail->nama_dosbing1; ?>" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label>Nama Dosbing 2</label>
                    <input type="text" class="form-control" id="nama_dosbing2" name="nama_dosbing2" placeholder="Masukkan Nama Dosbing 2" value="<?php echo $detail->nama_dosbing2; ?>" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Judul TA</label>
                    <input type="text" class="form-control" id="judul_ta" name="judul_ta" placeholder="Masukkan Judul TA" value="<?php echo $detail->judul_ta; ?>" disabled>
                </div>

                <div class="form-group col-md-6">
                    <label>Jenis Luaran TA</label>
                    <input type="text" class="form-control" id="jenis_luaran_ta" name="jenis_luaran_ta" value="<?php echo $detail->jenis_luaran_ta; ?>" disabled>
                </div>



            </div>

            <div class="form-row">


                <div class="form-group col-md-6">
                    <label>Keterangan TA</label><br />

                    <textarea class="form-control" type="text" name="ket_ta" maxlength="500" cols="5" rows="5" disabled><?php echo $detail->ket_ta; ?> </textarea>
                </div>

            </div>

        </div>

        <div class="form-row">


            <div class="form-group col-md-6">

                <label>File TA</label>

                <td align=left>

                    <a href="<?= base_url() . 'upload/file_ta/' . $detail->file_ta; ?>" target="_blank">
                        -Download File-
                    </a>
                </td>
            </div>

            <div class="form-group col-md-6">

                <label>Luaran TA</label>

                <td align=left>

                    <a href="<?= base_url() . 'upload/luaran_ta/' . $detail->luaran_ta; ?>" target="_blank">
                        -Download File-
                    </a>
                </td>
            </div>

        </div>

    </div>


</div>
</div>
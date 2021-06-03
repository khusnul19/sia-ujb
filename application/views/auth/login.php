<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="card-title text-center">
                                    <img src="template/back-end/dist/img/undip.jpg" alt="Universitas Diponegoro" style="width: 150px;">
                                    <h2 class="h4 text-gray-900 mb-2">Sistem Informasi Pendataan Tugas Akhir</h2>
                                    <h1 class="h4 text-gray-900 mb-2">Sekolah Vokasi</h1>
                                    <h2 class="h4 text-gray-900 mb-4">Universitas Diponegoro</h2>
                                </div>
                                <?= $this->session->flashdata('message');  ?>
                                <div class="text-center">
                                </div>
                                <form class="user" method="post" action="<?= base_url('Auth');  ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= set_value('username');  ?>">
                                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>');  ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>');  ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>

                                <div class="text-center">
                                    <a class="btn btn-primary" href="<?= base_url() ?>">SIATA-VOKASI</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
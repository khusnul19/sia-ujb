                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('user') ?>">Dashboard</a>
                        </li>
                    </ol>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>

                    <div class="row">
                        <div class="col-lg-8">
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                    </div>



                    <div class="row">

                        <!-- Border Left Utilities -->
                        <div class="col-lg-12">

                            <div class="card mb-4 py-3 border-left-primary">
                                <div class="card-body">
                                    My Profile
                                    <div>
                                        <a href="<?php echo base_url("user/profil") ?>" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4 py-3 border-left-primary">
                                <div class="card-body">
                                    Pendataan TA
                                    <div>
                                        <a href="<?php echo base_url("user/pendataan_ta") ?>" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->
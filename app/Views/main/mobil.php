<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>/sb-admin-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>/sb-admin-2/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/sb-admin-2/css/main.css">

    <title>Data Mobil</title>
</head>

<body id="page-top">
    <div id="wrapper">

        <?php echo view('main/_partial/navbar', $navbar); ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php echo view('main/_partial/topbar', $topbar); ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Data Mobil
                        <?php if($level == 'admin') { ?>
                            <a href="<?=base_url('mobil/tambah')?>" class="btn btn-info"><i class="fas fa-plus"></i></a>
                        <?php } ?>
                    </h1>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                <?php
                                    $session = \Config\Services::session();

                                    if ($session->getFlashdata('success')) {
                                        echo '<div class="alert alert-success">' . $session->getFlashdata("success") . '</div>';
                                    }
                                    ?>
                                    <table class="table table-bordered" id="dataTable" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Mobil</th>
                                                <th>Merk</th>
                                                <th>Status</th>
                                                <th>#</th>
                                            </tr>
                                            <?php $i = 1; ?>
                                            <?php foreach ($mobil as $data) { ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td>
                                                        <?= $data->nama ?> </br>
                                                        <small>Rp. <?= number_format($data->harga, 2, ',', '.') ?> / Hari</small>
                                                    </td>
                                                    <td><?= $data->merk ?></td>
                                                    <td><span class="<?= $data->class ?>"><?= $data->status ?></span></td>
                                                    <td>
                                                        <?php if ($level == 'user') { ?>
                                                            <?php if ($data->status != 'Ready') { ?>
                                                                <button class="btn btn-sm btn-primary" disabled><i class="fa fa-book"></i> Book</button>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url('mobil/book/' . $data->id) ?>" class="btn btn-sm btn-primary"><i class="fa fa-book"></i> Book</a>
                                                            <?php } ?>
                                                            <a href="<?= base_url('mobil/detail/' . $data->id) ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Detail</a>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url('mobil/ubah/' . $data->id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pen"></i> Ubah</a>
                                                            <a href="<?= base_url('mobil/detail/' . $data->id) ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Detail</a>
                                                            <a href="<?= base_url('mobil/delete/' . $data->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin?')"><i class="fa fa-trash"></i> Hapus</a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo view('main/_partial/footer'); ?>
        </div>
    </div>

    <script src="<?= base_url() ?>/sb-admin-2/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/sb-admin-2/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= base_url() ?>/sb-admin-2/js/sb-admin-2.min.js"></script>
</body>

</html>
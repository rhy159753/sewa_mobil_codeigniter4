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

    <title>Tambah Mobil</title>
</head>

<body id="page-top">
    <div id="wrapper">

        <?php echo view('main/_partial/navbar', $navbar); ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php echo view('main/_partial/topbar', $topbar); ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Data Mobil > Tambah</h1>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <form action="<?= base_url('mobil/add') ?>" method="POST">
                                        <table class="table table-bordered" id="dataTable" cellspacing="0">
                                            <tr>
                                                <td>Merk</td>
                                                <td>
                                                    <select name="id_merk" id="id_merk" class="form-control" required="true">
                                                        <option value="">Pilih Merk</option>
                                                        <?php foreach ($merk as $data) { ?>
                                                            <option value="<?= $data->id ?>"><?= $data->merk ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nama Mobil</td>
                                                <td>
                                                    <input type="text" name="mobil" id="mobil" required="true" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Warna</td>
                                                <td>
                                                    <input type="text" name="warna" id="warna" required="true" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>No Polisi</td>
                                                <td>
                                                    <input type="text" name="nopol" id="nopol" required="true" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah Kursi</td>
                                                <td>
                                                    <input type="number" name="kursi" id="kursi" required="true" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tahun Beli</td>
                                                <td>
                                                    <input type="text" name="tahun" id="tahun" required="true" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Harga Sewa (Per Hari)</td>
                                                <td>
                                                    <input type="text" name="harga_str" id="harga_str" required="true" class="form-control">
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <button class="btn btn-success" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
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
    <script>
        var harga_str = document.getElementById('harga_str');
        harga_str.addEventListener('keyup', function(e) {
            harga_str.value = formatRupiah(this.value, 'Rp. ');
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),

                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah2 = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            rupiah1 = rupiah;
            return prefix == undefined ? rupiah2 : (rupiah2 ? 'Rp. ' + rupiah2 : '');
        }
    </script>
</body>

</html>
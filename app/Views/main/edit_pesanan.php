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

    <title>Edit Pesanan</title>
</head>

<body id="page-top">
    <div id="wrapper">

        <?php echo view('main/_partial/navbar', $navbar); ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php echo view('main/_partial/topbar', $topbar); ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Data Pesanan > Edit</h1>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <form action="#" id="book-form">
                                    <div style="display: none;" class="alert" id="notif"></div>
                                        <input type="hidden" name="pemesan" id="pemesan" value="<?= $user_id ?>">
                                        <table class="table table-bordered" id="dataTable" cellspacing="0">
                                            <?php $i = 1; ?>
                                            <?php foreach ($mobil as $data) {
                                                $harganya = $data->total;
                                            ?>
                                                <tr>
                                                    <td>
                                                        Nama Mobil - Merk <br /> Harga
                                                        <input type="hidden" name="id" id="id" value="<?= $data->id_pemesan ?>">
                                                        <input type="hidden" name="mobil" id="mobil" value="<?= $data->id ?>">
                                                    </td>
                                                    <td> <?= $data->nama ?> - <?= $data->merk ?> </br>
                                                        <small>Rp. <?= number_format($data->harga, 2, ',', '.') ?> / Hari</small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Rentang Tanggal</td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <input type="date" value="<?=$data->tgl_pinjam?>" name="tgl_pinjam" id="tgl_pinjam" required="required" autocomplete="off" class="form-control text-right">
                                                            </div>
                                                            <div class="col-md-2 text-center mt-2">
                                                                -
                                                            </div>
                                                            <div class="col-md-5">
                                                                <input type="date" value="<?=$data->tgl_kembali?>" name="tgl_kembali" id="tgl_kembali" required="required" autocomplete="off" class="form-control text-right">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Total</td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="hidden" name="days" id="days" value="0">
                                                                <input type="text" value="Rp. <?=number_format($data->total,0,',','.')?>" name="total_str" id="total_str" required="required" autocomplete="off" disabled class="form-control text-right">
                                                                <input type="hidden" value="<?=$data->total?>" name="total" id="total" required="required" autocomplete="off" class="form-control text-right">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Pembayaran</td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <select name="jebar" id="jebar" class="form-control">
                                                                    <?php foreach ($jenis_bayar as $data2) : ?>
                                                                    <?php if ($data->id_jenis_bayar == $data2->id) { ?>
                                                                        <option value="<?= $data2->id ?>"><?= $data2->jenis_bayar ?></option>
                                                                    <?php } else { ?>
                                                                        <option value="<?= $data2->id ?>"><?= $data2->jenis_bayar ?></option>
                                                                    <?php } ?>
                                                                        
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                        *Penyewa <b>WAJIB</b> Menyiapkan <b>KTP</b> untuk di data oleh resepsionis. <br />
                                        *Setelah mengisi rentang tanggal, harap menekan tombol Kalkulasi. <br />
                                        *Pembayaran harus lunas sebelum masuk awal rentang tanggal book. Baik secara <b>Cash</b>, maupun secara <b>Kredit</b>.
                                        <div class="row mt-5">
                                            <div class="col-md-12 text-right">
                                                <button type="submit" class="btn btn-primary" id="mySubmit">Submit</button>
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
        function getDays() {
            var start = $('#tgl_pinjam').val();
            var end = $('#tgl_kembali').val();
            var startDay = new Date(start);
            var endDay = new Date(end);
            var millisecondsPerDay = 1000 * 60 * 60 * 24;
            var millisBetween = endDay.getTime() - startDay.getTime();
            var days = (millisBetween / millisecondsPerDay) + 1;
            $('#days').val(Math.floor(days));

            var harga = parseInt("<?= $harganya ?>");
            var total = harga * Math.floor(days);
            $('#total').val(total);
            $('#total_str').val(formatRupiah(total.toString(),'Rp. '));
        }
        $(document).on('change', '#tgl_pinjam', function() {
            if ($('#tgl_kembali').val()) {
                getDays();
            }
        });
        $(document).on('change', '#tgl_kembali', function() {
            if ($('#tgl_pinjam').val()) {
                getDays();
            }
        });
        $(document).on('submit', '#book-form', function(e) {
            e.preventDefault();
            var
                mobil = $('#mobil').val(),
                mulai = $('#tgl_pinjam').val(),
                selesai = $('#tgl_kembali').val(),
                total = parseInt($('#total').val()),
                jebar = $('#jebar').val();

            $.ajax({
                url: '<?= base_url('pesanan/update') ?>',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $('#mySubmit').prop('disabled',true);
                },
                success: function(res) {
                    if(res.message == 'success') {
                        $('#notif').addClass('alert-success').fadeIn().html('Sukses Mengubah Pesanan. Tunggu Sebentar!');
                        setTimeout(function() {
                            window.location.href = "<?= base_url('pesanan') ?>";
                        },2000);
                    } else {
                        $('#mySubmit').prop('disabled',false);
                    }
                }
            });
        });
        function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
    </script>
</body>

</html>
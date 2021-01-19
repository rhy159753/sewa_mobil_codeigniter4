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

    <title>Register</title>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-md-center">

            <div class="col-6 mt-5">
                <div style="background-color: white;padding:3rem 5rem">
                    <h1 class="text-center pb-3">Daftar</h1>
                    <?php if (isset($validation)) : ?>
                        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                    <?php endif; ?>
                    <form action="/register/save" method="post">
                        <div class="mb-3">
                            <label for="InputForName" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="InputForName" value="<?= set_value('name') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="InputForEmail" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="InputForEmail" value="<?= set_value('email') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="InputForPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="InputForPassword">
                        </div>
                        <div class="mb-3">
                            <label for="InputForConfPassword" class="form-label">Confirm Password</label>
                            <input type="password" name="confpassword" class="form-control" id="InputForConfPassword">
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                    <br>
                    Sudah ada Akun ? <a href="login">Klik disini</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>

</html>
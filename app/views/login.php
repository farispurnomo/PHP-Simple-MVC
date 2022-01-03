<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>vendor/bootstrap-5.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">

</head>
<!-- By 201116019 - Faris Purnomo -->

<body>

    <main class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <img src="<?= BASE_URL . 'img/one-piece-logo-vector-0.png' ?>" alt="logo" width="100">
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Masuk</h1>
                            <form method="POST" action="<?= BASE_URL . 'login/login' ?>" autocomplete="off">
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="userid">ID Pengguna</label>
                                    <input id="userid" type="text" class="form-control" name="userid" required autofocus>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="password">Kata Sandi</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>

                                <div class="mb-3">
                                    <?= FlashData::getMessage('msg') ?>
                                </div>

                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-custom-primary ms-auto">
                                        Masuk
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer py-3 border-0">
                            <div class="text-center">
                                Tugas Pemrograman Web I
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-5 text-muted">
                        Copyleft &copy; 2022 &mdash; Faris Purnomo
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script src="<?= BASE_URL ?>/vendor/jquery/jquery-3.6.0.min.js"></script>
    <script src="<?= BASE_URL ?>vendor/popperjs/popper.min.js"></script>
    <script src="<?= BASE_URL ?>vendor/bootstrap-5.1.1/js/bootstrap.min.js"></script>
</body>

</html>
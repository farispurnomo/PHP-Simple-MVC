<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo CRUD</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>vendor/bootstrap-5.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
    <script src="<?= BASE_URL ?>/vendor/jquery/jquery-3.6.0.min.js"></script>
</head>
<!-- By 201116019 - Faris Purnomo -->

<body>

    <div class="container-fluid">
        <nav class="row" id="navbar">
            <div class="col-8 d-none d-md-block">
                <div class="d-flex h-100 align-items-center text-white">
                    <img width="60" height="60" class="img-fluid mx-4" src="<?= BASE_URL . 'img/one-piece-logo-vector-0.png' ?>" alt=""> &nbsp;<span class="fst-italic">Aplikasi CRUD Sederhana</span>
                </div>
            </div>
            <div class="col-4">
                <div class="dropdown d-flex h-100 align-items-center text-white justify-content-md-end">
                    <div type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img width="60" height="60" class="rounded-circle" src="<?= BASE_URL . ($_SESSION['user_avatar'] ?: 'img/avatar-placeholder.png') ?>" alt="">
                        Welcome, <?= $_SESSION['user_name'] ?: '-' ?>
                    </div>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="<?= BASE_URL . '/login/logout' ?>">Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="row min-vh-100 flex-column flex-sm-row">
            <aside class="col-12 col-md-2 p-0 flex-shrink-1" id="sidebar-wrapper">
                <nav class="navbar navbar-expand-md navbar-dark align-items-start flex-md-column flex-row p-0">
                    <a class="navbar-brand p-0 d-md-none m-2" href="#"><img width="50" height="50" class="img-fluid" src="<?= BASE_URL . 'img/one-piece-logo-vector-0.png' ?>" alt=""></a>
                    <a href class="navbar-toggler m-2" data-bs-toggle="collapse" data-bs-target=".sidebar">
                        <span class="navbar-toggler-icon"></span>
                    </a>
                    <div class="collapse navbar-collapse sidebar w-100">
                        <ul class="flex-column navbar-nav w-100 justify-content-between list-unstyled w-100 mb-5">
                            <li class="py-2 ps-4 ">
                                <a class="text-white " href="<?= BASE_URL . 'mahasiswa' ?>">
                                    <div>Mahasiswa</div>
                                </a>
                            </li>
                            <li class="py-2 ps-4 ">
                                <a class="text-white " href="<?= BASE_URL . 'user' ?>">
                                    <div>Pengguna</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </aside>

            <article class="col-md-10 bg-faded p-4">
                <?= $data['content'] ?>
            </article>

        </main>
    </div>

    <script src="<?= BASE_URL ?>vendor/popperjs/popper.min.js"></script>
    <script src="<?= BASE_URL ?>vendor/bootstrap-5.1.1/js/bootstrap.min.js"></script>
</body>

</html>
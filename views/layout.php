<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="{{app.url}}">
    <title>{{app.title}}</title>
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <link href="vendor/fortawesome/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="ui/css/style.css">
    <link rel="stylesheet" href="vendor/datatables.net/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-ttr fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">TESZT</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown"
                aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
                <li class="nav-item ms-2">
                    <a class="nav-link" href="celok" role="button">
                        <i class="fa-solid fa-bullseye"></i> Célok
                    </a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link" href="dolgozok" role="button">
                        <i class="fa-solid fa-users"></i> Dolgozók
                    </a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link" href="ertekeles" role="button">
                        <i class="fa-solid fa-award"></i> Dolgozók értékelése
                    </a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link" href="vegeredmeny" role="button">
                        <i class="fa-solid fa-square-poll-vertical"></i> Végeredmény
                    </a>
                </li>
                <li class="nav-item dropdown ms-2">
                    <a class="nav-link dropdown-toggle" href="#" id="m0" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i> Bejelentkezve: <?=(is_numeric($_user->id)?$_user->nev:"Senki")?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="mm0">
                        <?php foreach ($_vezetok as $index => $vezeto): ?>
                            <li><a class="dropdown-item" href="login?id=<?= $vezeto->id ?>"><?= $vezeto->nev ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid" id="content">
    <!--[content:content]-->
</div>
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.js"></script>
<script src="vendor/datatables.net/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables.net/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<!--[content:js]-->
</body>
</html>
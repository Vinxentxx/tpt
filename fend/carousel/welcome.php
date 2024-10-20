<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carousel Template · Bootstrap v5.0</title>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
             
            background-color: #f0f8ff; /* พื้นหลังสีฟ้า */
        
        }

        .bg-dark { background-color: #ff69b4 !important; }
        .navbar-brand, .nav-link, .footer-text { color: #fff !important; }
        .btn-outline-success { color: #87cefa; border-color: #87cefa; }
        .btn-outline-success:hover { background-color: #87cefa; color: #fff; }
        .carousel-caption h1 { color: #ff69b4; }
        .carousel-caption p { color: #87cefa; }
        .btn-primary { background-color: #ff69b4; border-color: #ff69b4; }
        .btn-primary:hover { background-color: #ff85c0; }
        .featurette-heading { color: #87cefa; }
        .lead { color: #ff69b4; }
        footer { background-color: #87cefa; color: #fff; }
        .footer-text a { color: #ff69b4 !important; }

        /* Custom styles for images */
        .rounded-image {
            border: 5px solid #ff69b4; /* Border color */
            border-radius: 20px; /* Rounded corners */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* Shadow effect */
            transition: transform 0.3s; /* Smooth hover effect */
        }

        .rounded-image:hover {
            transform: scale(1.05); /* Scale effect on hover */
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Tripletoys</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="shoponline.php">Product</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                    <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1">Disabled</a></li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                    <a href="logout.php" class="btn btn-secondary my-2">Login</a>
                </form>
            </div>
        </div>
    </nav>
</header>

<main>
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://global-static.popmart.com/globalAdmin/1728564251049____pc-1440_600____.jpg?x-oss-process=image/format,webp" class="d-block w-100">
                <div class="container carousel-caption text-start">
                    <h1>Example headline.</h1>
                    <p>Some representative placeholder content for the first slide.</p>
                    <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://prod-global-static.oss-us-east-1.aliyuncs.com/globalAdmin/1719177707770____download-5____.jpg?x-oss-process=image/format,webp" class="d-block w-100">
                <div class="container carousel-caption">
                    <h1>Another example headline.</h1>
                    <p>Some representative placeholder content for the second slide.</p>
                    <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://prod-global-static.oss-us-east-1.aliyuncs.com/globalAdmin/1719177703877____download-4____.jpg?x-oss-process=image/format,webp" class="d-block w-100">
                <div class="container carousel-caption text-end">
                    <h1>One more for good measure.</h1>
                    <p>Some representative placeholder content for the third slide.</p>
                    <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container marketing">
        <h1 style="color: darkred;">เเนะนำ</h1>
        <div class="row">
            <div class="col-lg-4">
                <img src="https://prod-eurasian-res.popmart.com/default/1_X8ltv4qiy2_1200x1200.jpg" class="bd-placeholder-img rounded-image" width="140" height="140">
                <h2>SKULLPANDA</h2>
                <p>Skullpanda อาร์ตทอยของศิลปิน Xiongmao ตัวอิตอันดับต้นๆ ของอาร์ตทอยด้วยความน่ารักในแบบเด็กผู้หญิง</p>
                <p>
                    <a href="vw.php?pt_id=2" class="btn btn-secondary" style="background-color: #D8BFD8; border-color: #D8BFD8;">View details &raquo;</a>
                </p>
            </div>
            <div class="col-lg-4">
                <img src="https://prod-thailand-res.popmart.com/default/20240731_171817_505119____1_____1200x1200.jpg" class="bd-placeholder-img rounded-image" width="140" height="140">
                <h2>MOLLY</h2>
                <p>น้องมอลลี่คือเด็กผู้หญิงสุดน่ารักจากคุณ Kenny Wong ศิลปินชาวฮ่องกง เอกลักษณ์คือการจือปาก</p>
                <p>
                    <a href="vw.php?pt_id=5" class="btn btn-secondary" style="background-color: #D8BFD8; border-color: #D8BFD8;">View details &raquo;</a>
                </p>
            </div>
            <div class="col-lg-4">
                <img src="https://prod-thailand-res.popmart.com/default/20240924_095748_398503____1_____1200x1200.jpg" class="bd-placeholder-img rounded-image" width="140" height="140">
                <h2>CRYBABY</h2>
                <p>Crybaby เป็นอาร์ตทอยที่สื่อถึงความรู้สึกของเด็กผู้หญิงที่รองไห ฝีมือจากศิลปินไทย</p>
                <p>
                    <a href="vw.php?pt_id=1" class="btn btn-secondary" style="background-color: #D8BFD8; border-color: #D8BFD8;">View details &raquo;</a>
                </p>
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">Single Box</h2>
                <p class="lead">สินค้าที่ออกแบบให้ผู้ซื้อไม่รู้ว่าจะได้ฟิกเกอร์ตัวใดจนกว่าจะเปิดกล่อง มีคาแรคเตอร์หลากหลายจากซีรีส์</p>
                <p class="lead">ฟิกเกอร์หายาก (Secret) ผลิตในจำนวนจำกัด</p>
                <p class="lead">กล่องสุ่มเป็นที่นิยมในหมู่นักสะสม</p>
                <p>
                    <a href="vw1.php?c_id=2" class="btn btn-secondary" style="background-color: #D8BFD8; border-color: #D8BFD8;">View details &raquo;</a>
                </p>
            </div>
            <div class="col-md-5">
                <img src="https://prod-thailand-res.popmart.com/default/20240625_101713_899251____8_____1200x1200.jpg" class="featurette-image img-fluid mx-auto rounded-image" width="500">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading">Box Set</h2>
                <p class="lead">Box set รับประกันว่าผู้ซื้อจะได้ฟิกเกอร์ครบทุกตัวในซีรีส์</p>
                <p class="lead">การซื้อ box set ลดความเสี่ยงในการได้ฟิกเกอร์ซ้ำ</p>
                <p>
                    <a href="vw1.php?c_id=1" class="btn btn-secondary" style="background-color: #D8BFD8; border-color: #D8BFD8;">View details &raquo;</a>
                </p>
            </div>
            <div class="col-md-5 order-md-1">
                <img src="https://prod-thailand-res.popmart.com/default/20240715_095521_842985_________1200x1200.jpg" class="rounded-image" width="500">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">MEGA</h2>
                <p class="lead">ฟิกเกอร์ขนาดใหญ่ที่ออกแบบมาเป็นพิเศษในคอเลกชัน</p>
                <p class="lead">ฟิกเกอร์ Mega มักมีการผลิตในจำนวนจำกัด</p>
                <p>
                    <a href="vw1.php?c_id=3" class="btn btn-secondary" style="background-color: #D8BFD8; border-color: #D8BFD8;">View details &raquo;</a>
                </p>
            </div>
            <div class="col-md-5">
                <img src="https://prod-thailand-res.popmart.com/default/20240702_165447_886235____4_____1200x1200.jpg" class="rounded-image" width="500">
            </div>
        </div>

        <hr class="featurette-divider">
    </div>

    <footer class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>&copy; 2017–2021 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>
</main>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php
session_start();
?>


<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <script src="../assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>TripleToys</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #ffffff; /* White background */
            font-family: 'Arial', sans-serif;
        }
        .header, .footer {
            background-color: #ff0000; /* Red background for header and footer */
            color: white;
        }
        h1, h4 {
            font-family: 'Georgia', serif;
            color: #fff; /* White text for headings */
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        h4 {
            margin-bottom: 10px;
        }
        .card {
            border: 2px solid #ff0000; /* Red border for cards */
            border-radius: .5rem;
            background-color: #ffffff; /* White background for cards */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05); /* Hover effect */
        }
        .card img {
            border-radius: .5rem .5rem 0 0;
            height: 400px;
            object-fit: cover;
            width: 100%;
        }
        .search-form {
            margin-top: 20px;
        }
        .btn-custom {
            background-color: #ff0000; /* Red button color */
            color: white;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #d50000; /* Darker red shade on hover */
        }
        .btn-secondary {
            background-color: #ffcccc; /* Light red for secondary button */
            color: white;
            font-weight: bold;
        }
        .btn-secondary:hover {
            background-color: #ff6666; /* Darker pink shade on hover */
        }
        .footer p {
            margin: 0;
        }
        .lead {
            font-size: 1.25rem;
            font-weight: 300;
            color: #555;
        }
        .card-text {
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
<header class="header">
    <div class="collapse text-bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4>TripleToys Shop</h4>
                    <p class="text-body-secondary">สินค้านำเข้าจาก official แท้</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4>ผู้ดูแลระบบ</h4>
                    <ul class="list-unstyled">
                    <?php echo isset($_SESSION['a_id']) ? $_SESSION['a_id'] : 'ADMIN'; ?>

                        
                        <li><a href="logout.php" class="text-white">ออกจากระบบ</a></li>
                        <li><a href="orders.php" class="text-white">ดูคำสั่งซื้อ</a></li>

                        <li><a href="customer.php" class="text-white">ข้อมูลลูกค้า</a></li>
                        <li><a href="admin_messages.php" class="text-white">ข้อความ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24">
                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                    <circle cx="12" cy="13" r="4"/>
                </svg>
                <strong>TripleToys</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>

<main>
    <section class="py-5 text-center container">
    <style>
    .rounded-image {
        border: 4px solid #ff0000; /* Red border around the image */
        border-radius: 50%;
        padding: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease-in-out;
    }

    .rounded-image:hover {
        transform: scale(1.1);
    }
    </style>

     <img src="logo.png" width="250" height="250">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">TripleToys</h1>
                <p class="lead">ร้านขาย Art Toy ของแท้ หลากหลาย collection สามารถเลือกสรรได้ตามใจชอบ</p>
                <p>
                    <a href="insert.php" class="btn btn-custom my-2">เพิ่มสินค้าใหม่</a>
                    <a href="logout.php" class="btn btn-secondary my-2">ออกจากระบบ</a>
                </p>
                <form method="post" action="" class="search-form">
                    <input type="text" name="search" class="form-control" placeholder="ค้นหาสินค้า" autofocus>
                    <button type="submit" name="Submit" class="btn btn-custom mt-2">OK</button>
                </form>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php
                include("connectdb.php");
                @$kw = $_POST['search'];
                $sql = "SELECT * FROM `product` WHERE (p_name LIKE '%{$kw}%' OR p_detail LIKE '%{$kw}%')";
                $rs = mysqli_query($conn, $sql);

                while ($data = mysqli_fetch_array($rs)) {
                ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="images/<?=$data['p_id'];?>.<?=$data['p_ext'];?>" class="card-img-top" alt="<?=$data['p_name'];?>" width="100%">
                            <div class="card-body">
                                <p class="card-text">
                                    <strong><?=$data['p_name'];?></strong><br>
                                    <?=number_format($data['p_price'], 0);?> บาท
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="update.php?pid=<?=$data['p_id'];?>" class="btn btn-sm btn-info">เเก้ไข</a>
                                        <a href="delete.php?pid=<?=$data['p_id'];?>&ext=<?=$data['p_ext'];?>" onClick="return confirm('ยืนยันการลบ?');" class="btn btn-sm btn-danger">ลบ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>

<footer class="footer py-5">
    <div class="container">
        <p class="float-end mb-1">
            <a href="#" class="text-white">Back to top</a>
        </p>
        <p class="mb-1">TripleToys &copy; 2024</p>
    </div>
</footer>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

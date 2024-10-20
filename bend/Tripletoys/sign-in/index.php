<?php
session_start();
include_once("../album/connectdb.php");
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <script src="../assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Admin - TripleToys</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #ffffff; /* White background */
            color: #d50000; /* Dark red text */
        }

        .form-signin {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center items horizontally */
            justify-content: center; /* Center items vertically */
            width: 100%;
            max-width: 400px;
            padding: 15px;
            margin: auto;
            background-color: #f8d7da; /* Light red background */
            border-radius: 15px; /* Rounded corners */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Box shadow for depth */
        }

        h1 {
            color: #d50000; /* Dark red */
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #d50000; /* Dark red */
            border-color: #b00000; /* Slightly darker red */
        }

        .btn-primary:hover {
            background-color: #b00000; /* Darker red on hover */
            border-color: #a00000; /* Darker border */
        }

        .form-control {
            border: 1px solid #d50000; /* Dark red border */
        }

        .form-control:focus {
            border-color: #b00000; /* Darker border on focus */
            box-shadow: 0 0 5px rgba(213, 0, 0, 0.5); /* Light red shadow on focus */
        }

        .form-check-label {
            color: #d50000; /* Dark red */
        }

        .text-body-secondary {
            color: #6c757d; /* Use a neutral color for the copyright notice */
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="sign-in.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">

    <main class="form-signin">
        <form method="post" action="">
            <img class="mb-4" src="../assets/brand/Image_25671008_175538_294.png" alt="" width="150" height="150" style="display: block; margin: 0 auto;">
            <h1 class="h3 mb-3 fw-normal">TripleToys</h1>

            <div class="form-floating">
                <input type="text" class="form-control" name="ausername" placeholder="Username" autofocus required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="apassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">Remember me</label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit" name="Submit">Sign in</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2024</p>
        </form>
    </main>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    if (isset($_POST['Submit'])) {
        $sql = "SELECT * FROM `admin` WHERE `a_username`='{$_POST['ausername']}' AND a_password='" . md5($_POST['apassword']) . "'";
        $rs = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($rs);

        if ($num > 0) {
            $data = mysqli_fetch_array($rs);
            $_SESSION['aid'] = $data['a_id'];
            $_SESSION['aname'] = $data['a_name'];
            echo "<script>";
            echo "window.location = '../album/index.php';";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert('Username หรือ Password ไม่ถูกต้อง');";
            echo "</script>";
            exit;
        }
    }
    ?>
</body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>รายการข้อมูลลูกค้า</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff; /* White background */
        }
        h1 {
            color: #d50000; /* Red */
            text-align: center;
            margin: 20px 0;
        }
        .table-container {
            margin: auto;
            width: 80%; /* Set table width */
            background-color: #ffffff;
            border-radius: 15px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow */
            padding: 20px;
        }
        table {
            margin: auto;
            width: 100%;
        }
        th, td {
            text-align: center; /* Center align text */
            vertical-align: middle;
        }
        thead th {
            background-color: #ffcccc; /* Light red for the header */
            color: #d50000; /* Dark red text */
        }
        .btn-custom {
            background-color: #d50000; /* Red button */
            color: white; /* White text */
        }
        .btn-custom:hover {
            background-color: #b00000; /* Darker red on hover */
        }
        .btn-danger {
            background-color: #ff4d4d; /* Red for delete button */
            color: white; /* White text */
        }
        .btn-danger:hover {
            background-color: #ff1a1a; /* Darker red on hover */
        }
        .btn-warning {
            background-color: #ffc107; /* Yellow for edit button */
            color: black; /* Black text */
        }
        .btn-warning:hover {
            background-color: #e0a800; /* Darker yellow on hover */
        }
        .table-bordered {
            border: 2px solid #dee2e6; /* Border around the table */
        }
        th, td {
            border: 1px solid #dee2e6; /* Border around cells */
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1>รายการข้อมูลลูกค้า</h1>
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                        <th>รหัสลูกค้า</th>
                        <th>ชื่อลูกค้า</th>
                        <th>นามสกุล</th>
                        <th>เบอร์โทรติดต่อ</th>
                        <th>ที่อยู่</th>
                        <th>อีเมล</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("connectdb register.php");
                    $sql = "SELECT * FROM customer ORDER BY cr_id DESC";
                    $rs = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_array($rs, MYSQLI_ASSOC)) { // Use MYSQLI_ASSOC for easy array access
                    ?>
                    <tr>
                        <td>
                            <a href="edit_customer.php?id=<?=$data['cr_id'];?>" class="btn btn-warning btn-sm">แก้ไข</a>
                        </td>
                        <td>
                            <a href="delete_customer.php?id=<?=$data['cr_id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณแน่ใจหรือว่าต้องการลบลูกค้าคนนี้?');">ลบ</a>
                        </td>
                        <td><?=$data['cr_id'];?></td>
                        <td><?=$data['cr_name'];?></td>
                        <td><?=$data['cr_last'];?></td>
                        <td><?=$data['cr_tel'];?></td>
                        <td><?=$data['cr_add'];?></td>
                        <td><?=$data['cr_mail'];?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<link href="../assets/templatemo-personal-style.css" rel="stylesheet">
<?php
require_once '../config.php';
if (!isset($_SESSION['usename']) and isset($_SESSION["isauthenticated"]) == false) {
    header("Location: index.php");
    exit();
}
require_once '../includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/templatemo-personal-style.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fb;
        }

        .main {
            margin-left: auto;
            padding: 30px;
        }

        .card-box {
            padding: 25px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }

        .student-table img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        #ad {
            margin-top: 60px;
        }
    </style>
</head>

<body>

    <div class="card-box mb-4">
        <h4 id='ad' class="mb-3"><a class="btn btn-sm btn-success" href="add_student.php">Add Student</a></h4>
        <h4 id='ad' class="mb-3"><a class="btn btn-sm btn-success" href="add_student.php">Add Student</a></h4>
    
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php require_once '../includes/footer.php'; ?>
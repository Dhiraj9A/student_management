<?php
require_once 'config.php';
if (!isset($_SESSION['usename']) and isset($_SESSION["isauthenticated"]) == false) {
    header("Location: index.php");
    exit();
}
require_once 'includes/header.php';
// require_once 'students/students.php';

?>
<?php
require_once 'config.php';
if (!isset($_SESSION['usename']) || $_SESSION['isauthenticated'] == false) {
    header("Location: index.php");
    exit();
}
$sql = "SELECT COUNT(*) AS total_students FROM students";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_students = $row['total_students'];

$sql1 = "SELECT COUNT(*) AS total_classes FROM classes";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();
$total_classes = $row1['total_classes'];

$sql2 = "SELECT COUNT(DISTINCT section) AS total_sections FROM classes";
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();
$total_sections = $row2['total_sections'];
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
    </style>
</head>

<body>
    <!-- Main Content -->
    <div class="main">
        <h2 class="mb-4 fw-bold">Dashboard Overview</h2>

        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card-box text-center">
                    <h4>Total Students</h4>
                    <h2 class="text-primary fw-bold"><?= $total_students ?></h2>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card-box text-center">
                    <h4>Total Classes</h4>
                    <h2 class="text-success fw-bold"><?= $total_classes ?></h2>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card-box text-center">
                    <h4>Total Sections</h4>
                    <h2 class="text-danger fw-bold"><?= $total_sections ?></h2>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card-box text-center">
                    <h4>Teachers</h4>
                    <h2 class="text-warning fw-bold">18</h2>
                </div>
            </div>
        </div>

        <div class="card-box mb-4">
            <h4 class="mb-3">Recent Students</h4>
            <table class="table student-table">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <?php
                $sql4 = "SELECT * FROM students ORDER BY id DESC LIMIT 5";
                $result4 = $conn->query($sql4);
                ?>
                <tbody>
                    <?php if ($result4->num_rows > 0) {
                        while ($row = $result4->fetch_assoc()) { ?>

                            <tr>
                                <td>
                                    <?php
                                    $photo = $row['photo'];

                                    $uploadPath = "uploads/";
                                    $defaultImg = "default.jpeg";

                                    if (!empty($photo) && file_exists($uploadPath . $photo)) {
                                        $src = $uploadPath . $photo;
                                    } else {
                                        $src = $defaultImg;
                                    }
                                    ?>
                                    <img src="<?php echo $src; ?>"
                                        alt="Photo" style="width:40px; height:40px; border-radius:50%;">
                                </td>

                                <td><?php echo htmlspecialchars($row['name']); ?></td>

                                <td>
                                    <a href="#">
                                        <?php
                                        echo isset($row['email']) ? $row['email'] : '--';
                                        ?>
                                    </a>

                                </td>
                                <td>
                                    <?php
                                    echo isset($row['phone']) ? $row['phone'] : '--';
                                    ?>
                                </td>
                            </tr>

                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="5" class="text-center">No Recent Students Found</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php require_once 'includes/footer.php'; ?>
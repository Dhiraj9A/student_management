<link href="../assets/templatemo-personal-style.css" rel="stylesheet">
<?php
require_once '../config.php';
if (!isset($_SESSION['usename']) and isset($_SESSION["isauthenticated"]) == false) {
    header("Location: index.php");
    exit();
}
require_once '../includes/header.php';
// delete student 
if (isset($_REQUEST['sid']) && !empty($_REQUEST['sid'])) {
    $sid = intval($_REQUEST['sid']);
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $sid);

    if ($stmt->execute()) {
        echo "<script>alert('Record deleted successfully')</script>";
    } else {
        echo "<script>alert('deleted failed')</script>";
    }
    $stmt->close();
}

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
        <table id="mytable" class="table student-table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Created On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            $sql4 = "select * from students order by id desc";
            $result4 = $conn->query($sql4);
            ?>
            <tbody>
                <?php if ($result4->num_rows > 0) {
                    while ($row = $result4->fetch_assoc()) {
                ?>

                        <tr>
                            <td>
                                <?php
                                $photo = $row['photo'];

                                $uploadPath = "../uploads/";
                                $defaultImg = "../default.jpeg";

                                if (!empty($photo) && file_exists($uploadPath . $photo)) {
                                    $src = $uploadPath . $photo;
                                } else {
                                    $src = $defaultImg;
                                }

                                // echo "$src";
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
                                <?php echo isset($row['phone']) ? $row['phone'] : ''; ?>
                            </td>
                            <td>
                                <?php echo isset($row['address']) ? $row['address'] : '--'; ?>
                            </td>
                            <td>
                                <?php echo isset($row['gender']) ? $row['gender'] : '--'; ?>
                            </td>
                            <td>
                                <?php echo isset($row['created_at']) ? $row['created_at'] : ''; ?>
                            </td>

                            <td>
                                <a href="update_student.php?sid=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Update</a>
                                <a href="students.php?sid=<?= $row['id']; ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?');">
                                    Delete
                                </a>
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

<?php require_once '../includes/footer.php'; ?>
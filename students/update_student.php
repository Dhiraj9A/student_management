<?php
require_once '../config.php';
if (!isset($_SESSION['usename']) and isset($_SESSION["isauthenticated"]) == false) {
    header("Location: index.php");
    exit();
}
require_once '../includes/header.php';

if (isset($_POST['id'])) {

    $id      = $_POST['id'];
    $name    = $_POST['name'];
    $address = $_POST['address'];
    $gender  = $_POST['gender'];
    $dob     = $_POST['dob'];
    $photo = $_POST['old_photo'];

    $photo = $_POST['old_photo'];

    if (!empty($_FILES['photo']['name'])) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            die("Invalid file type!");
        }

        $upload_path = "../uploads/";

        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $newName = time() . "_" . rand(1000, 9999) . "." . $ext;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload_path . $newName)) {
            $photo = $newName;
        } else {
            die("Failed to upload image!");
        }
    }
    $stmt = $conn->prepare("
    UPDATE students 
    SET name=?, address=?, gender=?, dob=?, photo=? 
    WHERE id=?
");

    $stmt->bind_param("sssssi", $name, $address, $gender, $dob, $photo, $id);

    if ($stmt->execute()) {
        echo "<script>
    alert('Student Updated successfully');
    window.open('students.php','_self');
    </script>";
    } else {
        echo "<script>
    alert('Student Updated failed');
    window.open('students.php','_self');
    </script>";
    }

    $stmt->close();
}
if (isset($_REQUEST['sid'])) {

    $id      = $_REQUEST['sid'];
    $sql = "SELECT * FROM students where id=" . $id;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Form</title>
    <style>
        :root {
            --max-width: 750px;
            --accent: #246;

        }

        .card {
            background: #fff;
            width: 100%;
            height: 450px;
            max-width: var(--max-width);
            margin-left: 300px;
            border-radius: 5px;
            box-shadow: 0 6px 20px rgba(20, 30, 60, 0.08);
            padding: 20px;
            margin-top: 60px;
        }

        form {
            display: grid;
            gap: 12px;
        }

        .row {
            display: flex;
            gap: 12px;
        }

        .col {
            flex: 1;
        }

        label {
            display: block;
            font-size: 13px;
            margin-bottom: 6px;
            color: #333;
        }

        input[type=text],
        input[type=email],
        input[type=tel],
        input[type=date],
        input[type=datetime-local],
        textarea,
        select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #d7dbe0;
            border-radius: 8px;
            font-size: 14px;
        }

        .small {
            font-size: 12px;
            color: #666;
        }

        .actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
            margin-top: 8px;
        }

        button {
            padding: 8px 14px;
            border-radius: 10px;
            border: 0;
            cursor: pointer;
        }

        button.primary {
            background: var(--accent);
            color: #fff;
        }

        button.ghost {
            background: transparent;
            border: 1px solid #e0e6ea;
        }


        .field-note {
            font-size: 12px;
            color: #666;
        }

        .inline {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        @media (max-width:640px) {
            .row {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <h1 style="text-align:center;">Student Update</h1>
        <form action="update_student.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <label for="name">Full Name <span class="small">*</span></label>
                    <input id="name" name="name" value="<?= $row['name'] ?>" type="text" required placeholder="e.g. Dhiraj Kumar" />
                </div>
                <div class="col">
                    <label for="address">address<span class="small">*</span></label>
                    <input id="address" name="address" value="<?= $row['address'] ?>" type="text" required placeholder="address" />
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="dob">Date of Birth</label>
                    <input id="dob" value="<?= $row['dob'] ?>" name="dob" type="date" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Gender</label>
                    <div class="inline">
                        <label><input type="radio" name="gender" value="Male" <?php if ($row['gender'] == "Male") {
                                                                                    echo "checked";
                                                                                } ?>> Male</label>
                        <label><input type="radio" name="gender" value="Female" <?php if ($row['gender'] == "Female") {
                                                                                    echo "checked";
                                                                                } ?>> Female</label>
                    </div>
                </div>

                <div class="col">
                    <label for="photo">Photo</label>
                    <div style="display:flex;gap:10px;align-items:center;">
                        <input id="photo" name="photo" type="file" accept="image/*" />
                        <?php
                        if (file_exists("../uploads/" . $row['photo'])) {
                            $src = "../uploads/" . $row['photo'];
                        } else {
                            $src = "../default.jpeg";
                        }
                        ?>
                        <img src="<?php echo $src; ?>"
                            alt="Photo" style="width:40px; height:40px; border-radius:50%;">
                    </div>
                </div>
            </div>
            <div class="actions">
                <input type="hidden" name="id" value="<?= $_REQUEST['sid']; ?>" />
                <button type="submit" class="primary">Save Student</button>
            </div>
        </form>
    </div>
</body>

</html>
<?php require_once '../includes/footer.php'; ?>
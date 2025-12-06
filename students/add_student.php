<?php
require_once '../config.php';
if (!isset($_SESSION['usename']) and isset($_SESSION["isauthenticated"]) == false) {
    header("Location: index.php");
    exit();
}
require_once '../includes/header.php';
if (isset($_POST['add_student'])) {
    $name    = $_POST['name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $address = $_POST['address'];
    $gender  = $_POST['gender'];
    $dob     = $_POST['dob'];

    $sql = "INSERT INTO students (name, email, phone, address, gender, dob)
        VALUES ('$name', '$email', '$phone', '$address', '$gender', '$dob')";

    
    if($conn->query($sql)){
        echo "<script>
    alert('Student added successfully');
    window.open('students.php','_self');
    </script>";
    } else {
        echo "<script>
    alert('Student added failed');
    window.open('students.php','_self');
    </script>";
    
    }
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
        <h1 style="text-align:center;">Add Student</h1>
        <form action="add_student.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <label for="name">Full Name <span class="small">*</span></label>
                    <input id="name" name="name" type="text" required placeholder="e.g. Dhiraj Kumar" />
                </div>
                <div class="col">
                    <label for="email">Email<span class="small">*</span></label>
                    <input id="name" name="email" type="email" required placeholder="e.g. student212@gmail.com" />
                </div>
                <div class="col">
                    <label for="address">address<span class="small">*</span></label>
                    <input id="address" name="address" type="text" required placeholder="e.g. noida" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="phone">Phone<span class="small">*</span></label>
                    <input id="name" name="phone" type="text" required placeholder="e.g. 9339291091" />
                </div>
                <div class="col">
                    <label for="dob">Date of Birth</label>
                    <input id="dob" name="dob" type="date" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Gender</label>
                    <div class="inline">
                        <label><input type="radio" name="gender" value="Male"> Male</label>
                        <label><input type="radio" name="gender" value="Female"> Female</label>
                    </div>
                </div>
            </div>
            <div class="actions">
                <button type="submit" name="add_student" class="primary">Save Student</button>
            </div>
        </form>
    </div>
</body>

</html>
<?php require_once '../includes/footer.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management | Dashboard</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link href="assets/templatemo-personal-style.css" rel="stylesheet">

    <!--

TemplateMo 593 personal shape

-->
</head>

<body>
    <!-- Navigation -->
    <nav id="navbar">
        <div class="nav-container">
            <div class="logo">Student Management</div>
            <ul class="nav-links">
                <li><a href="/student_management/dashboard.php">Dashboard</a></li>
                <li><a href="/student_management/students/students.php">Students</a></li>
                <li><a href="/student_management/classes/show_classes.php">Classes</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            <div class="mobile-menu-toggle" id="mobileMenuToggle">
                <div class="hamburger"></div>
                <div class="hamburger"></div>
                <div class="hamburger"></div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <ul class="mobile-nav-links">
            <li><a href="/student_management/dashboard.php">Dashboard</a></li>
            <li><a href="/student_management/students/students.php">Students</a></li>
            <li><a href="#classes">Classes</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
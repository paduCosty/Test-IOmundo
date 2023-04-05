<?php
$resp = '';
require_once '../controllers/RegistrationsController.php';
$filter_data = '';
if (isset($_GET) && $_GET) {
    $filter_data = $_GET;
}
$registrationsController = new RegistrationsController();
$registrations = $registrationsController->show_registrations($filter_data);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>My Application</title>
</head>
<body>
<h1>My Application</h1>
<form method="get">
    <input type="text" name="name" id="name_filter"
           value="<?php if (isset($_GET['name']) && $_GET['name']) print $_GET['name']; ?>"
           placeholder="Filter by Name...">
    <input type="email" name="email" id="email_filter"
           value="<?php if (isset($_GET['email']) && $_GET['email']) print $_GET['email']; ?>"
           placeholder="Filter by Email...">
    <button type="submit">Filter</button>
    <input type="button" id="reset_filters" value="Reset" style="background-color: red">
</form>
<table>
    <thead>
    <tr>
        <th>Image</th>
        <th>Email</th>
        <th>Name</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($registrations)) {
        foreach ($registrations as $registration) { ?>
            <tr>
                <td><img src="<?php echo $registration['image']; ?>" alt=""></td>
                <td><?php echo $registration['email']; ?></td>
                <td><?php echo $registration['name']; ?></td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="3">No registrations found.</td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>

<script>
    $(document).ready(function () {
        $('#reset_filters').click(function () {
            $('#name_filter').attr('value', '');
            $('#email_filter').attr('value', '');
            window.history.replaceState({}, document.title, window.location.pathname);
            location.reload();
        });
    });
</script>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
    }

    h1 {
        text-align: center;
        margin-top: 30px;
    }

    form {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 30px;
    }

    input[type="text"], input[type="email"] {
        padding: 10px;
        margin: 0 10px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        background-color: #ffffff;
        box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);
        width: 200px;
    }

    button[type="submit"], input[type="button"]{
        background-color: #1abc9c;
        color: #fff;
        font-size: 16px;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
        margin-left: 10px;
    }

    button[type="submit"]:hover {
        background-color: #148f77;
    }

    table {
        margin-top: 30px;
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #1abc9c;
        color: #fff;
    }

    img {
        max-width: 50px;
        max-height: 50px;
        border-radius: 50%;
    }

    @media (max-width: 768px) {
        input[type="text"], button[type="submit"] {
            width: 100%;
            margin: 10px 0;
        }
    }
</style>
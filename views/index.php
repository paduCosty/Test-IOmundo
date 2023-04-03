<?php

if ($_POST) {
    require_once '../controllers/RegistrationsController.php';

    $registrationsController = new RegistrationsController();
    $resp = $registrationsController->create_registration($_POST);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Formular</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="u-sheet u-sheet-1">

    <form id="form" method="POST">
        <div class="u-image"></div>

        <div class="u-form-group">
            <label for="email">Email:</label>
            <input type="email" placeholder="Enter a valid email address" id="email" class="u-input" name="email"
                   required>
        </div>

        <div class="u-form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your Name" class="u-input" required>
        </div>

        <div class="u-form-group">
            <input type="checkbox" id="consent" name="consent" class="u-checkbox">
            <label for="consent">I accept the <a style="color: #7d47c9" href="..."> Terms of Service: </a></label>
        </div>

        <div class="u-form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" class="u-input" required>
        </div>

        <?php if ($resp['status']) { ?>
            <h1> <?php echo $resp['message']?></h1>
        <?php } else { ?>
            <h1> <?php echo $resp['message']?></h1>
        <?php } ?>

        <div class="u-form-group">
            <input type="submit" value="Submit" class="u-btn u-btn-submit u-button-style">
        </div>
    </form>
</div>
</body>
</html>

<style>
    .u-form-agree {
        margin-bottom: 15px;
        padding-left: 15px;
        display: flex;
        align-items: baseline;
        /*margin-left: 0;*/
    }

    .u-form-group {
        margin-left: 0;
        margin-bottom: 15px;
        width: 100%;
        text-align: start;
    }

    .u-sheet {
        max-width: 720px;
        margin: 0 auto;
    }

    .u-image {
        width: 404px;
        height: 404px;
        max-width: 100%;
        max-height: 100%;
        background-position: 50% 50%;
        background-image: url("https://images01.nicepage.com/a1389d7bc73adea1e1c1fb7e/730d22eb64cb5e83a9e570be/pexels-photo-10435040.jpeg");
        border-radius: 50% !important;
        color: #111111;
        object-fit: cover;
        display: block;
        vertical-align: middle;
        background-size: cover;
        background-repeat: no-repeat;
        margin-right: 20px;
    }

    /* Style pentru formular */
    form {
        max-width: 600px;
        margin: 0 auto;
    }

    /* Style pentru butonul de submit */
    .u-btn-submit {
        background-color: #7d47c9;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.2rem;
    }

    /* Style pentru input-uri */
    input[type="text"], input[type="email"], input[type="file"] {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: none;
        border-radius: 5px;
        background-color: #f2f2f2;
        font-size: 1rem;
    }

    /* Reguli de media query pentru dispozitive mobile */
    @media only screen and (max-width: 600px) {
        .u-sheet {
            max-width: 100%;
            padding: 0 10px;
        }

        .u-image {
            margin-top: 20px;
        }
    }

    .u-checkbox {
        width: 15px;
        height: 15px;
        padding: 0;
        margin: 0;
        vertical-align: bottom;
        position: relative;
        top: -1px;
    }

</style>
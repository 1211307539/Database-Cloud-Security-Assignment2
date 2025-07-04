<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heather</title>

    <style>
        body {
            background: rgba(172, 222, 238, 0.93);
            display: flex;
            justify-content: center;
            align-items: center;
            color: black;
            height: 95vh;
        }

        * {
            font-family: Inria Serif;
        }

        div {
            text-align: center;
            font-weight: 700;
            font-size: 120px;
            padding-bottom: 0px;
        }

        #greeting {
            text-align: center;
            font-size: 30px;
            padding-bottom: 0px;
            margin-top: 0px;
        }

        form {
            background: white;
            width: 500px;
            border: 2px;
            padding: 60px 150px 40px 150px;
            text-align: center;
        }

        input {
            display: block;
            border: 2px solid #ccc;
            width: 80%;
            padding: 10px;
            margin: 10px auto;
        }

        button {
            margin-top: 10px;
            padding: 5px 25px;
            font-size: 15px;
        }

        h4 {
            padding-top: 15px;
            font-size: 20px;
            text-decoration: underline;
        }

        .error {
            padding: 5px;
            background-color: #F2DEDE;
            color: #A94442;
            width: fit-content;
            margin: auto;
            border-radius: 5px;
        }
    </style>

</head>

<body>
    <form action="adminLogin.php" method="post">
        <div>Heather</div>
        <p id="greeting">Welcome Back, <strong>Admin</strong>.</p>

        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <input type="text" name="email" placeholder="Email or Phone Number"><br>
        <input type="password" name="password" placeholder="Password"><br>

        <button type="submit">Login</button>

        <h4 style="cursor: pointer;" onclick="redirectRegisterAdminPage()">Register as admin</h4>
    </form>

    <script>
        function redirectRegisterAdminPage() {
            window.location.href = 'adminRegistrationPage.php';
        }
    </script>


</body>
</html>

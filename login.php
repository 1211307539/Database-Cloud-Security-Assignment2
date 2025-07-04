<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heather</title>
    <link rel="icon" href="img/icon.ico" type="image/x-icon">
    
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            overflow: hidden;
        }

        .left-half {
            width: 50%;
            background-color: powderblue;
            color: black;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-half {
            width: 50%;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .input-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 15px;
            width: 500px;
            position: relative;
            transform: translateY(155%);

        }

        .input-bar {
            margin-top: 10px;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
        }

        .login-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .login-button {
            margin-top: 2px;
            padding: 5px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transform: translateY(540%);
        }

        .forgotpass-button {
            text-decoration: none;
            color: #3498db;
            transition: color 0.3s ease-in-out;
            transform: translateY(540%);
        }

        .forgotpass-button:hover {
            color: #2874a6; 
        }

        .create-new-account {
            padding: 5px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        .new-user-text {
            text-align: center;
            font-size: 18px;
            margin-top: 300px; 
            transform: translateY(100%);
        }

        .error {
            padding: 5px;
            background-color: #F2DEDE;
            color: #A94442;
            width: 490px;
            border-radius: 5px;
            transform: translateY(600%);
        }
    </style>
</head>

<body>
    <div class="left-half">
        <h1 style="font-size:21px;">Welcome To</h1>
        <a href="homepage.php" style="text-decoration: none; color: black;">
            <h1 style="font-size:100px; line-height:30%; margin-bottom:25px; margin-top: 10px;">Heather‧࿐࿔ </h1>
        </a>
        <h2 style="font-size:22px;">Find the right cohabitation for you.</h2>
    </div>

    <div class="right-half">
        <form action="userLogin.php" method="POST">
            
          <?php if (isset($_GET['error'])) { ?>
              <p class="error"><?php echo $_GET['error']; ?></p>
          <?php } ?>

            <div class="input-container">
                <input type="text" name="email" class="input-bar" placeholder="Email or Phone Number">
                <input type="password" name="password" class="input-bar" placeholder="Password">
            </div>
            <div class="login-container">
                <button type="submit" class="login-button">Log In</button>
                <a href="#" class="forgotpass-button">Forgot Password?</a>
            </div>
        </form>
        <p class="new-user-text">New Heather User?</p>
        <button class="create-new-account" onclick="redirectRegisterPage()" type="button">Create Your Account</button>
    </div>

    <script>
        function redirectRegisterPage() {
            window.location.href = 'register.php';
        }
    </script>
</body>
</html>

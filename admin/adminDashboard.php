<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heather</title>

    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Inria Serif;
            overflow: hidden;
        }

        header {
            background-color: #ACDEEE;
            padding-left: 10px;
            border: 0.5px solid #333;
            font-size: 28px;
        }

        .container{
            display: flex;
            height: 100vh; /* 100% of viewport height */
        }

        nav {
            width: 300px;
            height: 100%;
            background-color: #ACDEEE;
            overflow-x: hidden;
            padding-top: 20px;
        }

        nav a {
            padding: 15px;
            text-decoration: none;
            font-size: 30px;
            color: #333;
            display: block;
        }

        .box a:link, .box a:visited{
            text-decoration: none;
            color: #333;
        }

        nav a:hover, .box a:hover{
            text-decoration: underline;
        }


        .content {
            /* margin-left: 220px; */
            flex: 1;
            padding: 20px;
        }

        .sidebar-image {
            padding-right: 10px;
        }

        .logout{
            margin-top: 360px;
        }

        .page-header{
            font-size: 40px;
            margin-left: 50px;
            margin-bottom: 0px;
        }

        .container .content .cards{
            padding: 20px 10px;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            flex-wrap: wrap;
        }

        .container .content .cards .card{
            font-size: 40px;
            width: 400px;
            height: 200px;
            background: #E6E6E6;
            margin: 20px 5px;
            text-align: center;
        }

        .box{
            position: relative;
            margin-top: 10vh;
            min-height: 90vh;
        }

    </style>
</head>
<body>

<header>
    <h1>Heather</h1>
</header>

<div class="container">
    <nav>
        <a href="#dashboard"><img class="sidebar-image" src= "../img/dashboard.png" width="35px" >Dashboard</a>
        <a href="#approvals" onclick="redirectPage('approvalList')"><img class="sidebar-image" src= "../img/form.png" width="25px" style="padding-right:15px">Approvals</a>
        <a href="#users" onclick="redirectPage('userList')"><img class="sidebar-image" src= "../img/users.png" width="25px" style="padding-right:20px">Users</a>
        <a href="#properties" onclick="redirectPage('propertyList')"><img class="sidebar-image" src= "../img/property.png" width="25px" style="padding-right:20px">Properties</a>
        <a href="#logout" class="logout" style="border-top: 0.5px solid #333" onclick="redirectPage('adminLoginPage')"><img class="sidebar-image" src= "../img/settings.png" width="25px" style="padding-right:20px">Log out</a>
    </nav>

    <div class="content">
        <p class="page-header">Dashboard</p>
            <div class="cards">
                <div class="card">
                    <div class="box">
                        <a href="#approvals" onclick="redirectPage('approvalList')">Approvals</a>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <a href="#users" onclick="redirectPage('userList')">Users</a>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <a href="#properties" onclick="redirectPage('propertyList')">Properties</a>
                    </div>
                </div>
            </div>
    </div>
</div>

<script src="../redirectPage.js"></script>

</body>
</html>

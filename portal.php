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
        }

        header {
            background-color: powderblue;
            padding: 20px;
            margin: 0;
            color: black;
            box-sizing: border-box;
            height: 200px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .header-buttons {
            display: flex;
            gap: 20px;
            margin-left: auto;
            margin-top: 90px;
            font-size: 20px;
        }

        .button {
            padding: 0;
            border: none;
            cursor: pointer;
            background-color: transparent;
        }

        .button img {
            width: 40px;
            height: 40px;
        }

        .underline-button {
            position: relative;
            text-decoration: none;
            color: black;
        }

        .underline-button::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 2px;
            background-color: #3498db;
            transform: scaleX(0);
            transform-origin: 100%;
            transition: transform 0.3s ease-in-out;
        }

        .underline-button:hover::after {
            transform: scaleX(1);
            transform-origin: 0%;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: hsl(155, 83%, 69%);
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 0;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-item {
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            color: black;
        }

        .dropdown-item:hover {
            background-color: hsl(162, 68%, 49%);
        }

        .header-left {
            position: absolute;
            top: 190px; 
            left: 20px;
            font-size: 20px;
        }

        .container {
            padding-top: 55px;
            padding-left: 20px;
            border-radius: 5px;
            font-size: 20px;
            align-items: center;
        }

        input[type=text], textarea {
            background-color: rgb(205, 205, 205);
            border: 0px;
            padding: 10px;
            margin: 0;
            width: 90%;
            resize: vertical;
        }

        input:placeholder-shown {
            font-style: italic;
        }

        input[type=radio] {
            padding: 10px;
            margin: 0;
        }

        .col-15 {
            float: left;
            width: 15%;
            margin-top: 6px;
        }

        .col-65 {
            float: left;
            width: 65%;
            margin-top: 6px;
        }

        .col-45 {
            float: left;
            width: 45%;
            margin-top: 6px;
        }

        input[type=submit]{
            background-color: powderblue;
            border: 1px solid #111;
            border-radius: 5px;
            padding: 5px 20px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-right: 200px;
            float: right;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

    </style>
</head>

<body>

    <header>
        <div>
        <a href="Phomepage.html" style="text-decoration: none; color: black;">
            <h1 style="font-size:100px; line-height:30%; margin-bottom:25px;">Heather‧࿐࿔ </h1>
        </a>
            <h2 style="font-size:22px;">Find the right cohabitation for you.</h2>
        </div>

        <div class="header-buttons">
            <a href="abtus.html" class="underline-button">About Us</a>
            <div class="dropdown">
                <a href="#" class="underline-button">Contact Us</a>
                <div class="dropdown-content">
                    <a href="mailto:1211103282@student.mmu.edu.my" class="dropdown-item">Aida</a>
                    <a href="mailto:1211103293@student.mmu.edu.my" class="dropdown-item">Farah</a>
                    <a href="mailto:1211307539@student.mmu.edu.my" class="dropdown-item">Amirah</a>
                </div>
            </div>
            <a href="updatebooking.html" class="underline-button">Booking Status</a>
            <button class="button" onclick="openChat()">
                <img src="img/chatbox.ico" alt="Chat Box">
            </button>
            <div class="dropdown">
                <button class="button"> <img src="img/user.ico" alt="User Profile"> </button>
                <div class="dropdown-content">
                    <a href="#" class="dropdown-item" onclick="redirectToUserProfile()">View Profile</a>
                    <a href="#" class="dropdown-item" onclick="redirectToHomepage()">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <form action="portal.php" method="post">

        <div class="header-left">
            <h3>Fill in the form and submit the application for approval.</h3>
        </div>

    <div class="container">
       <div class="row">
        <div class="col-15">
            <label for="location">Area or Postcode</label>
        </div>
        <div class="col-65">
            <input required type="text" id="location" name="areaPost">
        </div>
       </div>

       <div class="row">
        <div class="col-15">
            <label for="property">Property Type</label>
        </div>
        <div class="col-65">
            <input type="radio" id="typeHouse" name="property" value="house">
            <label for="typeHouse">House</label>
            <input type="radio" id="typeCondo" name="property" value="condo">
            <label for="typeCondo">Condo</label>
        </div>
       </div>

      <div class="row"> 
       <div class="col-15">
            <label for="noRooms">Number of rooms</label> 
        </div>
        <div class="col-45">
            <input type="text" id="noRooms" name="rooms">
        </div>
       </div> 

      <div class="row">  
       <div class="col-15">
            <label for="roomArea">Room Area</label>
        </div>
        <div class="col-45">
            <input type="text" id="roomArea" name="room">
        </div>
       </div> 

      <div class="row">  
       <div class="col-15">
            <label for="overallArea">Overall Area</label>
        </div>
        <div class="col-45">
            <input type="text" id="overallArea" name="overall">
        </div>
       </div> 

       <div class="row">
        <div class="col-15">
            <label for="salePrice">Room Sale Price</label>
        </div>
        <div class="col-45">
            <input type="text" id="salePrice" name="price" placeholder="Per month">
        </div>
       </div> 

       <div class="row">
        <div class="col-15">
            <label for="propName">Property Name</label>
        </div>
        <div class="col-65">
            <input type="text" id="propName" name="name">
        </div>
       </div> 

       <div class="row">
        <div class="col-15">
            <label for="propAdd">Property Address</label>
        </div>
        <div class="col-65">
            <input type="text" id="propAdd" name="address">
        </div>
       </div> 

       <div class="row"> 
        <div class="col-15">
            <label for="propDesc">Property Description</label>
        </div>
        <div class="col-65">
            <textarea id="propDesc" name="description" style="height:200px"></textarea>
        </div>
       </div>

      <div class="row">
        <div class="col-15">
            <label for="getFile">Add Images</label>
        </div>
        <div class="col-65">
            <input type="file" id="getFile" name="imageFile" multiple accept="images/png, images/jpeg">
        </div>
      </div> 

       <div class="row">
            <input type="submit" id="submitButton" name="submit" value="Submit">
       </div> 
    </div>

    </form>

    <script>
        function openChat() {
            window.location.href = 'chatrooms.php';
        }

        function redirectToUserProfile() {
            window.location.href = 'advertiserprofile.php';
        }

        function redirectToHomepage() {
            window.location.href = 'homepage.php'
        }
    </script>
</body>
</html>

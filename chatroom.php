<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heather</title>
    <link rel="icon" href="img/icon.ico" type="image/x-icon">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .container {
            flex: 1;
            display: flex;
        }

        .left-side {
            background-color: powderblue;
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column; 
            justify-content: flex-end; 
        }

        .right-side {
            flex: 2;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .advertiser-header {
            display: none;
            background-color: #e6f7ff; 
            padding: 10px;
            margin-bottom: 20px; 
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .chat-entry {
            display: none; 
            background-color: #e6f7ff; 
            padding: 10px;
            margin-bottom: 20px; 
            border-radius: 5px; 
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); 
        }

        .message-box-container {
            flex: 1;
            position: relative;
            overflow-y: auto; 
            display: flex;
            flex-direction: column;
            padding-bottom: 50px; 
        }

        .message-input-container {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 95%;
            padding: 10px;
            display: flex;
            align-items: center;
        }

        #messageBox {
            flex: 1;
            height: 30px;
            resize: none;
        }

        #sendButton {
            position: absolute;
            right: 25px;
            cursor: pointer;
        }

        .message {
            max-width: 70%; 
            background-color: powderblue;
            padding: 10px;
            margin: 5px;
            border-radius: 10px;
            align-self: flex-end; 
        }

        .received-message {
            align-self: flex-start; 
        }

        .exit-button {
            padding: 10px 20px;
            background-color: #ff6666;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: auto; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-side"> 
            <h1 style="font-size:50px; margin-top:-10px;">Chat Room</h1>
            <div class="chat-entry" id="advertiserHeader" style="display: none;">
                <h2 style="font-size:20px; margin-top:0;">
                <?php
                    include "connection.php";        
                    if (isset($_GET['ADVERTISER_ID'])) {
                        $advertiserId = $_GET['ADVERTISER_ID'];
                        echo "Advertiser $advertiserId";
                    } else {
                        echo "Error: Advertiser ID not provided.";
                    }
                ?>
                </h2>
            </div>
            <button class="exit-button" onclick="goToHomepage()">Exit Chatroom</button>
        </div>

        <div class="right-side">
            <div class="message-box-container" id="messageContainer"></div>
            <div class="message-input-container">
                <textarea id="messageBox" placeholder="Type your message here..." onkeypress="handleKeyPress(event)"></textarea>
                <img id="sendButton" src="img/send.png" alt="Send" onclick="sendMessage()">
        </div>

        <script>
            var firstMessageSent = false;
            var chatCounter = 0;
            var autoReplyMessages = [
                "Hello! How can I assist you?",
                "Yes, of course!",
                "Here is my contact information.",
                "Great, I have received the payment!",
                "I will update the status soon.",
                "You're welcome."
            ];

            function sendMessage() {
                var message = document.getElementById("messageBox").value;
                if (message.trim() !== "") {
                    var messageContainer = document.getElementById("messageContainer");
            
                    var sentMessage = document.createElement("div");
                    sentMessage.className = "message";
                    sentMessage.textContent = message;
                    messageContainer.appendChild(sentMessage);
            
                    var autoReplyIndex = chatCounter % autoReplyMessages.length;
                    var receivedMessage = document.createElement("div");
                    receivedMessage.className = "message received-message"; 
                    receivedMessage.textContent = autoReplyMessages[autoReplyIndex];
                    messageContainer.appendChild(receivedMessage);
              
                    document.getElementById("messageBox").value = "";

                    if (!firstMessageSent) { 
                        document.getElementById("advertiserHeader").style.display = "block"; 
                        firstMessageSent = true; 
                    }

                    chatCounter++;
                }
            }

            function handleKeyPress(event) {
                if (event.keyCode === 13) { 
                    event.preventDefault();
                    sendMessage(); 
                }
            }

            function goToHomepage() {
                window.location.href = 'Thomepage.php'; 
            }
        </script>

        </div>
    </div>
</body>
</html>

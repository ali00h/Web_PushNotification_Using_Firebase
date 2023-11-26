<html>
<?php
$actual_link = "https://$_SERVER[HTTP_HOST]";

?>
<head>
    <title>Firebase Messaging Demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="/site.webmanifest">  
    <style>
        div {
            margin-bottom: 15px;
        }
    </style>
    <script>
        function printAllErrors(){
              const console_log = window.console.log;
              window.console.log = function(...args) {
                console_log(...args);
                var textarea = document.getElementById('my_console');
                if (!textarea) return;
                args.forEach(arg => textarea.value += `${JSON.stringify(arg)}\n\n`);
              }
        }
        
        function firstload(){
            printAllErrors();
            console.log('test app started.');
            
        }
        
        function requestNotification(){
            MsgElem = document.getElementById("msg");
            TokenElem = document.getElementById("token");
            LinkElem = document.getElementById("link");
            NotisElem = document.getElementById("notis");
            ErrElem = document.getElementById("err");
            // Initialize Firebase
            // TODO: Replace with your project's customized code snippet
            var config = {
                'messagingSenderId': '718463455121',
                'apiKey': 'AIzaSyATSGy07kZdwtt7AboTq0RtibeBvHsc3CI',
                'projectId': 'alihashemi-main-website',
                'appId': '1:718463455121:web:b6bb0bd265ec2251a55430',
            };
            firebase.initializeApp(config);
    
            const messaging = firebase.messaging();
            messaging
                .requestPermission()
                .then(function () {
                    MsgElem.innerHTML = "Notification permission granted."
                    console.log("Notification permission granted.");
    
                    // get the token in the form of promise
                    return messaging.getToken()
                })
                .then(function(token) {
                    TokenElem.value = token
                    LinkElem.value = '<?php echo $actual_link; ?>/send.php?token=' + token;
                    console.log('Copy link and paste in another browser.');
                })
                .catch(function (err) {
                    ErrElem.innerHTML =  ErrElem.innerHTML + "; " + err
                    console.log("Unable to get permission to notify.", err);
                });
        }
        
        function copyLink(){
          // Get the text field
          var copyText = document.getElementById("link");
        
          // Select the text field
          copyText.select();
          copyText.setSelectionRange(0, 99999); // For mobile devices
        
           // Copy the text inside the text field
          navigator.clipboard.writeText(copyText.value);            
        }
        

        
    </script>
</head>
<body onload="firstload()">
    <button onclick="requestNotification()">Request</button>
    

    <br />
    <br />
    Token: <input type="text" id="token"/>

    <br />
    <br />    
    Link: <input type="text" id="link"/>
    
    <br />
    <br />    
    <button onclick="copyLink()">Copy Link</button> 
        
    <br />
    <br />
    <div id="msg"></div>
    <div id="notis"></div>
    <div id="err"></div>
    <textarea id='my_console' style='display: block;width: 100%;height: 300px;'></textarea>
    
    
    <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js"></script>


    </body>

</html>
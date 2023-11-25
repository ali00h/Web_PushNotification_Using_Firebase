# Web PushNotification Using Firebase
This is an example code explain how to implement firebase push notification client and server.

# Usage
1- Rename `secret-example.php` to `secret.php`

2- Go to `https://console.firebase.google.com/u/0/` and select your project. Then go to `Project settings`

3- In `General` tab copy `config` and paste in `index.php` (lines 39 to 44) and also paste in `firebase-messaging-sw.js` (lines 12 to 17)

3- Go to `Cloud Messaging` in `Cloud Messaging API` copy `Server key` and paste in `secret.php` in `APP_FIREBASE_SERVER_KEY` variable

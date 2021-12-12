// Initialize Firebase
const config = {
    apiKey: "AIzaSyCXhPneVdflP8fVeHkZWUqLW0wchpLiEEs",
    authDomain: "manhalstore.firebaseapp.com",
    databaseURL: "https://manhalstore.firebaseio.com",
    projectId: "manhalstore",
    storageBucket: "manhalstore.appspot.com",
    messagingSenderId: "133555393713",
    appId: "1:133555393713:web:f66f90cbd5df15f7d57e90",
    measurementId: "G-ZE8Q27K64J"
};
// Initialize Firebase with a default Firebase project
firebase.initializeApp(config);
console.log(firebase.app().name);  // "[DEFAULT]"
const messaging = firebase.messaging();
messaging.requestPermission()
    .then(function() {
        console.log('Have permission.');
        // TODO(developer): Retrieve an Instance ID token for use with FCM.
        // ...
       // console.log(messaging.getToken());
      //  return messaging.getToken();
    })
    .then(function(token){
        //console.log(token);
        $("#web_token").val(token);
    })
    .catch(function(err) {
        console.log('error occured');
    });
messaging.onMessage((payload) => {
    console.log(payload)
    Lobibox.alert("success", //AVAILABLE TYPES: "error", "info", "success", "warning"
        {
            title: payload.notification.title,
            msg: payload.notification.body+payload.data.id
        });



});
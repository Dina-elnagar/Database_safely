// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: 'AIzaSyCXT9rItl4xnpFZwP-7YgOnRa3s19Fd68A',
    authDomain: 'safely-5b1b2.firebaseapp.com',
    databaseURL: 'https://project-id.firebaseio.com',
    projectId: 'safely-5b1b2',
    storageBucket: 'safely-5b1b2.appspot.com',
    messagingSenderId: '609791351136',
    appId: '1:609791351136:web:3a5fd9f076c50dc2e82605',
    measurementId: 'G-9L919BCLWQ',
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});
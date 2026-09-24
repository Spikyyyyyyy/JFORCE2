// Import Firebase modules
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-app.js";
import { getAuth } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-auth.js";

// Your Firebase config (from Firebase Console)
// Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: "AIzaSyDKamRkgkNd5PWBjqLuwsrmMGbZIByC21o",
    authDomain: "cinemech-55e04.firebaseapp.com",
    projectId: "cinemech-55e04",
    storageBucket: "cinemech-55e04.firebasestorage.app",
    messagingSenderId: "777654018729",
    appId: "1:777654018729:web:afd4d55e2a9344815abfb8"
  };

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);



// Export so other files can use it
export { auth };


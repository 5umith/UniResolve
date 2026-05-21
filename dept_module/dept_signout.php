<?php
session_start();

if (isset($_POST['confirm_logout'])) {
    session_unset();
    session_destroy();
    header("Location: dept_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Logout Confirmation</title>
<style>
    body {
  margin: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: #E5E7EB;
  flex-direction: column;
  min-height: 100vh;
}

body::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('images/signOutBg.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  filter: blur(5px);
  z-index: -1; 
}
   
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
    }

    /* Popup box */
    .popup {
    background-color: #111827;      
    color: #E5E7EB;                
    font-size: 1rem;               
    padding: 30px 20px;         
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 3px 12px rgba(0,0,0,0.3);
    width: 300px;               
    animation: fadeIn 0.3s ease;
}
.popup h2 {
    color: #E5E7EB;
    font-size: 1.1rem;             
    margin-top: 0;
}
.popup button {
    margin: 10px 6px;
    padding: 8px 18px;
    border: none;
    border-radius: 7px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: bold;
    transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
}

.popup .yes {
  background: #ff6b6b; /* Red gradient */
  color: white;
  box-shadow: 0 4px 10px rgba(238, 90, 82, 0.3);
}

.popup .yes:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 15px rgba(238, 90, 82, 0.4);
  background: linear-gradient(45deg, #ee5a52, #ff6b6b);
  color: black;
}

.popup .no {
    background: #48dbfb; /* Blue gradient */
    color: white;
    box-shadow: 0 4px 10px rgba(10, 189, 227, 0.3);
}

.popup .no:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(10, 189, 227, 0.4);
    background: linear-gradient(45deg, #0abde3, #48dbfb); /* Reverse gradient on hover */
    color: black;
}

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
</style>
</head>
<body>

<form id="logoutForm" method="POST">
    <input type="hidden" name="confirm_logout" value="1">
</form>

<div class="overlay" id="logoutPopup">
    <div class="popup">
        <h2>Are you sure you want to sign out?</h2>
        <button class="yes" onclick="confirmLogout()">Yes</button>
        <button class="no" onclick="cancelLogout()">No</button>
    </div>
</div>

<script>
    // Show the popup automatically when page loads
    window.onload = function() {
        document.getElementById('logoutPopup').style.display = 'flex';
    };

    function confirmLogout() {
        document.getElementById('logoutForm').submit();  
    }

    function cancelLogout() {
        window.history.back();
    }
</script>

</body>
</html>

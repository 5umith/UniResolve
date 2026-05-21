<?php
include('db.php'); 
session_start(); 

// ✅ Check if admin is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ad_login.php");
    exit();
}

// Admin info
$admin_name = $_SESSION['username'];
$profile_image = "image/adminProfile.png";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<style>
/* ===== GLOBAL ===== */
body {
  margin: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #f0f2f5;
  color: #283e51;
}

/* ===== HEADER ===== */
header {
  height: 12vh;
  width: 100%;
  background: linear-gradient(90deg, #4b79a1, #283e51);
  color: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 30px;
  font-size: 24px;
  font-weight: bold;
  box-shadow: 0 4px 15px rgba(0,0,0,0.2);
  position: fixed;
  top: 0;
  z-index: 1000;
}

header button {
  background: white;
  color: #283e51;
  border: none;
  padding: 8px 15px;
  border-radius: 8px;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease;
}

header button:hover {
  background: #283e51;
  color: white;
  transform: scale(1.05);
}

/* ===== CONTAINER ===== */
.container {
  display: flex;
  margin-top: 12vh;
}

/* ===== SIDEBAR ===== */
.sideBar {
  width: 22vw;
  background: #fff;
  border-right: 2px solid #d8dce1;
  border-radius: 0 20px 20px 0;
  box-shadow: 4px 0 15px rgba(0,0,0,0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 25px 15px;
  position: fixed;
  top: 12vh;
  bottom: 0;
}

.profileImg img {
  height: 110px;
  width: 110px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid #4b79a1;
  margin-bottom: 12px;
}

.profileImg p {
  font-size: 1.2rem;
  font-weight: 600;
  margin-bottom: 30px;
}

.sidebarButton {
  width: 100%;
  display: flex;
  flex-direction: column; /* Stack links vertically */
  gap: 15px;
}

.sidebarButton a {
  text-align: center;
  padding: 12px 0;
  border-radius: 10px;
  background: linear-gradient(90deg, #4b79a1, #283e51);
  color: white;
  font-weight: bold;
  text-decoration: none;
  transition: all 0.3s ease;
}

.sidebarButton a:hover {
  background: linear-gradient(90deg, #283e51, #4b79a1);
  transform: translateY(-2px);
}

/* ===== MAIN CONTENT ===== */
.mainContent {
  margin-left: 24vw;
  flex: 1;
  padding: 30px;
}

.complaintSection {
  display: flex;
  gap: 30px;
  flex-wrap: wrap;
  justify-content: center;
}

.category {
  flex: 1 1 250px;
  background: #ffffff;
  border-radius: 20px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.15);
  padding: 20px;
}

.category h2 {
  text-align: center;
  color: #283e51;
  margin-bottom: 15px;
}

.cardContainer {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.card {
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #4b79a1, #283e51);
  color: white;
  border-radius: 15px;
  height: 70px;
  font-weight: bold;
  font-size: 1rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.card img {
  width: 30px;
  height: 30px;
  margin-right: 10px;
}

.card:hover {
  transform: translateY(-3px);
  background: linear-gradient(135deg, #5e93bf, #344d66);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
  .container {
    flex-direction: column;
  }
  .sideBar {
    width: 100%;
    position: relative;
    flex-direction: column; /* Keep vertical stack */
    justify-content: flex-start;
    border-radius: 0;
    box-shadow: none;
    padding: 15px 0;
  }
  .profileImg {
    margin-bottom: 15px;
  }
  .sidebarButton {
    gap: 10px;
    padding: 0 20px;
  }
  .mainContent {
    margin-left: 0;
    padding: 15px;
  }
  .category {
    width: 100%;
  }
}
</style>
</head>
<body>

<header>
  <span>Admin Dashboard</span>
  <form action="ad_signout.php" method="post" style="margin:0;">
    <button type="submit">Sign Out</button>
  </form>
</header>

<div class="container">
  <!-- Sidebar -->
  <div class="sideBar">
    <div class="profileImg">
      <img src="<?php echo $profile_image; ?>" alt="Admin Profile">
      <p><?php echo $admin_name; ?></p>
    </div>
    <div class="sidebarButton">
      <a href="ad_dashboard.php" class="active">Dashboard</a>
      <a href="user_details.php">User Details</a>
      <a href="ad_details.php">Department Admin Details</a>
    </div>
  </div>

  <!-- Main Content -->
  <div class="mainContent">
    <div class="complaintSection">

      <!-- Academic Category -->
      <div class="category">
        <h2>Academic</h2>
        <div class="cardContainer">
          <div class="card" onclick="window.location.href='academic_completed.php'">
            <img src="image/docFinal-removebg-preview.png" alt="">Completed
          </div>
          <div class="card" onclick="window.location.href='academic_pending.php'">
            <img src="image/docFinal-removebg-preview.png" alt="">Pending
          </div>
        </div>
      </div>

      <!-- Hostel Category -->
      <div class="category">
        <h2>Hostel</h2>
        <div class="cardContainer">
          <div class="card" onclick="window.location.href='hostel_completed.php'">
            <img src="image/docFinal-removebg-preview.png" alt="">Completed
          </div>
          <div class="card" onclick="window.location.href='hostel_pending.php'">
            <img src="image/docFinal-removebg-preview.png" alt="">Pending
          </div>
        </div>
      </div>

      <!-- canteen Category -->
      <div class="category">
        <h2>canteen</h2>
        <div class="cardContainer">
          <div class="card" onclick="window.location.href='canteen_completed.php'">
            <img src="image/docFinal-removebg-preview.png" alt="">Completed
          </div>
          <div class="card" onclick="window.location.href='canteen_pending.php'">
            <img src="image/docFinal-removebg-preview.png" alt="">Pending
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
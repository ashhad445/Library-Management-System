<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Portal</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="login.css">
</head>
<body>

  <h1>Welcome to the library</h1>

  <div id="userlogin" class="login">
    <div class="login-content">
      <h2>User Login</h2>
      <form action="login.php" method="POST">
        <input type="hidden" name="role" value="user">
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Password</label>
        <input type="password" name="password" required pattern="\S+"
          title="Password cannot be empty or just spaces.">
        <button type="submit">Login</button>
      </form>
    </div>
  </div>

  <div class="btn-container">
    <button onclick="openPopup('registerPopup')">Register</button>
    <button onclick="openPopup('adminPopup')">Admin Login</button>
  </div>

  <div id="registerPopup" class="popup">
    <div class="popup-content">

      <span class="close-btn" onclick="closePopup('registerPopup')">&times;</span>
      <h2>Register</h2>

      <form action="register.php" method="POST">
        <input type="hidden" name="role" value="user">
        <label>Name</label>
        <input type="text" name="name" required>
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Phone</label>
        <input type="tel" name="phone" required pattern="[0-9]{11}"
                title="Please enter an 11-digit phone number (e.g., 03001234567).">
        <label>Password</label>
        <input type="password" name="password" required minlength="8"
                pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}"
                title="Must be at least 8 characters long and contain at least one letter and one number.">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" required>
        <button type="submit">Register</button>
      </form>

    </div>
  </div>

  <div id="adminPopup" class="popup">
    <div class="popup-content">

      <span class="close-btn" onclick="closePopup('adminPopup')">&times;</span>
      <h2>Admin Login</h2>

      <form action="login.php" method="POST">
        <input type="hidden" name="role" value="admin">
        <label>username</label>
        <input type="text" name="username" required>
        <label>Password</label>
        <input type="password" name="password" required pattern=".*\S.*"
          title="Password cannot be empty or just spaces.">
        <button type="submit">Login</button>
      </form>

    </div>
  </div>

  <script>
    function openPopup(id) {
      document.getElementById(id).style.display = 'flex';
    }

    function closePopup(id) {
      document.getElementById(id).style.display = 'none';
    }

    // UPDATED THIS FUNCTION
    window.onclick = function(event) {
      const adminPopup = document.getElementById('adminPopup');
      const registerPopup = document.getElementById('registerPopup'); // Added this
      
      if (event.target === adminPopup) adminPopup.style.display = 'none';
      if (event.target === registerPopup) registerPopup.style.display = 'none'; // Added this
    }
  </script>

</body>
</html>
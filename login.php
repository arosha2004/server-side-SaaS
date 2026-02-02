<?php require 'config/db.php'; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in - NoteHub</title>
    <?php include 'includes/tailwind.php'; ?>
</head>
<body class="bg-white h-screen flex items-center justify-center">
    <div class="max-w-md w-full px-6 text-center">
        <!-- Logo -->
        <img src="assets/logo.png" alt="NoteHub Logo" class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg object-cover">
        
        <h2 class="text-3xl font-bold mb-8">Log in</h2>

        <?php
        if ($_POST) {
            $email = $_POST['email'];
            $password = $_POST['password'] ?? '';
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                // Regenerate session ID for security
                session_regenerate_id(true);
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role_id'];
                $_SESSION['profile_pic'] = $user['profile_pic'];
                
                header("Location: dashboard.php");
                exit;
            } else {
                echo "<p class='text-red-500 mb-4 font-medium'>Invalid login credentials</p>";
            }
        }
        ?>

        <form method="POST" class="space-y-4">
            <input name="email" type="email" placeholder="Email" required
                   class="w-full px-4 py-3 border-2 border-blue-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
            
            <!-- Adding password field as it's needed for the current logic -->
            <input name="password" type="password" placeholder="Password" required
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                Log in with email
            </button>
        </form>



        <p class="mt-20 text-sm text-gray-600">
            Don't have an account? <a href="register.php" class="text-blue-600 font-semibold hover:underline">Sign up</a>
        </p>
    </div>
</body>
</html>

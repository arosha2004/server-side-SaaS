<?php require 'config/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - NoteHub</title>
    <?php include 'includes/tailwind.php'; ?>
</head>
<body class="bg-white h-screen flex items-center justify-center">
    <div class="max-w-md w-full px-6 text-center">
        <!-- Logo -->
        <img src="assets/logo.png" alt="NoteHub Logo" class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg object-cover">
        
        <h2 class="text-3xl font-bold mb-8">Sign up</h2>

        <?php
        if ($_POST) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            try {
                $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, 2)");
                $stmt->execute([$name, $email, $password]);
                echo "<p class='text-green-500 mb-4'>Registered successfully! <a href='login.php' class='underline'>Log in</a></p>";
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    echo "<p class='text-red-500 mb-4'>Email already exists.</p>";
                } else {
                    echo "<p class='text-red-500 mb-4'>Something went wrong. Please try again.</p>";
                }
            }
        }
        ?>

        <form method="POST" class="space-y-4">
            <input name="name" type="text" placeholder="Name" required
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
            
            <input name="email" type="email" placeholder="Email" required
                   class="w-full px-4 py-3 border-2 border-blue-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
            
            <input name="password" type="password" placeholder="Password" required
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                Sign up
            </button>
        </form>



        <p class="mt-12 text-sm text-gray-600">
            Already have an account? <a href="login.php" class="text-blue-600 font-semibold hover:underline">Log in</a>
        </p>
    </div>
</body>
</html>

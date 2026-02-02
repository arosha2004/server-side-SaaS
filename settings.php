<?php 
require 'includes/auth.php'; 
require 'config/db.php';

$user_id = $_SESSION['user_id'];
$message = '';

// Fetch current user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Update name and email
    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    $stmt->execute([$name, $email, $user_id]);
    $_SESSION['name'] = $name;

    // Update password if provided
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$hashed_password, $user_id]);
    }

    // Handle profile picture upload
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['profile_pic']['tmp_name'];
        $file_name = time() . '_' . $_FILES['profile_pic']['name'];
        $upload_dir = 'uploads/';
        
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            $stmt = $pdo->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
            $stmt->execute([$file_name, $user_id]);
            $_SESSION['profile_pic'] = $file_name;
        }
    }

    $message = "Settings updated successfully!";
    // Refresh user data
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - NoteHub</title>
    <?php include 'includes/tailwind.php'; ?>
</head>
<body class="bg-nh-dark overflow-hidden">

<?php include 'includes/sidebar.php'; ?>

<div class="max-w-4xl mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold mb-8">Account Settings</h1>

    <?php if ($message): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline"><?= $message ?></span>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-lg p-8 space-y-6">
        <div class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-8">
            <div class="flex-shrink-0">
                <img src="uploads/<?= $user['profile_pic'] ?? 'default_user.png' ?>" class="w-32 h-32 rounded-full border-4 border-blue-100 shadow-md object-cover" alt="Profile">
                <input type="file" name="profile_pic" class="mt-4 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            
            <div class="flex-grow space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                </div>
            </div>
        </div>

        <hr class="border-gray-200">

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">New Password (leave blank to keep current)</label>
            <input type="password" name="password" placeholder="••••••••"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition duration-200 shadow-md">
                Save Changes
            </button>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>

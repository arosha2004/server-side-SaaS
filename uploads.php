<?php 
require 'includes/auth.php'; 
require 'config/db.php';

$user_id = $_SESSION['user_id'];
$message = '';

// Ensure uploads table exists
$pdo->exec("CREATE TABLE IF NOT EXISTS uploads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    file_name VARCHAR(255),
    original_name VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['file']['tmp_name'];
        $original_name = $_FILES['file']['name'];
        $file_ext = pathinfo($original_name, PATHINFO_EXTENSION);
        $file_name = time() . '_' . uniqid() . '.' . $file_ext;
        $upload_dir = 'uploads/files/';
        
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            $stmt = $pdo->prepare("INSERT INTO uploads (user_id, file_name, original_name) VALUES (?, ?, ?)");
            $stmt->execute([$user_id, $file_name, $original_name]);
            $message = "File uploaded successfully!";
        } else {
            $message = "Error moving uploaded file.";
        }
    } else {
        $message = "Upload error code: " . $_FILES['file']['error'];
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    
    // Get file info first
    $stmt = $pdo->prepare("SELECT * FROM uploads WHERE id = ? AND user_id = ?");
    $stmt->execute([$delete_id, $user_id]);
    $file = $stmt->fetch();
    
    if ($file) {
        // Delete file from server
        $file_path = 'uploads/files/' . $file['file_name'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        
        // Delete from database
        $stmt = $pdo->prepare("DELETE FROM uploads WHERE id = ? AND user_id = ?");
        $stmt->execute([$delete_id, $user_id]);
        
        $message = "File deleted successfully!";
    } else {
        $message = "File not found or access denied.";
    }
}

// Fetch user's uploads
$stmt = $pdo->prepare("SELECT * FROM uploads WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$uploads = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploads - NoteHub</title>
    <?php include 'includes/tailwind.php'; ?>
</head>
<body class="bg-nh-dark overflow-hidden">

<?php include 'includes/sidebar.php'; ?>

<div class="max-w-6xl mx-auto py-10 px-6">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">My Uploads</h1>
        <form method="POST" enctype="multipart/form-data" class="flex items-center space-x-4">
            <input type="file" name="file" required class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                Upload
            </button>
        </form>
    </div>

    <?php if ($message): ?>
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-6">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 font-bold text-gray-700">File Name</th>
                    <th class="px-6 py-4 font-bold text-gray-700">Upload Date</th>
                    <th class="px-6 py-4 font-bold text-gray-700 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php foreach ($uploads as $upload): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                <span class="text-gray-900 font-medium"><?= htmlspecialchars($upload['original_name']) ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            <?= date('M d, Y H:i', strtotime($upload['created_at'])) ?>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="uploads/files/<?= $upload['file_name'] ?>" download class="text-blue-600 hover:text-blue-900 font-semibold">Download</a>
                            <a href="uploads.php?delete=<?= $upload['id'] ?>" onclick="return confirm('Are you sure you want to delete this file?')" class="text-red-600 hover:text-red-900 font-semibold">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($uploads)): ?>
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                            No files uploaded yet.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

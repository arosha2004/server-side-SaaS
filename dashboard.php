<?php 
require_once 'includes/auth.php'; 
require 'config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - NoteHub</title>
    <?php include 'includes/tailwind.php'; ?>
</head>
<body class="bg-nh-dark overflow-hidden">

<?php include 'includes/sidebar.php'; ?>

<div class="flex flex-col items-center justify-center h-full text-center px-4">
    <h1 class="text-4xl font-extrabold mb-12">Hi <?= htmlspecialchars($_SESSION['name']) ?>, Welcome to Notehub</h1>

    <!-- Center Logo/Image Placeholder -->
    <div class="bg-white rounded-nh-2xl p-12 shadow-xl max-w-2xl w-full mb-12">
        <div class="flex flex-col items-center">
             <img src="assets/logo.png" alt="NoteHub Logo" class="w-48 h-48 rounded-full mb-6 shadow-2xl object-cover">
            <h2 class="text-6xl font-bold tracking-tighter text-[#1e3a8a]">NoteHub</h2>
        </div>
    </div>

    <p class="text-xl font-bold max-w-2xl mb-4">
        Note Hub protects your notes by keeping them securely stored and easily accessible,
    </p>
    <p class="text-lg font-semibold text-gray-800">
        ensuring your important information is always safe
    </p>

    <!-- Create Note Floating Button (Bottom Right) -->
    <a href="notes/create.php" class="fixed bottom-12 right-12 bg-nh-accent-pink hover:bg-[#a17a7a] text-white px-8 py-4 rounded-2xl flex items-center space-x-3 shadow-lg transition duration-200 transform hover:scale-105">
        <span class="text-xl font-bold">Create Note</span>
        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
    </a>
</div>

<?php include 'includes/footer.php'; ?>

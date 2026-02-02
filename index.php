<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NoteHub - Your Personal Digital Notebook</title>
    <?php include 'includes/tailwind.php'; ?>
</head>
<body class="bg-white text-gray-900 font-sans">
    <!-- Navbar -->
    <nav class="flex justify-between items-center px-12 py-8 bg-white sticky top-0 z-50 shadow-sm">
        <div class="flex items-center space-x-2">
            <img src="assets/logo.png" alt="NoteHub Logo" class="w-10 h-10 rounded-full object-cover">
            <span class="text-2xl font-bold tracking-wider">NOTEHUB</span>
        </div>
        <div class="space-x-8 flex items-center">
            <a href="login.php" class="text-gray-600 font-semibold hover:text-blue-600">Login</a>
            <a href="register.php" class="bg-blue-600 text-white px-8 py-3 rounded-full font-bold hover:bg-blue-700 transition duration-200">Get Started</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="flex flex-col md:flex-row items-center justify-between px-12 py-20 bg-gray-50">
        <div class="md:w-1/2 space-y-8">
            <h1 class="text-6xl font-extrabold leading-tight text-gray-900">
                Capture Your Thoughts, <br>
                <span class="text-blue-600">Anywhere, Anytime.</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-lg">
                NoteHub is the smartest way to organize your life. Secure, fast, and beautifully designed for your productivity.
            </p>
            <div class="flex space-x-4">
                 <a href="register.php" class="bg-blue-600 text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105 shadow-xl">
                    Join NoteHub Today
                </a>
            </div>
        </div>
        <div class="md:w-1/2 mt-12 md:mt-0 flex justify-center">
             <img src="assets/logo.png" alt="NoteHub Logo" class="w-80 h-80 rounded-[3rem] shadow-2xl object-cover transform rotate-3">
        </div>
    </header>

    <!-- Features Section -->
    <section class="px-12 py-24 bg-white">
        <h2 class="text-4xl font-bold text-center mb-16">Why choose NoteHub?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
            <div class="space-y-4 p-8 rounded-2xl border border-gray-100 hover:shadow-2xl transition duration-300">
                <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold">Bank-Grade Security</h3>
                <p class="text-gray-600">Your notes are encrypted and safe from prying eyes.</p>
            </div>
            <div class="space-y-4 p-8 rounded-2xl border border-gray-100 hover:shadow-2xl transition duration-300">
                <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold">Fast & Reliable</h3>
                <p class="text-gray-600">Instant sync across all your devices, never miss a beat.</p>
            </div>
            <div class="space-y-4 p-8 rounded-2xl border border-gray-100 hover:shadow-2xl transition duration-300">
                <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.172-1.172a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold">Clean Experience</h3>
                <p class="text-gray-600">A beautiful, minimalist UI designed for focus and clarity.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 px-12 text-center">
        <p>&copy; 2026 NoteHub System. All rights reserved.</p>
    </footer>
</body>
</html>

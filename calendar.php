<?php 
require 'includes/auth.php'; 
require 'config/db.php';

$user_id = $_SESSION['user_id'];

// Get current month and year
$month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');

// Calculate previous and next month
$prev_month = $month - 1;
$prev_year = $year;
if ($prev_month == 0) {
    $prev_month = 12;
    $prev_year--;
}

$next_month = $month + 1;
$next_year = $year;
if ($next_month == 13) {
    $next_month = 1;
    $next_year++;
}

// Get notes with reminders for this month
$start_date = "$year-$month-01 00:00:00";
$end_date = date("Y-m-t 23:59:59", strtotime($start_date));

$stmt = $pdo->prepare("SELECT * FROM notes WHERE user_id = ? AND reminder BETWEEN ? AND ? ORDER BY reminder ASC");
$stmt->execute([$user_id, $start_date, $end_date]);
$notes = $stmt->fetchAll();

// Map notes to days
$notes_by_day = [];
foreach ($notes as $note) {
    $day = (int)date('d', strtotime($note['reminder']));
    $notes_by_day[$day][] = $note;
}

// Calendar logic
$first_day_of_month = date('w', strtotime($start_date)); // 0 (Sun) to 6 (Sat)
$days_in_month = date('t', strtotime($start_date));
$month_name = date('F', strtotime($start_date));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar - NoteHub</title>
    <?php include 'includes/tailwind.php'; ?>
</head>
<body class="bg-nh-dark overflow-hidden">

<?php include 'includes/sidebar.php'; ?>

<div class="p-6">
    <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-xl shadow-md">
        <h1 class="text-3xl font-bold"><?= $month_name ?> <?= $year ?></h1>
        <div class="flex space-x-4">
            <a href="?month=<?= $prev_month ?>&year=<?= $prev_year ?>" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg transition">Previous</a>
            <a href="?month=<?= $next_month ?>&year=<?= $next_year ?>" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg transition">Next</a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Calendar Header -->
        <div class="grid grid-cols-7 bg-blue-600 text-white text-center font-bold py-3">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>

        <!-- Calendar Grid -->
        <div class="grid grid-cols-7 border-l border-t border-gray-200">
            <?php
            // Empty slots for days before the 1st
            for ($i = 0; $i < $first_day_of_month; $i++) {
                echo '<div class="h-32 border-r border-b border-gray-100 bg-gray-50"></div>';
            }

            // Days of the month
            for ($day = 1; $day <= $days_in_month; $day++) {
                $is_today = ($day == date('d') && $month == date('m') && $year == date('Y'));
                ?>
                <div class="h-32 border-r border-b border-gray-200 p-2 overflow-y-auto <?= $is_today ? 'bg-blue-50' : '' ?>">
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-bold <?= $is_today ? 'bg-blue-600 text-white w-7 h-7 flex items-center justify-center rounded-full' : 'text-gray-700' ?>">
                            <?= $day ?>
                        </span>
                    </div>
                    
                    <div class="space-y-1">
                        <?php if (isset($notes_by_day[$day])): ?>
                            <?php foreach ($notes_by_day[$day] as $note): ?>
                                <a href="notes/edit.php?id=<?= $note['id'] ?>" 
                                   class="block text-[10px] p-1 bg-nh-pink rounded truncate hover:bg-[#c98b8b] transition"
                                   title="<?= htmlspecialchars($note['title']) ?>">
                                    <?= htmlspecialchars($note['title']) ?>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            }

            // Empty slots for days after the last day
            $remaining_slots = (7 - (($first_day_of_month + $days_in_month) % 7)) % 7;
            for ($i = 0; $i < $remaining_slots; $i++) {
                echo '<div class="h-32 border-r border-b border-gray-100 bg-gray-50"></div>';
            }
            ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

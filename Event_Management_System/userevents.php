<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
  header("Location: index.php");
  exit;
}

$userName = $_SESSION['name'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Events - Evently</title>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link rel="stylesheet" as="style" onload="this.rel='stylesheet'" href="https://fonts.googleapis.com/css2?display=swap&family=Noto+Sans:wght@400;500;700;900&family=Plus+Jakarta+Sans:wght@400;500;700;800" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  </head>
  <body class="bg-[#fcf8f8] font-['Plus_Jakarta_Sans','Noto_Sans',sans-serif]">
    <div class="min-h-screen flex flex-col">
      <?php include 'includes/navbar.php'; ?>

      <main class="px-10 py-6 flex flex-col gap-6">
        <div class="animate-fade">
          <h1 class="text-[32px] font-bold text-[#1b0e0f]">Events</h1>
          <p class="text-[#974e52] text-sm">Manage your upcoming and past events.</p>
        </div>

        <div class="flex flex-wrap gap-4 items-center">
          <button class="px-5 py-2 bg-[#e82630] text-white rounded-full hover:bg-[#c71e28] transition font-medium">+ Create New Event</button>
          <div class="bg-[#f3e7e8] text-[#1b0e0f] rounded-full px-5 py-2 text-sm font-medium">
            All | Upcoming | Past
          </div>
        </div>

        <section class="mt-4">
          <h2 class="text-xl font-semibold text-[#1b0e0f] mb-2">Upcoming Events</h2>
          <div class="grid gap-4 grid-cols-1 md:grid-cols-3">
            <?php for ($i = 1; $i <= 3; $i++): ?>
              <div class="bg-white rounded-xl border border-[#e7d0d1] shadow p-4">
                <div class="aspect-video rounded-xl bg-cover bg-center mb-3" style="background-image: url('https://source.unsplash.com/400x225/?event,party,<?= $i ?>');"></div>
                <h3 class="font-semibold text-[#1b0e0f]">Event Title <?= $i ?></h3>
                <p class="text-[#974e52] text-sm">Date: <?= date('F j, Y', strtotime('+'.$i.' weeks')) ?></p>
                <div class="mt-3 flex gap-2">
                  <button class="text-sm text-blue-600 hover:underline">View</button>
                  <button class="text-sm text-yellow-600 hover:underline">Edit</button>
                  <button class="text-sm text-red-600 hover:underline">Delete</button>
                </div>
              </div>
            <?php endfor; ?>
          </div>
        </section>

        <section class="mt-6">
          <h2 class="text-xl font-semibold text-[#1b0e0f] mb-2">Past Events</h2>
          <div class="overflow-auto rounded-xl border border-[#e7d0d1] bg-white">
            <table class="min-w-full text-sm">
              <thead class="bg-[#f3e7e8]">
                <tr>
                  <th class="text-left px-4 py-2">Event Name</th>
                  <th class="text-left px-4 py-2">Date</th>
                  <th class="text-left px-4 py-2">Attendees</th>
                  <th class="text-left px-4 py-2">Revenue</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-t">
                  <td class="px-4 py-2">Annual Gala</td>
                  <td class="px-4 py-2">June 15, 2024</td>
                  <td class="px-4 py-2">320</td>
                  <td class="px-4 py-2">$25,000</td>
                </tr>
                <tr class="border-t">
                  <td class="px-4 py-2">Product Launch</td>
                  <td class="px-4 py-2">May 20, 2024</td>
                  <td class="px-4 py-2">280</td>
                  <td class="px-4 py-2">$18,400</td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>
      </main>

      <footer class="mt-auto px-10 py-4 bg-[#f3e7e8] text-sm text-[#1b0e0f] text-center">
        &copy; <?= date('Y') ?> Evently. All rights reserved.
      </footer>
    </div>
  </body>
</html>

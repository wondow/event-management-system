<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
  header("Location: index.php");
  exit;
}

$userName = $_SESSION['name'] ?? 'User';

// Example metrics - replace with real queries later
$totalEvents = 25;
$totalRevenue = 75000;
$totalAttendees = 1250;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard - Evently</title>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&family=Noto+Sans:wght@400;500;700;900&family=Plus+Jakarta+Sans:wght@400;500;700;800"
    />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            animation: {
              fade: "fadeIn 0.5s ease-in-out",
              bounceSlow: 'bounce 1.5s infinite'
            },
            keyframes: {
              fadeIn: {
                '0%': { opacity: 0 },
                '100%': { opacity: 1 }
              }
            }
          }
        }
      }
    </script>
  </head>
  <body class="bg-[#fcf8f8] font-['Plus_Jakarta_Sans','Noto_Sans',sans-serif]">
  
  
  <div class="flex min-h-screen flex-col overflow-x-hidden">
      <header class="flex items-center justify-between border-b border-[#f3e7e8] px-10 py-3">
        <div class="flex items-center gap-8">
          <div class="flex items-center gap-4 text-[#1b0e0f]">
            <div class="size-4">
              <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 18.4228L42 11.475V34.3663C42 34.7796 41.7457 35.1504 41.3601 35.2992L24 42V18.4228Z" fill="currentColor"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 8.18819L33.4123 11.574L24 15.2071L14.5877 11.574L24 8.18819ZM9 15.8487L21 20.4805V37.6263L9 32.9945V15.8487ZM27 37.6263V20.4805L39 15.8487V32.9945L27 37.6263ZM25.354 2.29885C24.4788 1.98402 23.5212 1.98402 22.646 2.29885L4.98454 8.65208C3.7939 9.08038 3 10.2097 3 11.475V34.3663C3 36.0196 4.01719 37.5026 5.55962 38.098L22.9197 44.7987C23.6149 45.0671 24.3851 45.0671 25.0803 44.7987L42.4404 38.098C43.9828 37.5026 45 36.0196 45 34.3663V11.475C45 10.2097 44.2061 9.08038 43.0155 8.65208L25.354 2.29885Z" fill="currentColor"></path>
              </svg>
            </div>
            <h2 class="text-lg font-bold tracking-tight">Evently</h2>
          </div>
          <nav class="flex items-center gap-6">
  <a class="text-sm font-medium text-[#1b0e0f] hover:text-[#e82630] transition" href="userdashboard.php">Dashboard</a>
  <a class="text-sm font-medium text-[#1b0e0f] hover:text-[#e82630] transition" href="userevents.php">Events</a>
  <a class="text-sm font-medium text-[#1b0e0f] hover:text-[#e82630] transition" href="userguests.php">Guests</a>
  <a class="text-sm font-medium text-[#1b0e0f] hover:text-[#e82630] transition" href="uservendors.php">Vendors</a>
  <a class="text-sm font-medium text-[#1b0e0f] hover:text-[#e82630] transition" href="userbilling.php">Billing</a>
</nav>

        </div>
        <div class="flex items-center gap-6">
          <div class="relative">
            <input type="text" placeholder="Search" class="pl-10 pr-4 py-2 w-64 rounded-xl bg-[#f3e7e8] text-[#1b0e0f] placeholder:text-[#974e52] focus:outline-none" />
            <svg class="absolute left-3 top-2.5 text-[#974e52]" width="20" height="20" fill="currentColor" viewBox="0 0 256 256">
              <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
            </svg>
          </div>
          <button class="h-10 w-10 rounded-full bg-[#f3e7e8] flex items-center justify-center hover:bg-[#e82630] transition">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 256 256">
              <path d="M221.8,175.94C216.25,166.38,208,139.33,208,104a80,80,0,1,0-160,0c0,35.34-8.26,62.38-13.81,71.94A16,16,0,0,0,48,200H88.81a40,40,0,0,0,78.38,0H208a16,16,0,0,0,13.8-24.06ZM128,216a24,24,0,0,1-22.62-16h45.24A24,24,0,0,1,128,216ZM48,184c7.7-13.24,16-43.92,16-80a64,64,0,1,1,128,0c0,36.05,8.28,66.73,16,80Z"></path>
            </svg>
          </button>
          <div class="relative group">
            <div class="h-10 w-10 rounded-full bg-center bg-cover border-2 border-[#e82630] cursor-pointer hover:ring hover:ring-[#e82630]/50" style='background-image: url("https://source.unsplash.com/40x40/?profile");'></div>
            <div class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg opacity-0 group-hover:opacity-100 transition duration-200 z-10">
              <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Profile</a>
              <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Settings</a>
              <a href="logout.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</a>
            </div>
          </div>
        </div>
      </header>

      <main class="px-10 py-5 flex flex-col gap-6">
        <div class="animate-fade">
          <h1 class="text-[32px] font-bold text-[#1b0e0f]">Dashboard</h1>
          <p class="text-[#974e52] text-sm">Welcome back, <?php echo htmlspecialchars($userName); ?></p>
        </div>

        <div class="flex flex-wrap gap-4">
          <button onclick="openModal()" class="px-5 py-2 bg-[#e82630] text-white rounded-full hover:bg-[#c71e28] transition font-medium">Create New Event</button>
          <button class="px-5 py-2 bg-[#f3e7e8] text-[#1b0e0f] rounded-full hover:bg-[#e7d0d1] transition font-medium">View Upcoming Events</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <a href="attendees.php" class="border border-[#e7d0d1] rounded-xl p-6 hover:shadow-lg transition transform hover:scale-105">
            <p class="text-[#1b0e0f] font-medium">Total Attendees</p>
            <p class="text-2xl font-bold">1,250</p>
          </a>
          <a href="financials.php" class="border border-[#e7d0d1] rounded-xl p-6 hover:shadow-lg transition transform hover:scale-105">
            <p class="text-[#1b0e0f] font-medium">Total Revenue</p>
            <p class="text-2xl font-bold">$75,000</p>
          </a>
          <a href="events.php" class="border border-[#e7d0d1] rounded-xl p-6 hover:shadow-lg transition transform hover:scale-105">
            <p class="text-[#1b0e0f] font-medium">Events Hosted</p>
            <p class="text-2xl font-bold">25</p>
          </a>
        </div>

        <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50">
          <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-xl">
            <h2 class="text-lg font-bold mb-4">Create New Event</h2>
            <input type="text" placeholder="Event Name" class="w-full mb-3 px-4 py-2 border rounded" />
            <input type="date" class="w-full mb-3 px-4 py-2 border rounded" />
            <textarea placeholder="Event Description" class="w-full mb-3 px-4 py-2 border rounded"></textarea>
            <div class="flex justify-end gap-2">
              <button onclick="closeModal()" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
              <button class="px-4 py-2 rounded bg-[#e82630] text-white hover:bg-[#c71e28]">Save</button>
            </div>
          </div>
        </div>
      </main>

      <footer class="mt-auto px-10 py-4 bg-[#f3e7e8] text-sm text-[#1b0e0f] text-center">
        &copy; <?php echo date('Y'); ?> Evently. All rights reserved.
      </footer>

      <script>
        function openModal() {
          document.getElementById('modal').classList.remove('hidden');
        }
        function closeModal() {
          document.getElementById('modal').classList.add('hidden');
        }
      </script>
    </div>
  </body>
</html>
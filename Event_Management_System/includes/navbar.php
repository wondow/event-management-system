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
        <a href="userprofile.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Profile</a>
        <a href="usersettings.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Settings</a>
        <a href="logout.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</a>
      </div>
    </div>
  </div>
</header>

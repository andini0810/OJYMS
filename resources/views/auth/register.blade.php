<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <!-- Tambahkan CDN Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .hidden {
      display: none;
    }
    .block {
      display: block;
    }
  </style>
</head>
<body class="h-full">
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
      <h2 class="mt-10 text-center text-2xl font-bold tracking-tight text-gray-900">Register to your account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="{{ route('register') }}" method="POST">
        @csrf
        <div>
          <label for="name" class="block text-sm font-medium text-gray-900">User name</label>
          <div class="mt-2">
            <input type="name" name="name" id="name" autocomplete="name" required
              class="block w-full rounded-md border border-gray-300 px-3 py-1.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm">
          </div>
        </div>
        <div>
          <label for="email" class="block text-sm font-medium text-gray-900">Email address</label>
          <div class="mt-2">
            <input type="email" name="email" id="email" autocomplete="email" required
              class="block w-full rounded-md border border-gray-300 px-3 py-1.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm">
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
            <div class="text-sm">
              <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
            </div>
          </div>
          <div class="mt-2">
            <input type="password" name="password" id="password" autocomplete="current-password" required
              class="block w-full rounded-md border border-gray-300 px-3 py-1.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm">
          </div>
        </div>

        <div>
          <label id="listbox-label" class="block text-sm font-medium text-gray-900">Daftar sebagai</label>
          <div class="relative mt-2">
            <button 
              type="button" 
              id="dropdownButton" 
              class="grid w-full cursor-default grid-cols-1 rounded-md bg-white py-1.5 pl-3 pr-2 text-left text-gray-900 outline outline-1 outline-gray-300 focus:outline-indigo-600 sm:text-sm">
              <span class="col-start-1 row-start-1 flex items-center gap-3 pr-6">
                <span id="selectedOption" class="block truncate">Pilih</span>
              </span>
              <svg class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4" 
                viewBox="0 0 16 16" 
                fill="currentColor" 
                aria-hidden="true">
                <path fill-rule="evenodd" d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
              </svg>
            </button>

            
            <!-- Dropdown list -->
            <ul 
              id="dropdownList" 
              class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm hidden"
              tabindex="-1" 
              role="listbox" 
              aria-labelledby="listbox-label">
              <li class="relative cursor-pointer select-none py-2 pl-3 pr-9 text-gray-900 hover:bg-gray-100" data-value="Alumni" role="2">
                <span class="block truncate">Alumni</span>
              </li>
              <li class="relative cursor-pointer select-none py-2 pl-3 pr-9 text-gray-900 hover:bg-gray-100" data-value="Mahasiswa" role="1">
                <span class="block truncate">Mahasiswa</span>
              </li>
              <li class="relative cursor-pointer select-none py-2 pl-3 pr-9 text-gray-900 hover:bg-gray-100" data-value="Admin" role="3">
                <span class="block truncate">Admin</span>
              </li>
            </ul>
          </div>
        </div>

        <!-- Input tersembunyi untuk role_id -->
        <input type="hidden" name="role_id" id="role_id"> <!-- Default ke Alumni -->

        <div>
          <button type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Submit
          </button>
        </div>
      </form>

      <p class="mt-10 text-center text-sm text-gray-500">
        sudah punya akun?
        <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Login</a>
      </p>
    </div>
  </div>

  <script>
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownList = document.getElementById('dropdownList');
    const selectedOption = document.getElementById('selectedOption');
    const role_id = document.getElementById('role_id');

    // Toggle dropdown visibility
    dropdownButton.addEventListener('click', () => {
        dropdownList.classList.toggle('hidden');
    });

    // Select an option
    dropdownList.addEventListener('click', (event) => {
        const clickedOption = event.target.closest('li');
        if (clickedOption) {
            const value = clickedOption.dataset.value;
            selectedOption.textContent = value;
            role_id.value = clickedOption.getAttribute('role');
            console.log('Selected Role ID:', role_id.value);
            dropdownList.classList.add('hidden');
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (event) => {
        if (!dropdownButton.contains(event.target) && !dropdownList.contains(event.target)) {
            dropdownList.classList.add('hidden');
        }
    });
  </script>

  @if ($errors->any())
    <div class="mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-red-500">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
</body>
</html>

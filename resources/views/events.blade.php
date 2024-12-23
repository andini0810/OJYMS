<x-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Events - Career Portal</title>
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
        <link rel="stylesheet" href="css/events.css">
    </head>

    <body>

       
            <div class="container">
                <!-- Header Section -->
                <header class="header">
                    <h1>Upcoming Events</h1>
                    <!-- Search Bar -->
                <div class="search-bar">
                    <form action="{{ route('events') }}" method="GET">
                        <input type="text" name="search" placeholder="Cari event..." class="search-input">
                        <button type="submit" class="search-button">Cari</button>
                    </form>
                </div>
                </header>

                <!-- Events Section -->
                <div class="events-grid">
                    @foreach ($events as $event)
                        <div class="event-card">
                            <div class="event-date">
                                {{ $event->start_datetime->format('F d, Y H:i') }}
                            </div>

                            <div class="event-content">
                                <h3 class="event-title">{{ $event->name }}</h3>
                                <p class="event-location">{{ $event->location }}</p>
                                <p class="event-decription">{{ Str::limit($event->description, 100) }}</p>
                                <button class="register-btn">Register Now</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            
            <x-dropdown>
                <a href="{{ route('eventcreate') }}"
                    class="flex justify-center items-center w-[52px] h-[52px] text-gray-400 bg-gray-800 rounded-lg border border-gray-700 hover:bg-gray-700 hover:border-gray-600 focus:ring-4 focus:ring-gray-600 focus:outline-none"
                    x-tooltip="'Create Event'">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="sr-only">Create Event</span>
                </a>
            </x-dropdown>
        </div>


        <script>
            // Select DOM Elements
            const searchInput = document.querySelector('.search-bar input');
            const searchButton = document.querySelector('.search-bar button');
            const eventCards = document.querySelectorAll('.event-card');

            // Event Listener untuk pencarian event
            searchButton.addEventListener('click', function() {
                const searchText = searchInput.value.toLowerCase();
                filterEvents(searchText);
            });

            // Event Listener untuk pencarian saat mengetik
            searchInput.addEventListener('input', function() {
                const searchText = searchInput.value.toLowerCase();
                filterEvents(searchText);
            });

            // Fungsi filter untuk mencari event berdasarkan teks pencarian
            function filterEvents(searchText) {
                eventCards.forEach(eventCard => {
                    const eventTitle = eventCard.querySelector('.event-title').textContent.toLowerCase();
                    const eventLocation = eventCard.querySelector('.event-location').textContent.toLowerCase();
                    const eventDescription = eventCard.querySelector('.event-description').textContent.toLowerCase();

                    if (eventTitle.includes(searchText) || eventLocation.includes(searchText) || eventDescription
                        .includes(searchText)) {
                        eventCard.style.display = 'flex'; // Menampilkan event card
                    } else {
                        eventCard.style.display = 'none'; // Menyembunyikan event card
                    }
                });
            }

            // Hover Animations
            eventCards.forEach(eventCard => {
                eventCard.addEventListener('mouseover', () => {
                    eventCard.style.transform = 'scale(1.03)'; // Membesarkan ukuran kartu saat hover
                });

                eventCard.addEventListener('mouseout', () => {
                    eventCard.style.transform = 'scale(1)'; // Mengembalikan ukuran asli saat tidak hover
                });
            });

            // Fungsi klik tombol "Register Now"
            const registerButtons = document.querySelectorAll('.register-btn');

            registerButtons.forEach(button => {
                button.addEventListener('click', () => {
                    alert('Terima kasih telah mendaftar pada event ini!, Informasi selengkapnya akan dikirim melalui email anda!');
                });
            });
        </script>
    </body>

    </html>
</x-layout>

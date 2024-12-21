<x-layout>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cari Lowongan Pekerjaan</title>
        <link rel="stylesheet" href="{{ asset('css/findjobs.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>

    <body>
        <section class="findjobs">
            <div class="container">
                <!-- Judul Utama -->
                <header class="header">
                    <h2 class="section__title">Temukan Pekerjaan Impian Anda</h2>
                    <p class="section__subtitle">
                        Cari lowongan pekerjaan sesuai keahlian dan lokasi Anda.
                    </p>
                </header>

                <!-- Search Bar -->
                <div class="search-bar">
                    <form action="#" method="GET">
                        <input type="text" name="search" placeholder="Cari pekerjaan..." class="search-input">
                        <button type="submit" class="search-button">Cari</button>
                    </form>
                </div>

                @if (auth()->user()->role_id === 2)
                    <div class="create-job-button">
                        <x-dropdown>
                            <a href="{{ route('jobscreate') }}"
                                class="flex justify-center items-center w-[52px] h-[52px] text-gray-400 bg-gray-800 rounded-lg border border-gray-700 hover:bg-gray-700 hover:border-gray-600 focus:ring-4 focus:ring-gray-600 focus:outline-none"
                                x-tooltip="'Create Job'">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <span class="sr-only">Create Job</span>
                            </a>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Grid Lowongan Pekerjaan -->
                <div class="jobs__grid">
                    @foreach ($jobs_creates as $job)
                        <div class="job-card">
                            <h3 class="job-card__title">{{ $job->title }}</h3>
                            <p class="job-card__company">{{ $job->company }}</p>
                            <p class="job-card__location">{{ $job->location }}</p>
                            <p class="job-card__description">{{ Str::limit($job->description, 100) }}</p>

                            <button class="apply-button"
                                onclick="openPopup('{{ $job->title }}', {{ $job->id }})">Apply</button>

                        </div>
                    @endforeach
                </div>
            </div>
        </section>

            <!-- Pop-up Apply -->
            <div class="popup" id="applyPopup" style="display: none;">
                <div class="popup-content">
                    <h2>Apply for <span id="jobTitle">Job Title</span></h2>
                    <form id="applyForm" method="POST" action="{{ route('jobs.apply') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="jobsapply_id" name="jobsapply_id">
                        <div class="form-group">
                            <label for="applicantName">Full Name</label>
                            <input type="text" id="applicantName" name="applicant_name"
                                placeholder="Enter your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="applicantEmail">Email</label>
                            <input type="email" id="applicantEmail" name="applicant_email"
                                placeholder="Enter your email address" required>
                        </div>
                        <div class="form-group">
                            <label for="cvFile">Upload CV</label>
                            <input type="file" id="cvFile" name="cv_file" accept=".pdf,.doc,.docx" required>
                        </div>
                        <div class="popup-buttons">
                            <button type="submit" class="btn-submit">Submit</button>
                            <button type="button" class="btn-cancel" onclick="closePopup()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
     

        <script>
            // Pilih elemen DOM
            const searchInput = document.querySelector('.search-input');
            const locationSelect = document.querySelector('.location-select');
            const searchButton = document.querySelector('.search-button');
            const jobCards = document.querySelectorAll('.job-card');
            const applyButtons = document.querySelectorAll('.apply-button');
            const popup = document.getElementById("applyPopup");
            const form = document.getElementById("applyForm");
            const jobTitleElement = document.getElementById("jobTitle");

            // Fungsi pencarian
            function searchJobs() {
                const searchText = searchInput.value.toLowerCase();
                const selectedLocation = locationSelect?.value?.toLowerCase() || ''; // Cek jika dropdown ada

                jobCards.forEach(jobCard => {
                    const jobTitle = jobCard.querySelector('.job-card__title').textContent.toLowerCase();
                    const jobCompany = jobCard.querySelector('.job-card__company').textContent.toLowerCase();
                    const jobLocation = jobCard.querySelector('.job-card__location').textContent.toLowerCase();

                    // Filter berdasarkan teks pencarian dan lokasi
                    const isTextMatch = jobTitle.includes(searchText) || jobCompany.includes(searchText);
                    const isLocationMatch = selectedLocation === '' || jobLocation.includes(selectedLocation);

                    if (isTextMatch && isLocationMatch) {
                        jobCard.style.display = 'block'; // Tampilkan job card
                    } else {
                        jobCard.style.display = 'none'; // Sembunyikan job card
                    }
                });
            }

            // Event listener untuk tombol pencarian
            searchButton.addEventListener('click', () => {
                searchJobs();
            });

            // Event listener untuk saat mengetik di input pencarian
            searchInput.addEventListener('input', () => {
                searchJobs();
            });

            // Event listener untuk perubahan dropdown lokasi (jika digunakan)
            if (locationSelect) {
                locationSelect.addEventListener('change', () => {
                    searchJobs();
                });
            }

            // Fungsi animasi hover pada job card
            jobCards.forEach(jobCard => {
                jobCard.addEventListener('mouseover', () => {
                    jobCard.style.transform = 'scale(1.03)'; // Memperbesar kartu saat hover
                });

                jobCard.addEventListener('mouseout', () => {
                    jobCard.style.transform = 'scale(1)'; // Mengembalikan ukuran semula
                });
            });

            // Fungsi untuk membuka pop-up Lamar Sekarang
            function openPopup(jobTitle) {
                jobTitleElement.textContent = jobTitle; // Set job title di dalam pop-up
                popup.style.display = "flex"; // Tampilkan pop-up
            }

            // Fungsi untuk menutup pop-up Lamar Sekarang
            function closePopup() {
                popup.style.display = "none"; // Sembunyikan pop-up
            }

            // Tambahkan event listener untuk tombol Apply
            applyButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const jobTitle = button.closest('.job-card').querySelector('.job-card__title').textContent;
                    openPopup(jobTitle);
                });
            });

            // Fungsi untuk menangani pengiriman form Apply
            form.addEventListener('submit', (event) => {
                event.preventDefault(); // Mencegah pengiriman default

                const formData = new FormData(form);

                fetch(form.getAttribute("action"), {
                        method: "POST",
                        body: formData
                    })
                    .then(response => {
                        if (response.ok) {
                            alert("Lamaran Anda berhasil dikirim!");
                            closePopup();
                        } else {
                            alert("Terjadi kesalahan, coba lagi.");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Terjadi kesalahan, coba lagi.");
                    });
            });
        </script>
    </body>

    </html>
</x-layout>

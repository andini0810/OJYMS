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
                    <form action="{{ route('findjobs') }}" method="GET">
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
                            <p class="job-card__description">Job Description: {{ $job->description }}</p>
                            <p class="job-card__company">Company: {{ $job->company }}</p>
                            <p class="job-card__location">Location: {{ $job->location }}</p>
                            <p class="job-card__post-date">Post Date: {{ $job->created_at->format('d M Y') }}</p>

                            <button class="apply-button" data-id="{{ $job->id }}"
                                onclick="openPopup('{{ $job->title }}', {{ $job->id }})">Apply</button>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination section has been removed -->
            </div>
        </section>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Pop-up Apply -->
        <div class="popup" id="applyPopup" style="display: none;">
            <div class="popup-content">
                <h2>Apply for <span id="jobTitle">Job Title</span></h2>
                <form id="applyForm" method="POST" action="{{ route('jobs.apply') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="jobsapply_id" name="jobsapply_id">
                    <div class="form-group">
                        <label for="applicantName">Full Name</label>
                        <input type="text" id="applicantName" name="full_name" placeholder="Enter your full name"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="applicantEmail">Email</label>
                        <input type="email" id="applicantEmail" name="email" placeholder="Enter your email address"
                            required>
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

        <!-- JavaScript -->
        <script>
            // Pilih elemen DOM
            const searchInput = document.querySelector('.search-input');
            const searchButton = document.querySelector('.search-button');
            const jobCards = document.querySelectorAll('.job-card');
            const applyButtons = document.querySelectorAll('.apply-button');
            const popup = document.getElementById("applyPopup");
            const form = document.getElementById("applyForm");

            // Fungsi pencarian
            function searchJobs() {
                const searchText = searchInput.value.toLowerCase();

                jobCards.forEach(jobCard => {
                    const jobTitle = jobCard.querySelector('.job-card__title').textContent.toLowerCase();
                    const jobCompany = jobCard.querySelector('.job-card__company').textContent.toLowerCase();

                    const isTextMatch = jobTitle.includes(searchText) || jobCompany.includes(searchText);

                    jobCard.style.display = isTextMatch ? 'block' : 'none';
                });
            }

            // Event listener pencarian
            searchButton.addEventListener('click', () => searchJobs());
            searchInput.addEventListener('input', () => searchJobs());

            // Fungsi untuk membuka pop-up Lamar Sekarang
            function openPopup(jobTitle, jobId) {
                const jobTitleElement = document.getElementById("jobTitle");
                const jobIdInput = document.getElementById("jobsapply_id");

                jobTitleElement.textContent = jobTitle; // Set judul pekerjaan
                jobIdInput.value = jobId; // Set ID pekerjaan
                popup.style.display = "flex"; // Tampilkan pop-up
            }

            // Fungsi untuk menutup pop-up
            function closePopup() {
                popup.style.display = "none";
            }

            // Tambahkan event listener untuk tombol Apply
            applyButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const jobCard = button.closest('.job-card');
                    const jobTitle = jobCard.querySelector('.job-card__title').textContent;
                    const jobId = button.getAttribute('data-id');
                    openPopup(jobTitle, jobId);
                });
            });
        </script>
    </body>

    </html>
</x-layout>


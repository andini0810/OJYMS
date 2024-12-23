<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/createjobs.css">
    <title>Create Jobs</title>
</head>

<x-layout>

    <body>

        <div class="container">
            <h1 class="title">Job Listings</h1>
            <table class="jobs-table">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Job Description</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Post Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs_creates as $job)
                        <tr>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->description }}</td>
                            <td>{{ $job->company }}</td>
                            <td>{{ $job->location }}</td>
                            <td>{{ $job->posted_date->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('editjob', $job->id) }}" class="edit-btn">Edit</a>
                                <form action="{{ route('deletejob', $job->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="add-job-btn" onclick="openPopup()">Add Job</button>
        </div>

        <!-- Pop-up Form -->
        <form action="{{ route('jobs.store') }}" method="POST" class="bg-gray-800 p-6 rounded-lg shadow-lg">
            @csrf
            <div class="popup" id="popup">
                <div class="popup-content">
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h2>Add New Job</h2>
                    <label for="title">Job Title</label>
                    <input type="text" id="title" name="title" placeholder="Enter job title" required>

                    <label for="description">Job Description</label>
                    <input type="text" id="description" name="description" placeholder="Enter job description" required>

                    <label for="company">Company</label>
                    <input type="text" id="company" name="company" placeholder="Enter company name" required>

                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" placeholder="Enter job location" required>

                    <label for="posted_date">Post Date</label>
                    <input type="date" id="posted_date" name="posted_date" required>

                    <div class="popup-buttons">
                        <button type="submit" class="create-btn" onclick="createJobs()">Create</button>
                        <button class="cancel-btn" onclick="closePopup()">Cancel</button>
                    </div>
                </div>
            </div>
        </form>

        <script>
            // Fungsi untuk membuka pop-up
            function openPopup() {
                document.getElementById("popup").style.display = "flex";
            }

            // Fungsi untuk menutup pop-up
            function closePopup() {
                document.getElementById("popup").style.display = "none";
            }

            // Fungsi untuk membuat pekerjaan baru dan menambahkannya ke tabel
            function createJob() {
                const jobTitle = document.getElementById("jobTitle").value;
                const jobDescription = document.getElementById("jobDescription").value;
                const companyName = document.getElementById("companyName").value;
                const location = document.getElementById("location").value;
                const postDate = document.getElementById("postDate").value;

                if (!jobTitle || !jobDescription || !companyName || !location || !postDate) {
                    alert("Please fill out all fields.");
                    return;
                }

                const tableBody = document.getElementById("jobTableBody");
                const newRow = document.createElement("tr");

                newRow.innerHTML = `
          <td>${jobTitle}</td>
          <td>${jobDescription}</td>
          <td>${companyName}</td>
          <td>${location}</td>
          <td>${postDate}</td>
          <td>
            <button class="action-btn edit-btn">Edit</button>
            <button class="action-btn delete-btn">Delete</button>
          </td>
        `;

                tableBody.appendChild(newRow);

                // Reset input field
                document.getElementById("jobTitle").value = '';
                document.getElementById("jobDescription").value = '';
                document.getElementById("companyName").value = '';
                document.getElementById("location").value = '';
                document.getElementById("postDate").value = '';

                closePopup();
            }
        </script>
    </body>
</x-layout>

</html>

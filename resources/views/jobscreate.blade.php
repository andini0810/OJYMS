<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/createjobs.css') }}">
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
                                <button onclick="openEditPopup({{ json_encode($job) }})" class="edit-btn">Edit</button>
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
            <button class="add-job-btn" onclick="openAddPopup()">Add Job</button>
        </div>
    
        <!-- Shared Popup Form -->
        <div class="popup" id="jobPopup">
            <div class="popup-content">
                <h2 id="popupTitle">Add New Job</h2>
                <form id="jobForm" method="POST">
                    @csrf
                    <div id="methodField"></div>
                    
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
    
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
                        <button type="submit" class="create-btn">Save</button>
                        <button type="button" class="cancel-btn" onclick="closePopup()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    
        <script>
            function openAddPopup() {
                const popup = document.getElementById('jobPopup');
                const form = document.getElementById('jobForm');
                const title = document.getElementById('popupTitle');
                const methodField = document.getElementById('methodField');
    
                // Reset form
                form.reset();
                
                // Set up for create
                title.textContent = 'Add New Job';
                form.action = "{{ route('jobs.store') }}";
                methodField.innerHTML = ''; // No method field needed for POST
    
                popup.style.display = 'flex';
            }
    
            function openEditPopup(job) {
                const popup = document.getElementById('jobPopup');
                const form = document.getElementById('jobForm');
                const title = document.getElementById('popupTitle');
                const methodField = document.getElementById('methodField');
    
                // Set up for edit
                title.textContent = 'Edit Job';
                form.action = `/jobs/${job.id}`;
                methodField.innerHTML = '@method("PUT")';
    
                // Fill form with job data
                document.getElementById('title').value = job.title;
                document.getElementById('description').value = job.description;
                document.getElementById('company').value = job.company;
                document.getElementById('location').value = job.location;
                document.getElementById('posted_date').value = job.posted_date.split('T')[0];
    
                popup.style.display = 'flex';
            }
    
            function closePopup() {
                document.getElementById('jobPopup').style.display = 'none';
            }
        </script>
    </body>
    
    </x-layout>

</html>

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobsCreate;
use App\Models\JobsApply;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;



class FindjobsController extends Controller
{
    public function showFindjobs(Request $request)
{
    // Ambil query pencarian dari parameter URL
    $search = $request->input('search');

    // Query untuk mengambil lowongan pekerjaan
    $jobs_creates = JobsCreate::with('user')
        ->when($search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
        })
        ->orderBy('posted_date', 'desc')
        ->get();

    return view('findjobs', compact('jobs_creates'));
}

    // public function showFindjobs()
    // {
    //     $jobs_creates = JobsCreate::with('user')->orderBy('posted_date', 'desc')->get();

    //     return view('findjobs', compact('jobs_creates'));
    // }

    public function createJobs()
    {

        $jobs_creates = JobsCreate::where('user_id', Auth::id())->get();
        return view('jobscreate', compact('jobs_creates'));
    }

    // Store a new job
    public function storeJob(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'posted_date' => 'required|date',
        ]);

        $posted_date = Carbon::parse($request->posted_date);

        JobsCreate::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'company' => $request->input('company'),
            'location' => $request->input('location'),
            'posted_date' => $posted_date,
        ]);

        return redirect()->route('findjobs');
    }

    public function edit($id)
    {
        // $jobs_creates = JobsCreate::findOrFail($id);

        // // Pastikan hanya user yang membuat job ini yang bisa mengedit
        // if ($jobs_creates->user_id !== Auth::id()) {
        //     abort(403, 'Unauthorized action.');
        // }

        // return view('jobscreate', compact('jobs_creates'));
        $jobs_creates = JobsCreate::where('user_id', Auth::id())->findOrFail($id);
        return view('jobscreate', compact('jobs_creates'));
    }

    public function update(Request $request, $id)
    {
        $jobs_creates = JobsCreate::findOrFail($id);

        if ($jobs_creates->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'posted_date' => 'required|date',
        ]);

        $jobs_creates->update($request->only('title', 'description', 'company', 'location', 'posted_date'));

        return redirect()->route('findjobs');
    }

    public function deleteJob($id)
    {
        $jobs_creates = JobsCreate::where('user_id', Auth::id())->findOrFail($id);

        // Pastikan hanya user yang membuat job ini yang bisa menghapus
        if ($jobs_creates->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hapus pekerjaan
        $jobs_creates->delete();

        return redirect()->route('findjobs');
    }


    public function applyJob(Request $request)
    {
        try {
            $request->validate([
                'jobsapply_id' => 'required|exists:jobs_creates,id',
                'full_name' => 'required|string|max:255',
                'email' => 'required|email',
                'cv_file' => 'required|file|mimes:pdf|max:2048',
            ]);

            if ($request->hasFile('cv_file')) {
                $file = $request->file('cv_file');

                // Check if file is valid
                if (!$file->isValid()) {
                    Log::error('Invalid file upload attempt');
                    return redirect()->back()->with('error', 'Invalid file upload.');
                }

                $fileName = time() . '_' . $file->getClientOriginalName();

                // Store file and get path
                $filePath = $file->storeAs('cv_files', $fileName, 'public');

                if (!$filePath) {
                    Log::error('File storage failed');
                    return redirect()->back()->with('error', 'Failed to store file.');
                }

                // Create database record
                $jobApplication = JobsApply::create([
                    'user_id' => Auth::id(),
                    'jobsapply_id' => $request->jobsapply_id,
                    'full_name' => $request->full_name,
                    'email' => $request->email,
                    'cv_link' => $filePath,
                ]);

                if (!$jobApplication) {
                    Log::error('Failed to create database record');
                    return redirect()->back()->with('error', 'Failed to save application.');
                }

                return redirect()->route('findjobs')->with('success', 'Application submitted successfully!');
            }

            return redirect()->back()->with('error', 'No file was uploaded.');
        } catch (\Exception $e) {
            Log::error('Job application error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while submitting your application.');
        }
    }

    public function showApplications()
    {
        // Get all applications with related job details
        $applications = JobsApply::with('job')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('alumni.applications', compact('applications'));
    }

    public function viewCV($id)
    {
        $application = JobsApply::findOrFail($id);
        $filePath = storage_path('app/public/' . $application->cv_link);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        return abort(404, 'CV file not found');
    }
}

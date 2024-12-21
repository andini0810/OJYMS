<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobsCreate;
use App\Models\JobsApply;
use App\Models\User;
use Carbon\Carbon;



class FindjobsController extends Controller
{
    public function showFindjobs()
    {
        $jobs_creates = JobsCreate::orderBy('posted_date', 'desc')->get();

        return view('findjobs', compact('jobs_creates'));
    }

    public function showJobs()
    {
        // Ambil jobs yang dibuat oleh user yang sedang login
        $jobs_creates = JobsCreate::where('user_id', auth()->id())->get();

        return view('jobscreate', compact('jobs_creates'));
    }

    public function createJobs()
    {
        return view('jobscreate');
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
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'company' => $request->input('company'),
            'location' => $request->input('location'),
            'posted_date' => $posted_date,
        ]);

        return redirect()->route('findjobs')->with('success', 'Job posted successfully!');
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
}

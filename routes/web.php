<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

//index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    // $jobs = Job::with('employer')->cursorPaginate(3);
    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

//create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

//show
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});

//store
Route::post('/jobs', function () {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    return redirect('/jobs');
});

//edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);
    return view('jobs.edit', ['job' => $job]);
});

//update
Route::patch('/jobs/{id}', function ($id) {
    //validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    //authorize pending

    //and persist
    $job = Job::findOrFail($id);
    //update the job
    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);
    //redirect to the job page
    return redirect('/jobs/' . $job->id);
});

//destroy
Route::delete('/jobs/{id}', function ($id) {
    //authorize on hold
    //delete a job
    $job = Job::findOrFail($id);
    $job->delete();

    return redirect('/jobs');
});


Route::get('/contact', function () {
    return view('contact');
});
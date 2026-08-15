<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\student\StoreProjectRequest;
use App\Models\researche;
use App\Models\ResearchFile;
use App\Notifications\ProjectSubmittedNotification;
use App\Utlis\FileManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.student.projects');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.student.submit_projects');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        DB::beginTransaction();
        try {
            $research = researche::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'status' => 'pending',
            'user_id' => auth()->user()->id,
            'hash' => hash('sha256', uniqid()),
        ]);
        $mainResearch = FileManager::upload($request->file('main_research'), 'researches');

        $registrationForm = FileManager::upload(
            $request->file('registration_form'),
            'researches'
        );

         ResearchFile::create([
            'research_id' => $research->id,
            'file_name' => basename($mainResearch),
            'file_path' => $mainResearch,
            'category' => 'main_research',
        ]);
        ResearchFile::create([
            'research_id' => $research->id,
            'file_name' => basename($registrationForm),
            'file_path' => $registrationForm,
            'category' => 'registration_form',
        ]);
        if ($request->hasFile('ethics_document')) {

            $path = FileManager::upload(
                $request->file('ethics_document'),
                'researches'
            );

            ResearchFile::create([
                'research_id' => $research->id,
                'file_name' => basename($path),
                'file_path' => $path,
                'category' => 'ethics_document',
            ]);
        }
        if ($request->hasFile('supporting_documents')) {
            foreach ($request->file('supporting_documents') as $file) {

                $path = FileManager::upload($file, 'researches');
                ResearchFile::create([
                    'research_id' => $research->id,
                    'file_name' => basename($path),
                    'file_path' => $path,
                    'category' => 'supporting_document',
                ]);
            }
        }

        DB::commit();
        auth()->user()->notify(
    new ProjectSubmittedNotification($research)
);
        return redirect()->back()->with('success','Your Project Uploaded Successeflly!');

        } catch (\Throwable $th) {
           DB::rollBack();
           dd($th);
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

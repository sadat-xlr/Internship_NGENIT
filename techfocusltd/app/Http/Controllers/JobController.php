<?php

namespace App\Http\Controllers;

use App\Job;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    
    public function jobSeeker()
    {
        $allJobs =   Job::select('id','title')->where('status',true)->get();
        return  view('informative.career.jobSeekerRegister', compact('allJobs'))
                                    ;
    }

    
    public function applicationList()
    {
        $applications    =   Application::all();
        return view('admin.applicationList', compact('applications',$applications));
    }


    public function jobApplication(Request $request)
    {
        
        $job =   Job::find($request->job_id);
        if ($job->status == false) {
            return redirect()->back()->with('error','This job is not Active ');
        }
        
        $this->validate($request,[
            'name'      =>  'required',
            'email'     =>  'required',
            'number'    =>  'required',
            'cv'        =>  'required|file|mimes:pdf|max:5000'
        ]);

        $fileNameToStore = '';
        if($request->hasFile('cv')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cv')->getClientOriginalName();
            // Get just filename
            $filename =str_slug( pathinfo($filenameWithExt, PATHINFO_FILENAME));
            // Get just ext
            $extension = $request->file('cv')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore=  $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cv')->storeAs('public/cv', $fileNameToStore);
        }

        $application  =   new Application;
        $application->name        =   $request->name;
        $application->email       =   $request->email;
        $application->number      =   $request->number;
        $application->experience      =   $request->experience;
        
        $application->job_id   =   $request->job_id;
        if($request->hasFile('cv')){
            $application->cv   =  $fileNameToStore ;
        }


        $application->save();
        $emails = $application->email ;

        // Send the mail
        Mail::send([], [], function($message) use ($request, $emails, $job, $application) {
            $message->from($emails);
          
            $message->to('admin@techfocusltd.com');
            $message->subject('Application for the post '.$job->title);
            $message->setBody('Application for the post '.$job->title, 'text/html');
            $message->attach('storage/cv/'.$application->cv, [
                'as' => $application->cv,
                'mime' => 'application/pdf',
            ]);
        });

        
      return redirect()->back()->with('success','application completed');

    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function career()
    {
        $jobs    =   Job::all();
        return view('informative.career.career', compact('jobs'));
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs    =   Job::all();
        return view('admin.allJobs', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addJob');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $job =   new Job;
        $job->title  =   $request->title;
        $job->deadline  =   $request->deadline;
        $job->description  =   $request->description;
        $job->status =  true;
        $job->save();
        return redirect('/all-jobs')->with('success','Job Posted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job =   Job::find($id);
        $allJobs =   Job::select('id','title')->where('status',true)->where('id','!=', $id)->get();
        return  view('informative.career.show', compact('job', 'allJobs'))
                                    ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job =   Job::find($id);
        return view('admin.editJob', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $job =   Job::find($id);
        $job->title  =   $request->title;
        $job->deadline  =   $request->deadline;
        $job->description  =   $request->description;
        $job->status =  true;
        $job->save();
        return redirect('/all-jobs')->with('success','Job Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job   =   Job::find($id);
        $job->delete();
        // $job->applicants()->detach();
        return redirect('/all-jobs')->with('success','Job Deleted');
    }
}

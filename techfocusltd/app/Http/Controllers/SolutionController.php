<?php

namespace App\Http\Controllers;

use App\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Session;

class SolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solutions = Solution::all();
		return view('informative.solution.solutions', ['solutions' => $solutions,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}        
        return view('admin.informative.solution.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}        

        // Validate form
		$validatedData = $this->validate($request, [
        'solutionName' => 'required',
        'description'   =>  'required',
        'solutionImage' => 'required|image|mimes:png,jpg,jpeg|max:1999'
		]);
				
		
		// Handel image upload 
		
		// Checks if the file exists
		if ($request->hasFile('solutionImage')){
			// Get file name with extension
			$fileNameWithExt = $request->file('solutionImage')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('solutionImage')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore = $fileName . str_random(20) . "." . $extension;
			// Directory to upload
			$path = $request->file('solutionImage')->storeAs('public/images/solution', $fileNameToStore);    
		}else{
			Session::put('error', 'Solution addition failed!');
			return redirect('/add-solution');
		}

		// Create instance of Category model & assign form value then save to database
		$solution = new Solution;
        $solution->solutionName = $request->solutionName;
		$solution->description = $request->description;
        $solution->image = $fileNameToStore;
        $solution->slug =   str_slug($request->solutionName);
		$solution->save();
		
		
		/* Checks if data is saved to database. If so, redirect to addCategories page with success message. Otherwise, redirect to addCategories page with error message */
		if($solution){
			Session::put('success', 'Solution added successfully.');
			return redirect('/add-solution');
		}else{
			Session::put('error', 'Solution addition failed!');
			return redirect('/add-solution');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
    {
        $solution   =   Solution::findOrFail($id);
        return view('informative.solution.solutionDetails')->with('solution', $solution);

    }

    	// Loads allSolutions view
	public function allSolution(Request $request){
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Solution::all();
		return view('admin.informative.solution.allSolution', ['solutions' => $result]);
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
		$result = Solution::where('id', $id)
               ->get();
		return view('admin.informative.solution.edit', [
		'solutions' => $result,
		'id' => $id,
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}        
        // Validate form
		$validatedData = $this->validate($request, [
            'solutionName' => 'required',
            'description'   =>  'required',
            'solutionImage' => 'image|mimes:png,jpg,jpeg|max:1999'
            ]);
                    
            
            // Handel image upload 
            
            // Checks if the file exists
            if ($request->hasFile('solutionImage')){
                // Get file name with extension
                $fileNameWithExt = $request->file('solutionImage')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('solutionImage')->getClientOriginalExtension();
                // Filename to store 
                $fileNameToStore = $fileName . str_random(20) . "." . $extension;
                // Directory to upload
                $path = $request->file('solutionImage')->storeAs('public/images/solution', $fileNameToStore);    
                			// Find the Category 
                $solution = Solution::find($id);
                // Get categoryImage & delete it from the directory
                Storage::delete('public/images/solution/'.$solution->image);
                $solution->solutionName = $request->solutionName;
                $solution->description = $request->description;
                $solution->image = $fileNameToStore;
                $solution->slug =   str_slug($request->solutionName);
                $solution->save();
                    
                /* Checks if data is updated to database. If so, redirect to editCategory page with success message. Otherwise, redirect to editCategory page with error message */
                if($solution){
                    Session::put('success', 'Solution added successfully.');
                    return redirect('edit-solution/'.$id);
                }else{
                    Session::put('error', 'Solution addition failed!');
                    return redirect('edit-solution/'.$id);
                }
            }
                // If image not selected update without editing the categoryImage field
            else{
                // Create instance of Category model & assign form value then save to database
                $solution = Solution::find($id);
                // Create instance of Category model & assign form value then save to database
                $solution->solutionName = $request->solutionName;
                $solution->description = $request->description;
                $solution->slug =   str_slug($request->solutionName);
                $solution->save();
                
                
                /* Checks if data is saved to database. If so, redirect to addCategories page with success message. Otherwise, redirect to addCategories page with error message */
                if($solution){
                    Session::put('success', 'Solution added successfully.');
                    return redirect('edit-solution/'.$id);
                }else{
                    Session::put('error', 'Solution addition failed!');
                    return redirect('edit-solution/'.$id);
                }
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
		// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        }     
           
        $solution = Solution::find($id);
		// Get blogImage & delete it from the directory
        Storage::delete('public/images/solution/'.$solution->image);
        $solution->subSolutions()->delete();
		$solution->delete();
				
		if($solution){
			Session::put('success', 'solutions deleted successfully.');
			return redirect('/all-solutions');
		}else{
			Session::put('error', 'solutions delete failed!');
			return redirect('/all-solutions');
		}
    }
}

<?php

namespace App\Http\Controllers;

use App\Subsolution;
use App\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Session;

class SubsolutionController extends Controller
{
    // Get subcategories associated with category 
	public function getSubSolution($solutionId){
		$subSolutions = Subsolution::select('subSolutionName', 'id')->where('solution_id', $solutionId)->get();
		
		$data = "<option value=''>--Select Sub-solution--</option>";
		foreach($subSolutions as $key => $subSolution)
		{
			$data .= "<option value='$subSolution->id'>$subSolution->subSolutionName</option>";
		}
		return $data;
	}	
        // Loads allCategories view
        public function allSubSolution(Request $request){
            // Checks if logged in
            if (!\Session::has('Name')){
                return redirect('/administration');
            }
            
            $result = Subsolution::all();
            return view('admin.informative.subSolution.allSubSolution', ['subSolutions' => $result]);
        }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subSolutions   =   Subsolution::all();
        return view('informative.subSolution.subSolutions')->with('subSolutions', $subSolutions);
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
        
        $solutions  =   Solution::all();
        return view('admin.informative.subSolution.create', ['solutions' => $solutions]);
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
        // Validate form data 
		$validatedData = $this->validate($request, [
        'subSolutionName' => 'required',
        'solution_id' => 'required',
        'description'   =>  'required',
        'subSolutionImage' => 'required|image|mimes:png,jpg,jpeg|max:1999'
        ]);
        // Handel image upload 
		// Checks if the file exists
		if ($request->hasFile('subSolutionImage')){
			// Get file name with extension
			$fileNameWithExt = $request->file('subSolutionImage')->getClientOriginalName();
			// Get only file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get only extension
			$extension = $request->file('subSolutionImage')->getClientOriginalExtension();
			// Filename to store 
			$fileNameToStore = $fileName . str_random(20) . "." . $extension;
			// Directory to upload
			$path = $request->file('subSolutionImage')->storeAs('public/images/subSolution', $fileNameToStore);    
		}else{
			Session::put('error', 'Subsolution addition failed!');
			return redirect('/add-subsolution');
		}
		
		// Create instance of SubCategory model & assign form value then save to database
		$subSolution = new Subsolution;
        $subSolution->subSolutionName = $request->subSolutionName;
        $subSolution->description   =   $request->description;
        $subSolution->solution_id = $request->solution_id;
        $subSolution->image = $fileNameToStore;
        $subSolution->slug =   str_slug($request->subSolutionName);
		$subSolution->save();
		
		/* Checks if data is saved to database. If so, redirect to addSubCategory page with success message. Otherwise, redirect to addSubCategory page with error message */
		if($subSolution){
			Session::put('success', 'Subsolution added successfully.');
			return redirect('/add-subsolution');
		}else{
			Session::put('error', 'Subsolution addition failed!');
			return redirect('/add-subsolution');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subsolution  $subsolution
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
    {
        $subSolution    =   Subsolution::FindOrFail($id);
        return view('informative.subSolution.details')->with('subSolution', $subSolution);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subsolution  $subsolution
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
		}
		
        $solutions = Solution::all();
		$result = Subsolution::where('id', $id)->first();
		return view('admin.informative.subSolution.edit', [
		'subSolution' => $result,
		'solutions' => $solutions,
		'id' => $id
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subsolution  $subsolution
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
                    'subSolutionName' => 'required',
                    'solution_id' => 'required',
                    'description'   =>  'required',
                    'solutionImage' => 'image|mimes:png,jpg,jpeg|max:1999'
                    ]);
                          
            
            // Handel image upload 
            
            // Checks if the file exists
            if ($request->hasFile('subSolutionName')){
                // Get file name with extension
                $fileNameWithExt = $request->file('subSolutionName')->getClientOriginalName();
                // Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get only extension
                $extension = $request->file('subSolutionName')->getClientOriginalExtension();
                // Filename to store 
                $fileNameToStore = $fileName . str_random(20) . "." . $extension;
                // Directory to upload
                $path = $request->file('subSolutionName')->storeAs('public/images/subSolution', $fileNameToStore);    
                			// Find the Category 
                $subSolution = Subsolution::find($id);
                // Get categoryImage & delete it from the directory
                Storage::delete('public/images/subSolution/'.$subSolution->image);
                $subSolution->subSolutionName = $request->subSolutionName;
                $subSolution->solution_id = $request->solution_id;
                $subSolution->description = $request->description;
                $subSolution->image = $fileNameToStore;
                $subSolution->slug =   str_slug($request->subSolutionName);
                $subSolution->save();

                    
                /* Checks if data is updated to database. If so, redirect to editCategory page with success message. Otherwise, redirect to editCategory page with error message */
                if($subSolution){
                    Session::put('success', 'Solution added successfully.');
                    return redirect('edit-subSolution/'.$id);
                }else{
                    Session::put('error', 'Solution addition failed!');
                    return redirect('edit-subSolution/'.$id);
                }
            }
                // If image not selected update without editing the categoryImage field
            else{
                // Create instance of Category model & assign form value then save to database
                $subSolution = Subsolution::find($id);
                // Create instance of Category model & assign form value then save to database
                $subSolution->subSolutionName = $request->subSolutionName;
                $subSolution->solution_id = $request->solution_id;
                $subSolution->description = $request->description;
                $subSolution->slug =   str_slug($request->subSolutionName);
                $subSolution->save();
                
                
                /* Checks if data is saved to database. If so, redirect to addCategories page with success message. Otherwise, redirect to addCategories page with error message */
                if($subSolution){
                    Session::put('success', 'Solution added successfully.');
                    return redirect('edit-subSolution/'.$id);
                }else{
                    Session::put('error', 'Solution addition failed!');
                    return redirect('edit-subSolution/'.$id);
                }
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subsolution  $subsolution
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    	// Checks if logged in
		if (!\Session::has('Name')){
			return redirect('/administration');
        } 
           
        $Subsolution = Subsolution::find($id);
		// Get blogImage & delete it from the directory
		Storage::delete('public/images/solution/'.$Subsolution->image);
		$Subsolution->delete();
				
		if($Subsolution){
			Session::put('success', 'Subsolution deleted successfully.');
			return redirect('/all-subSolutions');
		}else{
			Session::put('error', 'Subsolution delete failed!');
			return redirect('/all-subSolutions');
		}
    }
}

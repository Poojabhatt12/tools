<?php

namespace App\Http\Controllers;

use App\Models\JobDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchTerm = request()->get('search_job_name');
        $cityTerm = request()->get('search_city');
        if ($searchTerm || $cityTerm) {
            $jobDetails = JobDetail::where('job_name', 'LIKE', "%" . $searchTerm . "%")
                ->where('city', 'LIKE', "%" . $cityTerm . "%")
                ->paginate(10);
        } else {
            $jobDetails = JobDetail::paginate(10);
        }
        return view('jobDetail.index', compact('jobDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jobDetail  $jobDetail
     * @return \Illuminate\Http\Response
     */
    public function show(jobDetail $jobDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jobDetail  $jobDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(jobDetail $jobDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jobDetail  $jobDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jobDetail $jobDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jobDetail  $jobDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobDetail $jobDetail)
    {
        $jobDetail->delete();
        return back();
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        DB::table("job_details")->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => "Job-Detail Deleted successfully."]);
    }
}

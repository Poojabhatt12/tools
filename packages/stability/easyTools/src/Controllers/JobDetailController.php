<?php

namespace Stability\EasyTools\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Stability\EasyTools\Models\JobDetail;

class JobDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobDetail $jobDetail)
    {
        $jobDetails = $jobDetail->searchJobs();
        $columns = Schema::getColumnListing('job_details');
        return view('easyTools::jobDetail.index', compact('jobDetails','columns'));
    }

    public function destroy($id)
    {
        $jobDetail = JobDetail::find($id);
        $jobDetail->delete();
        return back();
    }

    public function deleteSelected(Request $request)
    {
        JobDetail::whereIn('id', explode(",", $request->ids))->delete();

        return response()->json(['success' => "Job-Detail Deleted successfully."]);
    }
}

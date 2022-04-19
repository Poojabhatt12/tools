<?php

namespace Stability\EasyTools;

// use Stability\EasyTools\Models\JobDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Stability\EasyTools\JobDetail;

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
        return view("stability::jobDetail.index", compact('jobDetails', 'columns'));
    }

    public function destroy($jId)
    {
        $jobDetail = JobDetail::find($jId);
        $jobDetail->delete();
        return back();
    }

    public function deleteSelected(Request $request)
    {
        JobDetail::whereIn('id', explode(",", $request->ids))->delete();

        return response()->json(['success' => "Job-Detail Deleted successfully."]);
    }
}

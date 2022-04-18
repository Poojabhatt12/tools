<?php

namespace Stability\EasyTools;

use App\Models\JobDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
        return view('jobDetail.index', compact('jobDetails','columns'));
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
        JobDetail::whereIn('id', explode(",", $request->ids))->delete();

        return response()->json(['success' => "Job-Detail Deleted successfully."]);
    }
}

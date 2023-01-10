<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use DataTables;
use File;
use Illuminate\Http\Request;
use Image;
use View;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show campaign list
    public function index()
    {
        return view('admin.offer.campaign.index');
    }

    // campaign data loaded by yajra datatable
    function list(Request $request) {
        if ($request->ajax()) {
            $campaigns = Campaign::all();

            return DataTables::of($campaigns)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = View::make('admin.offer.campaign.action', compact('row'));
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    //campaign store
    public function store(Request $request)
    {
        $request->validate([
            'campaign_title' => 'required|unique:campaigns|max:50',
            'campaign_start_date' => 'required|date',
            'campaign_end_date' => 'required|date|after_or_equal:start_date',
            'campaign_image' => 'required|mimes:png,jpg,jpeg|max:10000',
            'campaign_discount' => 'required',
            'campaign_status' => 'required|in:0,1',
        ]);

        $photo_campaign_path = null;
        if ($request->hasFile('campaign_image')) {
            $photo_campaign_path = $this->campaignFileUpload(null, $request->campaign_image, 468, 90);
        }

        Campaign::insert([
            'campaign_title' => $request->campaign_title,
            'campaign_start_date' => $request->campaign_start_date,
            'campaign_end_date' => $request->campaign_end_date,
            'campaign_image' => $photo_campaign_path,
            'campaign_discount' => $request->campaign_discount,
            'campaign_status' => $request->campaign_status,
            'campaign_month' => date('F'),
            'campaign_year' => date('Y'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Campaign Created', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //campaign edit
    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('admin.offer.campaign.edit', compact('campaign'));
    }

    //campaign update
    public function update(Request $request, $id)
    {
        $request->validate([
            'campaign_title' => 'required|max:50|unique:campaigns,campaign_title,' . $id,
            'campaign_start_date' => 'required|date',
            'campaign_end_date' => 'required|date|after_or_equal:start_date',
            'campaign_image' => 'mimes:png,jpg,jpeg|max:10000',
            'campaign_discount' => 'required',
            'campaign_status' => 'required|in:0,1',
        ]);

        $campaign = Campaign::where('id', $id)->first();
        $photo_campaign_path = $campaign->campaign_image;
        if ($request->hasFile('campaign_image')) {
            $photo_campaign_path = $this->campaignFileUpload($campaign->campaign_image, $request->campaign_image, 468, 90);
        }

        $campaign->update([
            'campaign_title' => $request->campaign_title,
            'campaign_start_date' => $request->campaign_start_date,
            'campaign_end_date' => $request->campaign_end_date,
            'campaign_image' => $photo_campaign_path,
            'campaign_discount' => $request->campaign_discount,
            'campaign_status' => $request->campaign_status,
            'campaign_month' => date('F'),
            'campaign_year' => date('Y'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Campaign Updated', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //campaign delete
    public function destroy($id)
    {
        $campaign = Campaign::where('id', $id)->first();

        if (File::exists($campaign->campaign_image)) {
            File::delete($campaign->campaign_image);
        }

        $campaign->delete();

        return response()->json('Campaign Deleted');
    }

    //campaign file upload
    protected function campaignFileUpload($file_path, $photo, $width, $height)
    {
        if ($file_path && File::exists($file_path)) {
            File::delete($file_path);
        }

        $photoname = uniqid() . '.' . $photo->getClientOriginalExtension();
        $photo_path = "public/files/campaign/" . $photoname;
        Image::make($photo)->resize($width, $height)->save($photo_path);

        return $photo_path;
    }
}

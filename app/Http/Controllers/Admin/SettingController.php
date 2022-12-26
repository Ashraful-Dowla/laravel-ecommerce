<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //seo page show
    public function seo()
    {
        $seo_data = DB::table('seos')->first();
        return view('admin.setting.seo', compact('seo_data'));
    }

    //seo update
    public function seoUpdate(Request $request, $id)
    {
        DB::table('seos')->where('id', $id)->update([
            "meta_title" => $request->meta_title,
            "meta_author" => $request->meta_author,
            "meta_tag" => $request->meta_tag,
            "meta_keyword" => "$request->meta_keyword",
            "google_verification" => $request->google_verification,
            "google_analytics" => $request->google_analytics,
            "google_adsense" => $request->google_adsense,
            "alexa_verification" => $request->alexa_verification,
            "meta_description" => $request->meta_description,
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'SEO Updated', 'alert_type' => 'success');
        return back()->with($notification);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use File;
use Illuminate\Http\Request;
use Image;

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

    //smtp page show
    public function smtp()
    {
        $smtp_data = DB::table('smtp')->first();
        return view('admin.setting.smtp', compact('smtp_data'));
    }

    //smtp update
    public function smtpUpdate(Request $request, $id)
    {
        DB::table('smtp')->where('id', $id)->update([
            "mailer" => $request->mailer,
            "host" => $request->host,
            "port" => $request->port,
            "user_name" => "$request->user_name",
            "password" => $request->password,
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'SMTP Updated', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //website page show
    public function website()
    {
        $website_data = DB::table('settings')->first();
        return view('admin.setting.website_setting', compact('website_data'));
    }

    //website update
    public function websiteUpdate(Request $request, $id)
    {
        $website_data = DB::table('settings')->where('id', $id)->first();
        $photo_logo_path = $website_data->logo;

        if ($request->logo) {
            $photo_logo_path = $this->websiteSettingFile($photo_logo_path, $request->logo, 240, 120);
        }

        $photo_favicon_path = $website_data->favicon;
        if ($request->favicon) {
            $photo_favicon_path = $this->websiteSettingFile($photo_favicon_path, $request->favicon, 32, 32);
        }

        DB::table('settings')->where('id', $id)->update([
            "currency" => $request->currency,
            "phone_one" => $request->phone_one,
            "phone_two" => $request->phone_two,
            "main_email" => "$request->main_email",
            "support_email" => $request->support_email,
            'logo' => $photo_logo_path,
            'favicon' => $photo_favicon_path,
            "address" => $request->address,
            "facebook" => $request->facebook,
            "twitter" => $request->twitter,
            "instagram" => $request->instagram,
            "linkedin" => $request->linkedin,
            "youtube" => $request->youtube,
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Website Setting Updated', 'alert_type' => 'success');
        return back()->with($notification);
    }

    protected function websiteSettingFile($file_path, $photo, $width, $height)
    {
        if (File::exists($file_path)) {
            File::delete($file_path);
        }

        $photoname = uniqid() . '.' . $photo->getClientOriginalExtension();
        $photo_path = "public/files/setting/" . $photoname;
        Image::make($photo)->resize($width, $height)->save($photo_path);

        return $photo_path;
    }

}

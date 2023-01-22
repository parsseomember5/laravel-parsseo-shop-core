<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSetting;
use App\Models\ArticleSetting;
use App\Models\CounterBoxSetting;
use App\Models\EventsSetting;
use App\Models\FeaturesSetting;
use App\Models\FeedbacksSetting;
use App\Models\GatewaySetting;
use App\Models\GeneralSetting;
use App\Models\HeroSetting;
use App\Models\LandingAboutUs;
use App\Models\LandingAppdesign;
use App\Models\LandingContactUs;
use App\Models\LandingSeo;
use App\Models\LandingWebdesign;
use App\Models\PortfoliosSetting;
use App\Models\SmsSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function general(){
        if (session()->has('locale')) $locale = session('locale'); else $locale = 'fa';
        $settings = GeneralSetting::where('locale',$locale)->first();
        return view('admin.views.settings.general',compact('settings'));
    }

    public function gateways(){
        $settings = GatewaySetting::first();
        return view('admin.views.settings.gateways',compact('settings'));
    }

    public function sms(){
        $settings = SmsSetting::first();
        return view('admin.views.settings.sms',compact('settings'));
    }

    public function about(){
        if (session()->has('locale')) $locale = session('locale'); else $locale = 'fa';
        $settings = AboutSetting::where('locale',$locale)->first();
        return view('admin.views.settings.about',compact('settings'));
    }

    public function articles(){
        if (session()->has('locale')) $locale = session('locale'); else $locale = 'fa';
        $settings = ArticleSetting::where('locale',$locale)->first();
        return view('admin.views.settings.articles',compact('settings'));
    }

    public function counters(){
        if (session()->has('locale')) $locale = session('locale'); else $locale = 'fa';
        $settings = CounterBoxSetting::where('locale',$locale)->first();
        return view('admin.views.settings.counters',compact('settings'));
    }

    public function feedbacks(){
        if (session()->has('locale')) $locale = session('locale'); else $locale = 'fa';
        $settings = FeedbacksSetting::where('locale',$locale)->first();
        return view('admin.views.settings.feedbacks',compact('settings'));
    }

    public function contactUs(){
        if (session()->has('locale')) $locale = session('locale'); else $locale = 'fa';
        $settings = LandingContactUs::where('locale',$locale)->first();
        return view('admin.views.settings.contact_us',compact('settings'));
    }

    public function aboutUs()
    {
        if (session()->has('locale')) $locale = session('locale'); else $locale = 'fa';
        $settings = LandingAboutUs::where('locale', $locale)->first();
        return view('admin.views.settings.about_us', compact('settings'));
    }

    public function updateGeneral(Request $request){
        $request->validate([
            'header_address' => 'nullable|string|max:255',
            'header_email' => 'nullable|string|max:255',
            'header_btn_link' => 'nullable|string|max:255',
            'header_btn_text' => 'nullable|string|max:255',
            'header_btn_icon' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'header_logo' => 'nullable|mimes:jpeg,jpg,png,gif',
            'footer_logo' => 'nullable|mimes:jpeg,jpg,png,gif',
            'footer_under_logo_text' => 'nullable|string|max:255',
            'footer_list1_title' => 'nullable|string|max:255',
            'footer_list2_title' => 'nullable|string|max:255',
            'footer_list3_title' => 'nullable|string|max:255',
            'footer_phone' => 'nullable|string|max:255',
            'footer_email' => 'nullable|string|max:255',
            'footer_address' => 'nullable|string|max:255',
            'footer_copyright' => 'nullable|string|max:1024',
            'footer_box_small_text' => 'nullable|string|max:255',
            'footer_box_large_text' => 'nullable|string|max:255',
            'footer_box_btn_text' => 'nullable|string|max:255',
            'footer_box_btn_icon' => 'nullable|string|max:255',
            'footer_box_btn_link' => 'nullable|string|max:255',
            'footer_image' => 'nullable|mimes:jpeg,jpg,png,gif',
            'popup_title' => 'nullable|string|max:255',
            'popup_description' => 'nullable|string|max:512',
            'popup_image' => 'nullable|mimes:jpeg,jpg,png,gif',
        ]);
        $inputs = request()->all();
        if (session()->has('locale')) $locale = session('locale'); else $locale = 'fa';

        // header logo
        if ($request->remove_header_logo != null) {
            $fileUrl = request('remove_header_logo');
            $this->removeStorageFile($fileUrl);
            $inputs['header_logo'] = null;
        }
        if ($request->hasFile('header_logo')) {
            $imageFile = $request->file('header_logo');
            $inputs['header_logo'] = $this->uploadRealFile($imageFile,'settings');
        }

        // header mobile logo
        if ($request->remove_header_mobile_logo != null) {
            $fileUrl = request('remove_header_mobile_logo');
            $this->removeStorageFile($fileUrl);
            $inputs['header_mobile_logo'] = null;
        }
        if ($request->hasFile('header_mobile_logo')) {
            $imageFile = $request->file('header_mobile_logo');
            $inputs['header_mobile_logo'] = $this->uploadRealFile($imageFile,'settings');
        }

        // footer logo
        if ($request->remove_footer_logo != null) {
            $fileUrl = request('remove_footer_logo');
            $this->removeStorageFile($fileUrl);
            $inputs['footer_logo'] = null;
        }
        if ($request->hasFile('footer_logo')) {
            $imageFile = $request->file('footer_logo');
            $inputs['footer_logo'] = $this->uploadRealFile($imageFile,'settings');
        }

        // footer image
        if ($request->remove_footer_image != null) {
            $fileUrl = request('remove_footer_image');
            $this->removeStorageFile($fileUrl);
            $inputs['footer_image'] = null;
        }
        if ($request->hasFile('footer_image')) {
            $imageFile = $request->file('footer_image');
            $inputs['footer_image'] = $this->uploadRealFile($imageFile,'settings');
        }

        // popup image
        if ($request->remove_popup_image != null) {
            $fileUrl = request('remove_popup_image');
            $this->removeStorageFile($fileUrl);
            $inputs['popup_image'] = null;
        }
        if ($request->hasFile('popup_image')) {
            $imageFile = $request->file('popup_image');
            $inputs['popup_image'] = $this->uploadRealFile($imageFile,'settings');
        }

        $settings= GeneralSetting::where('locale',$locale)->first();
        $settings->update($inputs);
        session()->flash('success','تغییرات با موفقیت ذخیره شد.');
        return redirect()->back();
    }

    public function updateAbout(Request $request){
        $request->validate([
            'about_image' => 'nullable|mimes:jpeg,jpg,png,gif',
            'about_video_image' => 'nullable|mimes:jpeg,jpg,png,gif',
            'about_video_link' => 'nullable|string|max:255',
            'about_uptitle' => 'nullable|string|max:255',
            'about_title' => 'nullable|string|max:255',
            'about_text' => 'nullable|string|max:512',
            'about_btn_text' => 'nullable|string|max:255',
            'about_btn_icon' => 'nullable|string|max:255',
            'about_btn_link' => 'nullable|string|max:255',
            'about_item1_title' => 'nullable|string|max:255',
            'about_item1_text' => 'nullable|string|max:255',
            'about_item2_title' => 'nullable|string|max:255',
            'about_item2_text' => 'nullable|string|max:255',
            'about_item3_title' => 'nullable|string|max:255',
            'about_item3_text' => 'nullable|string|max:255',
            'about2_image' => 'nullable|mimes:jpeg,jpg,png,gif',
            'about2_uptitle' => 'nullable|string|max:255',
            'about2_title' => 'nullable|string|max:255',
            'about2_text' => 'nullable|string|max:512',
            'about2_btn_text' => 'nullable|string|max:255',
            'about2_btn_icon' => 'nullable|string|max:255',
            'about2_btn_link' => 'nullable|string|max:255',
            'about2_item1_title' => 'nullable|string|max:255',
            'about2_item1_text' => 'nullable|string|max:255',
            'about2_item2_title' => 'nullable|string|max:255',
            'about2_item2_text' => 'nullable|string|max:255',
            'about2_item3_title' => 'nullable|string|max:255',
            'about2_item3_text' => 'nullable|string|max:255',
            'about3_image' => 'nullable|mimes:jpeg,jpg,png,gif',
            'about3_uptitle' => 'nullable|string|max:255',
            'about3_title' => 'nullable|string|max:255',
            'about3_text' => 'nullable|string|max:512',
            'about3_btn_text' => 'nullable|string|max:255',
            'about3_btn_icon' => 'nullable|string|max:255',
            'about3_btn_link' => 'nullable|string|max:255',
            'about3_item1_title' => 'nullable|string|max:255',
            'about3_item1_text' => 'nullable|string|max:255',
            'about3_item2_title' => 'nullable|string|max:255',
            'about3_item2_text' => 'nullable|string|max:255',
            'about3_item3_title' => 'nullable|string|max:255',
            'about3_item3_text' => 'nullable|string|max:255',
        ]);
        $inputs = request()->all();
        if (session()->has('locale')) $locale = session('locale'); else $locale = 'fa';

        // image
        if ($request->remove_about_image != null) {
            $fileUrl = request('remove_about_image');
            $this->removeStorageFile($fileUrl);
            $inputs['about_image'] = null;
        }
        if ($request->hasFile('about_image')) {
            $imageFile = $request->file('about_image');
            $inputs['about_image'] = $this->uploadRealFile($imageFile,'settings');
        }

        // image 2
        if ($request->remove_about2_image != null) {
            $fileUrl = request('remove_about2_image');
            $this->removeStorageFile($fileUrl);
            $inputs['about2_image'] = null;
        }
        if ($request->hasFile('about2_image')) {
            $imageFile = $request->file('about2_image');
            $inputs['about2_image'] = $this->uploadRealFile($imageFile,'settings');
        }

        // image 3
        if ($request->remove_about3_image != null) {
            $fileUrl = request('remove_about3_image');
            $this->removeStorageFile($fileUrl);
            $inputs['about3_image'] = null;
        }
        if ($request->hasFile('about3_image')) {
            $imageFile = $request->file('about3_image');
            $inputs['about3_image'] = $this->uploadRealFile($imageFile,'settings');
        }

        // video image
        if ($request->remove_about_video_image != null) {
            $fileUrl = request('remove_about_video_image');
            $this->removeStorageFile($fileUrl);
            $inputs['about_video_image'] = null;
        }
        if ($request->hasFile('about_video_image')) {
            $imageFile = $request->file('about_video_image');
            $inputs['about_video_image'] = $this->uploadRealFile($imageFile,'settings');
        }

        $settings= AboutSetting::where('locale',$locale)->first();
        $settings->update($inputs);
        session()->flash('success','تغییرات با موفقیت ذخیره شد.');
        return redirect()->back();
    }

    public function updateArticles(Request $request){
        $request->validate([
            'articles_uptitle' => 'nullable|string|max:255',
            'articles_title' => 'nullable|string|max:255',
            'articles_count' => 'nullable|string|max:255',
        ]);
        $inputs = request()->all();
        if (session()->has('locale')) $locale = session('locale'); else $locale = 'fa';

        $settings= ArticleSetting::where('locale',$locale)->first();
        $settings->update($inputs);
        session()->flash('success','تغییرات با موفقیت ذخیره شد.');
        return redirect()->back();
    }

    public function updateCounters(Request $request){
        $request->validate([
            'counter_box1_icon' =>  'nullable|string|max:255',
            'counter_box1_number' =>  'nullable|string|max:255',
            'counter_box1_title' =>  'nullable|string|max:255',
            'counter_box1_text' =>  'nullable|string|max:255',
            'counter_box2_icon' =>  'nullable|string|max:255',
            'counter_box2_number' =>  'nullable|string|max:255',
            'counter_box2_title' =>  'nullable|string|max:255',
            'counter_box2_text' =>  'nullable|string|max:255',
            'counter_box3_icon' =>  'nullable|string|max:255',
            'counter_box3_number' =>  'nullable|string|max:255',
            'counter_box3_title' =>  'nullable|string|max:255',
            'counter_box3_text' =>  'nullable|string|max:255',
            'counter_box4_icon' =>  'nullable|string|max:255',
            'counter_box4_number' =>  'nullable|string|max:255',
            'counter_box4_title' =>  'nullable|string|max:255',
            'counter_box4_text' =>  'nullable|string|max:255',
        ]);
        $inputs = request()->all();
        if (session()->has('locale')) $locale = session('locale'); else $locale = 'fa';

        $settings= CounterBoxSetting::where('locale',$locale)->first();
        $settings->update($inputs);
        session()->flash('success','تغییرات با موفقیت ذخیره شد.');
        return redirect()->back();
    }

    public function updateFeedbacks(Request $request){
        $request->validate([
            'feedbacks_uptitle' => 'nullable|string|max:255',
            'feedbacks_title' => 'nullable|string|max:255',
            'feedbacks_count' => 'nullable|string|max:255',
        ]);
        $inputs = request()->all();

        if (session()->has('locale')) $locale = session('locale'); else $locale = 'fa';

        $settings= FeedbacksSetting::where('locale',$locale)->first();
        $settings->update($inputs);
        session()->flash('success','تغییرات با موفقیت ذخیره شد.');
        return redirect()->back();
    }

    public function updateContactUs(Request $request){
        $request->validate([

            'page_title' => 'nullable|string|max:255',
            'uptitle' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1024',
            'address' => 'nullable|string|max:255',
            'support' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'map' => 'nullable|string|max:1024',
            'form_title' => 'nullable|string|max:255',
            'form_description' => 'nullable|string|max:512',
        ]);
        $inputs = request()->all();
        if (session()->has('locale')) $locale = session('locale'); else $locale = 'fa';


        $settings= LandingContactUs::where('locale',$locale)->first();
        $settings->update($inputs);
        session()->flash('success','تغییرات با موفقیت ذخیره شد.');
        return redirect()->back();
    }

    public function updateAboutUs(Request $request){
        $request->validate([
            'page_title' => 'nullable|string|max:255',
            'uptitle' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:512',
            'items' => 'nullable|string|max:512',
            'image'  =>  'nullable|mimes:jpeg,jpg,png,gif',
            'features_uptitle' => 'nullable|string|max:255',
            'features_title' => 'nullable|string|max:255',
            'features_box1_icon' => 'nullable|string|max:255',
            'features_box1_title' => 'nullable|string|max:255',
            'features_box1_text' => 'nullable|string|max:255',
            'features_box2_icon' => 'nullable|string|max:255',
            'features_box2_title' => 'nullable|string|max:255',
            'features_box2_text' => 'nullable|string|max:255',
            'features_box3_icon' => 'nullable|string|max:255',
            'features_box3_title' => 'nullable|string|max:255',
            'features_box3_text' => 'nullable|string|max:255',
            'team_uptitle' => 'nullable|string|max:255',
            'team_title' => 'nullable|string|max:255',
            'feedback_uptitle' => 'nullable|string|max:255',
            'feedback_title' => 'nullable|string|max:255',
        ]);
        $inputs = request()->all();
        if (session()->has('locale')) $locale = session('locale'); else $locale = 'fa';

        // image
        if ($request->remove_image != null) {
            $fileUrl = request('remove_image');
            $this->removeStorageFile($fileUrl);
            $inputs['image'] = null;
        }
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $inputs['image'] = $this->uploadRealFile($imageFile,'settings');
        }

        $settings= LandingAboutUs::where('locale',$locale)->first();
        $settings->update($inputs);
        session()->flash('success','تغییرات با موفقیت ذخیره شد.');
        return redirect()->back();
    }

    public function updateGateways(Request $request){
        $request->validate([
            'description'  =>  'required|string|max:500',
            'zarinpal_merchant' => 'nullable|string|max:190',
        ]);

        GatewaySetting::first()->update($request->all());
        session()->flash('success','تغییرات با موفقیت ذخیره شد.');
        return redirect()->back();
    }

    public function updateSMS(Request $request){
        $request->validate([
            'default'  =>  'required',
            'kavenegar_token' => 'nullable|string|max:190',
            'kavenegar_pattern' => 'nullable|string|max:190',
        ]);

        SmsSetting::first()->update($request->all());
        session()->flash('success','تغییرات با موفقیت ذخیره شد.');
        return redirect()->back();
    }
}

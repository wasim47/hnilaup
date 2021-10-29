<?php

namespace App\Http\Controllers\Hospital;

use Illuminate\Database\Schema\Blueprint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Hospital;
use App\HospitalUser;
use App\Menu;
use App\Icutype;
use App\IcuReport;
use App\BedReport;
use App\IcuInformation;
use Auth;
use Carbon\Carbon;
use Schema;
use Session;
use DB;
use Image;
use Hash;
use DateTime;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		 $this->middleware('auth:hospital');
    }

    public function weeklyReports()
    {      
		$userid = Auth::guard('hospital')->user()->id;
		$hospid = Auth::guard('hospital')->user()->hospital_id;
		$usertype = Auth::guard('hospital')->user()->usertype;
		
		$hospitalinfos = Hospital::where('id',$hospid)->first();
		$custominfo = HospitalUser::where('id',$userid)->first();
		
		$menus = Menu::all();	
		
		$dailytransaction = DB::table('bed_reports AS b')
		->leftJoin('icu_reports AS i', 'i.hospital_id', '=', 'b.hospital_id')
		->select('i.today_available_icu', 'i.today_icu_patient','b.today_bed_patient','b.today_available_bed','b.updated_at','b.changed_by')
		->where('b.hospital_id',$hospid)->orderBy('b.updated_at','DESC')->limit(10)->get();
		
		////////////////// Saturday patient reports//////////////////////////////////////////////////	
		$satReportIcu = DB::table('icu_reports')->where('day','Sat')->where('hospital_id',$hospid);
		if($satReportIcu->first()!=""){
			$totalSatPatIcu = $satReportIcu->sum('today_icu_patient');
		}
		else{
			$totalSatPatIcu = 0;
		}
		
		$satReportBed = DB::table('bed_reports')->where('day','Sat')->where('hospital_id',$hospid);
		if($satReportBed->first()!=""){
			$totalSatPatBed = $satReportBed->sum('today_bed_patient');
		}
		else{
			$totalSatPatBed = 0;
		}
		
		
		////////////////// Sunday patient reports//////////////////////////////////////////////////	
		$sunReportIcu = DB::table('icu_reports')->where('day','Sun')->where('hospital_id',$hospid);
		if($sunReportIcu->first()!=""){
			$totalsunPatIcu = $sunReportIcu->sum('today_icu_patient');
		}
		else{
			$totalsunPatIcu = 0;
		}
		
		$sunReportBed = DB::table('bed_reports')->where('day','Sun')->where('hospital_id',$hospid);
		if($sunReportBed->first()!=""){
			$totalsunPatBed = $sunReportBed->sum('today_bed_patient');
		}
		else{
			$totalsunPatBed = 0;
		}
		
		
		
		////////////////// monurday patient reports//////////////////////////////////////////////////	
		$monReportIcu = DB::table('icu_reports')->where('day','Mon')->where('hospital_id',$hospid);
		if($monReportIcu->first()!=""){
			$totalmonPatIcu = $monReportIcu->sum('today_icu_patient');
		}
		else{
			$totalmonPatIcu = 0;
		}
		
		$monReportBed = DB::table('bed_reports')->where('day','Mon')->where('hospital_id',$hospid);
		if($monReportBed->first()!=""){
			$totalmonPatBed = $monReportBed->sum('today_bed_patient');
		}
		else{
			$totalmonPatBed = 0;
		}
		
		////////////////// tuesday patient reports//////////////////////////////////////////////////	
		$tueReportIcu = DB::table('icu_reports')->where('day','Tue')->where('hospital_id',$hospid);
		if($tueReportIcu->first()!=""){
			$totaltuePatIcu = $tueReportIcu->sum('today_icu_patient');
		}
		else{
			$totaltuePatIcu = 0;
		}
		
		$tueReportBed = DB::table('bed_reports')->where('day','Tue')->where('hospital_id',$hospid);
		if($tueReportBed->first()!=""){
			$totaltuePatBed = $tueReportBed->sum('today_bed_patient');
		}
		else{
			$totaltuePatBed = 0;
		}
		
		////////////////// Wednestdyay patient reports//////////////////////////////////////////////////	
		$wedReportIcu = DB::table('icu_reports')->where('day','Wed')->where('hospital_id',$hospid);
		if($wedReportIcu->first()!=""){
			$totalwedPatIcu = $wedReportIcu->sum('today_icu_patient');
		}
		else{
			$totalwedPatIcu = 0;
		}
		
		$wedReportBed = DB::table('bed_reports')->where('day','Wed')->where('hospital_id',$hospid);
		if($wedReportBed->first()!=""){
			$totalwedPatBed = $wedReportBed->sum('today_bed_patient');
		}
		else{
			$totalwedPatBed = 0;
		}
		
		
		////////////////// Thursday patient reports//////////////////////////////////////////////////	
		$thuReportIcu = DB::table('icu_reports')->where('day','Thu')->where('hospital_id',$hospid);
		if($thuReportIcu->first()!=""){
			$totalthuPatIcu = $thuReportIcu->sum('today_icu_patient');
		}
		else{
			$totalthuPatIcu = 0;
		}
		
		$thuReportBed = DB::table('bed_reports')->where('day','Thu')->where('hospital_id',$hospid);
		if($thuReportBed->first()!=""){
			$totalthuPatBed = $thuReportBed->sum('today_bed_patient');
		}
		else{
			$totalthuPatBed = 0;
		}
		
		
		////////////////// Friday patient reports//////////////////////////////////////////////////	
		$friReportIcu = DB::table('icu_reports')->where('day','Fri')->where('hospital_id',$hospid);
		if($friReportIcu->first()!=""){
			$totalfriPatIcu = $friReportIcu->sum('today_icu_patient');
		}
		else{
			$totalfriPatIcu = 0;
		}
		
		$friReportBed = DB::table('bed_reports')->where('day','Fri')->where('hospital_id',$hospid);
		if($friReportBed->first()!=""){
			$totalfriPatBed = $friReportBed->sum('today_bed_patient');
		}
		else{
			$totalfriPatBed = 0;
		}
		
		
		
		$totalSatData = $totalSatPatBed + $totalSatPatIcu;
		$totalSunData = $totalsunPatIcu + $totalsunPatIcu;
		$totalMonData = $totalmonPatIcu + $totalmonPatBed;
		$totalTueData = $totaltuePatIcu + $totaltuePatBed;
		$totalWedData = $totalwedPatIcu + $totalwedPatBed;
		$totalThuData = $totalthuPatIcu + $totalthuPatBed;
		$totalFriData = $totalfriPatIcu + $totalfriPatBed;
		
		
		$totalFinalInfor = DB::table('icu_information')->where('hospital_id',$hospid);
		if($totalFinalInfor->first()!=""){
			$hospitalTotalBed = $totalFinalInfor->sum('totaldata');
			$inpatient_data = $totalFinalInfor->sum('inpatient_data');
			$available_data = $totalFinalInfor->sum('available_data');
		}
		else{
			$hospitalTotalBed = 0;
			$inpatient_data = 0;
			$available_data = 0;
		}
		
		
		return view('frontend.hospital.weekly-reports',compact('menus','hospitalTotalBed','totalSatData','totalSunData','totalMonData','totalTueData','totalWedData','totalThuData','totalFriData','dailytransaction','inpatient_data','available_data','hospitalinfos'));
    }
	
	
	
	public function dailyReports()
    {      
		$userid = Auth::guard('hospital')->user()->id;
		$hospid = Auth::guard('hospital')->user()->hospital_id;
		$usertype = Auth::guard('hospital')->user()->usertype;
		
		$hospitalinfos = Hospital::where('id',$hospid)->first();
		$custominfo = HospitalUser::where('id',$userid)->first();
		
		$menus = Menu::all();	
		
		$dailytransaction = DB::table('bed_reports AS b')
		->leftJoin('icu_reports AS i', 'i.hospital_id', '=', 'b.hospital_id')
		->select('i.today_available_icu', 'i.today_icu_patient','b.today_bed_patient','b.today_available_bed','b.updated_at','b.changed_by')
		->where('b.hospital_id',$hospid)->orderBy('b.updated_at','DESC')->limit(10)->get();
		
		
		$time_from1 = date('Y-m-d' . ' 00:00:00', time());
		$time_to1 = date('Y-m-d' . ' 03:60:60', time());
		
		$time_from2 = date('Y-m-d' . ' 04:00:00', time());
		$time_to2 = date('Y-m-d' . ' 07:60:60', time());
		
		$time_from3 = date('Y-m-d' . ' 8:00:00', time());
		$time_to3 = date('Y-m-d' . ' 11:60:60', time());
		
		$time_from4 = date('Y-m-d' . ' 12:00:00', time());
		$time_to4 = date('Y-m-d' . ' 15:60:60', time());
		
		$time_from5 = date('Y-m-d' . ' 16:00:00', time());
		$time_to5 = date('Y-m-d' . ' 19:60:60', time());
		
		$time_from6 = date('Y-m-d' . ' 20:00:00', time());
		$time_to6 = date('Y-m-d' . ' 23:60:60', time());
			
		////////////////// Time 1 patient reports//////////////////////////////////////////////////	
		$time1ReportIcu = DB::table('icu_reports')->whereBetween('updated_at', array($time_from1, $time_to1))->where('hospital_id',$hospid);
		if($time1ReportIcu->first()!=""){
			$totalTime1PatIcu = $time1ReportIcu->sum('today_icu_patient');
		}
		else{
			$totalTime1PatIcu = 0;
		}
		
		$time1ReportBed = DB::table('bed_reports')->whereBetween('updated_at', array($time_from1, $time_to1))->where('hospital_id',$hospid);
		if($time1ReportBed->first()!=""){
			$totalTime1PatBed = $time1ReportBed->sum('today_bed_patient');
		}
		else{
			$totalTime1PatBed = 0;
		}
		
		////////////////// Time 2 patient reports//////////////////////////////////////////////////	
		$time2ReportIcu = DB::table('icu_reports')->whereBetween('updated_at', array($time_from2, $time_to2))->where('hospital_id',$hospid);
		if($time2ReportIcu->first()!=""){
			$totalTime2PatIcu = $time2ReportIcu->sum('today_icu_patient');
		}
		else{
			$totalTime2PatIcu = 0;
		}
		
		$time2ReportBed = DB::table('bed_reports')->whereBetween('updated_at', array($time_from2, $time_to2))->where('hospital_id',$hospid);
		if($time2ReportBed->first()!=""){
			$totalTime2PatBed = $time2ReportBed->sum('today_bed_patient');
		}
		else{
			$totalTime2PatBed = 0;
		}
		
		////////////////// Time 3 patient reports//////////////////////////////////////////////////	
		$time3ReportIcu = DB::table('icu_reports')->whereBetween('updated_at', array($time_from3, $time_to3))->where('hospital_id',$hospid);
		if($time3ReportIcu->first()!=""){
			$totalTime3PatIcu = $time3ReportIcu->sum('today_icu_patient');
		}
		else{
			$totalTime3PatIcu = 0;
		}
		
		$time3ReportBed = DB::table('bed_reports')->whereBetween('updated_at', array($time_from3, $time_to3))->where('hospital_id',$hospid);
		if($time3ReportBed->first()!=""){
			$totalTime3PatBed = $time3ReportBed->sum('today_bed_patient');
		}
		else{
			$totalTime3PatBed = 0;
		}
		
		////////////////// Time 4 patient reports//////////////////////////////////////////////////	
		$time4ReportIcu = DB::table('icu_reports')->whereBetween('updated_at', array($time_from4, $time_to4))->where('hospital_id',$hospid);
		if($time4ReportIcu->first()!=""){
			$totalTime4PatIcu = $time4ReportIcu->sum('today_icu_patient');
		}
		else{
			$totalTime4PatIcu = 0;
		}
		
		$time4ReportBed = DB::table('bed_reports')->whereBetween('updated_at', array($time_from4, $time_to4))->where('hospital_id',$hospid);
		if($time4ReportBed->first()!=""){
			$totalTime4PatBed = $time4ReportBed->sum('today_bed_patient');
		}
		else{
			$totalTime4PatBed = 0;
		}
		
		////////////////// Time 5 patient reports//////////////////////////////////////////////////	
		$time5ReportIcu = DB::table('icu_reports')->whereBetween('updated_at', array($time_from5, $time_to5))->where('hospital_id',$hospid);
		if($time5ReportIcu->first()!=""){
			$totalTime5PatIcu = $time5ReportIcu->sum('today_icu_patient');
		}
		else{
			$totalTime5PatIcu = 0;
		}
		
		$time5ReportBed = DB::table('bed_reports')->whereBetween('updated_at', array($time_from5, $time_to5))->where('hospital_id',$hospid);
		if($time5ReportBed->first()!=""){
			$totalTime5PatBed = $time5ReportBed->sum('today_bed_patient');
		}
		else{
			$totalTime5PatBed = 0;
		}
		
		////////////////// Time 6 patient reports//////////////////////////////////////////////////	
		$time6ReportIcu = DB::table('icu_reports')->whereBetween('updated_at', array($time_from6, $time_to6))->where('hospital_id',$hospid);
		if($time6ReportIcu->first()!=""){
			$totalTime6PatIcu = $time6ReportIcu->sum('today_icu_patient');
		}
		else{
			$totalTime6PatIcu = 0;
		}
		
		$time6ReportBed = DB::table('bed_reports')->whereBetween('updated_at', array($time_from6, $time_to6))->where('hospital_id',$hospid);
		if($time6ReportBed->first()!=""){
			$totalTime6PatBed = $time6ReportBed->sum('today_bed_patient');
		}
		else{
			$totalTime6PatBed = 0;
		}
		
		
		$total1Data = $totalTime1PatIcu + $totalTime1PatBed;
		$total2Data = $totalTime2PatIcu + $totalTime2PatBed;
		$total3Data = $totalTime3PatIcu + $totalTime3PatBed;
		$total4Data = $totalTime4PatIcu + $totalTime4PatBed;
		$total5Data = $totalTime5PatIcu + $totalTime5PatBed;
		$total6Data = $totalTime6PatIcu + $totalTime6PatBed;
		
		
		$totalFinalInfor = DB::table('icu_information')->where('hospital_id',$hospid);
		if($totalFinalInfor->first()!=""){
			$hospitalTotalBed = $totalFinalInfor->sum('totaldata');
			$inpatient_data = $totalFinalInfor->sum('inpatient_data');
			$available_data = $totalFinalInfor->sum('available_data');
		}
		else{
			$hospitalTotalBed = 0;
			$inpatient_data = 0;
			$available_data = 0;
		}

		return view('frontend.hospital.daily-reports',compact('menus','hospitalTotalBed','total1Data','total2Data','total3Data','total4Data','total6Data',
		'total5Data','dailytransaction','inpatient_data','available_data','hospitalinfos'));
    }
}

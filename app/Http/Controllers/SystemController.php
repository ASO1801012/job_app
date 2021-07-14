<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Joboffer;
use App\Models\Jobtype;
use App\Models\User_data;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SystemController extends Controller
{
    public function index()
    {
        $job_all = Joboffer::all();

        return view('home')->with([
            "job_all" => $job_all
        ]);
    }

    public function jobofferform()
    {
        $jobtypes = Jobtype::all();
        return view('jobofferform')->with([
            "jobtypes" => $jobtypes
        ]);
    }

    public function jobserach()
    {
        return view('home');
    }

    public function profile()
    {
        $auth = auth::id();

        if (DB::table('user_datas')->where('id', $auth)->doesntExist()) {
            $user_data = new User_data();
            $user_data->id = $auth;
            $user_data->kananame = null;
            $user_data->address = null;
            $user_data->appealpoint = null;
            $user_data->save();
        }

        if (!empty($auth)) {
            $myid = User::find($auth);

            $mydata = User_data::find($auth);
        }

        return view('profile')->with([
            "myid" => $myid,
            "mydata" => $mydata
        ]);
    }

    public function editprofile(Request $req)
    {
        $auth = auth::id();
        $updatamydata = DB::table('user_datas')
            ->where('id', $auth)
            ->update(['kananame' => $req->kananame, 'address' => $req->address, 'appealpoint' => $req->appealpoint]);
        $updatamyid = DB::table('users')
            ->where('id', $auth)
            ->update(['name' => $req->name, 'email' => $req->email]);

        return redirect('/profile')->with('flash_message', 'プロフィール変更完了');
    }

    public function joboffersend(Request $req)
    {
        $joboffer = new Joboffer();
        $joboffer->user_id = auth::id();
        $joboffer->address = $req->address;
        $joboffer->name = $req->name;
        $joboffer->working_status = $req->working_status;
        $joboffer->salary = $req->salary;
        $joboffer->jobfeature = $req->feature;
        $joboffer->details = $req->details;
        $joboffer->save();
        return redirect('/');
    }

    public function myjoboffer()
    {
        $auth = auth::id();
        $query = Joboffer::query();
        if (!empty($auth)) {
            $query->where('user_id', '=', $auth);
        }
        $myjobdata = $query->get();
        return view('myjoboffer')->with([
            "myjobdata" => $myjobdata
        ]);
    }

    public function jobpage($id)
    {
        $jobid = $id;
        if (!empty($jobid)) {
            $job = Joboffer::find($jobid);
        }

        return view('jobpage')->with([
            "job" => $job
        ]);
    }

    public function entrypage($id)
    {
        $auth = auth::id();
        if (DB::table('user_datas')->where('id', $auth)->exists()) {
        } else {
            $user_data = new User_data();
            $user_data->id = $auth;
            $user_data->kananame = null;
            $user_data->address = null;
            $user_data->appealpoint = null;
            $user_data->save();
        }

        if (!empty($auth)) {
            $myid = User::find($auth);

            $mydata = User_data::find($auth);
        }

        $jobid = $id;
        if (!empty($jobid)) {
            $job = Joboffer::find($jobid);
        }
        return view('entrypage')->with([
            "myid" => $myid,
            "mydata" => $mydata,
            "job" => $job,
        ]);
    }

    public function jobentry($id){
        $auth = auth::id();
        $entry=new Application();
        $entry->applicant_id=$auth;
        $entry->job_id=$id;
        $entry->save();
        return redirect('/')->with('flash_message', '応募完了');
    }

    public function jobsearch(Request $req){
        $query = Joboffer::query();
        $query->where('address', 'LIKE','%{$req->address}%')
        ->orWhere('salary', '>=','$req->salary');
        
        $job_all=$query->get();
        dd($job_all);
        return view('home')->with([
            "job_all" => $job_all
        ]);
    }

    public function myjobentry(){
        $id=auth::id();
        $query=Application::query();
        $query->where('applicant_id', '=', $id);
    }
}

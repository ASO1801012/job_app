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
        $joboffer->jobfeature1 = $req->feature1;
        $joboffer->jobfeature2 = $req->feature2;
        $joboffer->jobfeature3 = $req->feature3;
        $joboffer->details = $req->details;
        $joboffer->save();
        return redirect('/');
    }

    public function myjoboffer()
    {
        $auth = auth::id();
        if (!empty($auth)) {
            $myjobdata=Joboffer::where('user_id', '=', $auth)->get();
        }
        return view('myjoboffer')->with([
            "myjobdata" => $myjobdata
        ]);
    }

    public function jobdelete($id)
    {
        $auth = auth::id();
        Joboffer::where('id', $id)
            ->where('user_id', $auth)
            ->delete();
        return redirect('/')->with('flash_message', '求人削除完了');
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

    public function jobentry($id)
    {
        $auth = auth::id();
        $entry = new Application();
        $entry->applicant_id = $auth;
        $entry->job_id = $id;
        $entry->save();
        //メール処理
        $entry_data = Application::latest()->first();
        $job_id=$entry_data->job_id;
        $job_owner_id=Joboffer::find($job_id)->user_id;
        $job_owner_name=Joboffer::find($job_id)->name;
        $job_owner_address=Joboffer::find($job_id)->address;
        $job_owner_working_status=Joboffer::find($job_id)->working_status;
        $job_owner_salary=Joboffer::find($job_id)->salary;
        $job_owner_details=Joboffer::find($job_id)->details;

        $user_name=User::find($auth)->name;
        $user_email=User::find($auth)->email;
        $user_kana=User_data::find($auth)->kananame;
        $user_address=User_data::find($auth)->address;
        $user_appealpoint=User_data::find($auth)->appealpoint;
        $entry_data = Application::latest()->first();
        /* $user_data=User_data::where('id','=',$auth)->get();
        $auth_data=User::where('id','=',$auth)->get();
        $entry_data = Application::latest()->first();
        $entry_job_adderess=Joboffer::find(Application::latest()->first()->id)->name;
        $entry_job_data=Joboffer::where('id','=',$entry_data->job_id)->get(); */
        // テキストメール送信
        $owner_mail_subject = "求人への応募がありました";
        $owner_mail_content = "求人への応募がありました。下記のメールアドレスから連絡を取りましょう!\n".
                        "-----応募があった求人-----\n".
                        "会社名:".$job_owner_name."\n".
                        "勤務地:".$job_owner_address."\n".
                        "雇用形態:".$job_owner_working_status."\n".
                        "時給:".$job_owner_salary."円\n".
                        "詳細:\n".
                        $job_owner_details."\n".
                        "\n".
                        "-----応募者情報-----\n".
                        "名前:".$user_name."\n".
                        "よみがな:".$user_kana."\n".
                        "メールアドレス:".$user_email."\n".
                        "住所:".$user_address."\n".
                        "アピールポイント:\n".
                        $user_appealpoint."\n".
                        "\n".
                        env('APP_URL');
        //企業へ
        $owner_email = User::find($job_owner_id)->email;
        $from_email=env('MAIL_FROM_ADDRESS');
        $from_name="job app";
        \Mail::send([], [], function ($message) use ($from_email, $from_name, $owner_mail_subject, $owner_mail_content, $owner_email) {
            $message->to($owner_email);
            $message->subject($owner_mail_subject);
            $message->setBody($owner_mail_content);
        });
        //ユーザーへ
        $user_mail_subject = "求人への応募が完了しました";
        $user_mail_content = "求人への応募が完了しました。企業からの連絡を待ちましょう!\n".
                        "-----応募した求人-----\n".
                        "会社名:".$job_owner_name."\n".
                        "勤務地:".$job_owner_address."\n".
                        "雇用形態:".$job_owner_working_status."\n".
                        "時給:".$job_owner_salary."円\n".
                        "詳細:\n".
                        $job_owner_details."\n".
                        "\n".
                        "-----送った情報-----\n".
                        "名前:".$user_name."\n".
                        "よみがな:".$user_kana."\n".
                        "メールアドレス:".$user_email."\n".
                        "住所:".$user_address."\n".
                        "アピールポイント:\n".
                        $user_appealpoint."\n".
                        "\n".
                        env('APP_URL');
        $user_email=$user_email;
        $from_email=env('MAIL_FROM_ADDRESS');
        $from_name="job app";
        \Mail::send([], [], function ($message) use ($from_email, $from_name, $user_mail_subject, $user_mail_content, $user_email) {
            $message->to($user_email);
            $message->subject($user_mail_subject);
            $message->setBody($user_mail_content);
        });
        return redirect('/')->with('flash_message', '応募完了');
    }

    public function jobsearch(Request $req)
    {
        $job_all=Joboffer::where('address', 'LIKE', $req->address)
            ->orWhere('salary', '>=', $req->salary);
        dd($job_all);
        return view('home')->with([
            "job_all" => $job_all
        ]);
    }

    public function myjobentry()
    {
        $id = auth::id();
        $entry_job=Application::where('applicant_id', '=', $id)->get();
    }
}

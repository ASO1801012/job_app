@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary mb-3" style="margin:10px">
                <div class="card-header">{{$job->name}}</div>
                <div class="card-body text-reset text-decoration-none">

                    <p>勤務地:{{$job->address}}</p>
                    <p>雇用形態:{{$job->working_status}}</p>
                    <p>時給:{{$job->salary}}円</p>
                    <p>詳細:{{$job->details}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            {{Form::open(['url' => route('jobentry', [$job->id])])}}
            {{Form::token()}}

            <div class="form-group row">
                <div class="col-md-2 mb-3">
                    {{Form::label('name','名前')}}
                </div>
                <div class="col-md-3">
                    {{Form::text('name', $myid->name, ['class' => 'form-control','id' => 'name','placeholder' => '名前'])}}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-2 mb-3">
                    {{Form::label('kananame','よみがな')}}
                </div>
                <div class="col-md-3">
                    {{Form::text('kananame', $mydata->kananame, ['class' => 'form-control','id' => 'kananame','placeholder' => 'よみがな'])}}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-2 mb-3">
                    {{Form::label('address','住所')}}
                </div>
                <div class="col-md-6">
                    {{Form::text('address', $mydata->address, ['class' => 'form-control','id' => 'address','placeholder' => '住所'])}}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-2 mb-3">
                    {{Form::label('email','メール')}}
                </div>
                <div class="col-md-3">
                    {{Form::text('email', $myid->email, ['class' => 'form-control','id' => 'email','placeholder' => 'メールアドレス'])}}
                </div>
            </div>

            <div class="form-group mb-3">
                {{Form::label('appeal','アピールポイント')}}
                {{Form::textarea('appeal', $mydata->application, ['class' => 'form-control', 'id' => 'appeal', 'placeholder' => '資格や経験など企業にアピールしましょう', 'rows' => '5'])}}
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                    {{Form::submit('応募する', ['class'=>'btn btn-primary btn-block'])}}
                </div>
            </div>

            {{Form::close()}}
        </div>
    </div>
</div>
@endsection
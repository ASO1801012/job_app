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
            <div class="row justify-content-center" style="margin:10px">
                <div class="col-md-8">
                    {{Form::open(['url' => route('entrypage', [$job->id])])}}
                    {{Form::token()}}

                    <div class="form-group row">
                        <div class="col-sm-12">
                            {{Form::submit('申込画面へ', ['class'=>'btn btn-primary btn-block'])}}
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
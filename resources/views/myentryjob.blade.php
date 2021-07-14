@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach($myjobdata as $job)
            <div class="card border-primary mb-3" style="margin:10px">
                <div class="card-header">{{$job->name}}</div>
                <a href="{{url('/')}}/jobpage/{{$job->id}}" class="card-body text-reset text-decoration-none">

                    <p>勤務地:{{$job->address}}</p>
                    <p>雇用形態:{{$job->working_status}}</p>
                    <p>時給:{{$job->salary}}円</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
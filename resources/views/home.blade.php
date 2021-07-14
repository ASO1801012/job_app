@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <!-- フラッシュメッセージ -->
          @if (session('flash_message'))
            <div class="flash_message bg-success text-center py-3 my-3">
                {{ session('flash_message') }}
            </div>
        @endif

        <main class="mt-4">
            @yield('content')
        </main>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('2021.7.20 サイトオープン!') }}
                </div>
            </div>

            <div class="row justify-content-center" style="margin:10px">
                <div class="col-md-8">
                    {{Form::open(['url' => '/jobserach', 'files' => false])}}
                    {{Form::token()}}

                    <div class="form-group row">
                        <div class="col-md-2 mb-3">
                            {{Form::label('address','勤務地')}}
                        </div>
                        <div class="col-md-10">
                            {{Form::text('address', null, ['class' => 'form-control','id' => 'address','placeholder' => '勤務地'])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <legend class="col-form-label mb-3">雇用形態</legend>
                        <div class="col-md-10">
                            <div class="custom-control custom-radio custom-control-inline">
                                {{Form::radio('working_status', '正社員', true, ['class'=>'custom-control-input','id'=>'working_status1'])}}
                                {{Form::label('working_status1','正社員',['class'=>'custom-control-label'])}}
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                {{Form::radio('working_status', '契約社員', false, ['class'=>'custom-control-input','id'=>'working_status2'])}}
                                {{Form::label('working_status2','契約社員',['class'=>'custom-control-label'])}}
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                {{Form::radio('working_status', 'アルバイト', false, ['class'=>'custom-control-input','id'=>'working_status3'])}}
                                {{Form::label('working_status3','アルバイト',['class'=>'custom-control-label'])}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2 mb-3">
                            {{Form::label('salary','給与')}}
                        </div>
                        <div class="col-md-8">
                            {{Form::number('salary', null, ['class' => 'form-control','id' => 'salary','placeholder' => '給与'])}}
                            <p>円以上</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2 mb-3">特徴</div>
                        <div class="col-md-10">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                {{Form::checkbox('feature', '残業なし', false, ['class'=>'custom-control-input','id'=>'feature1'])}}
                                {{Form::label('feature1','残業なし',['class'=>'custom-control-label'])}}
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                {{Form::checkbox('feature', '土日休み', false, ['class'=>'custom-control-input','id'=>'feature2'])}}
                                {{Form::label('feature2','土日休み',['class'=>'custom-control-label'])}}
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                {{Form::checkbox('feature', '年齢不問', false, ['class'=>'custom-control-input','id'=>'feature3'])}}
                                {{Form::label('feature3','年齢不問',['class'=>'custom-control-label'])}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            {{Form::submit('検索', ['class'=>'btn btn-primary btn-block'])}}
                        </div>
                    </div>

                    {{Form::close()}}
                </div>
            </div>
            @foreach($job_all as $job)
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
@extends('layouts.app')

@section('content')
<div class="container">
    <!-- フラッシュメッセージ -->
        @if (session('flash_message'))
            <div class="flash_message bg-success text-center py-3 my-3">
                {{ session('flash_message') }}
            </div>
        @endif
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            {{Form::open(['url' => '/editprofile', 'files' => false])}}
            {{Form::token()}}

            <div class="form-group row">
                <div class="col-md-2 mb-3">
                    {{Form::label('name','名前')}}
                </div>
                <div class="col-md-10">
                    {{Form::text('name', $myid->name, ['class' => 'form-control','id' => 'name','placeholder' => '名前'])}}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-2 mb-3">
                    {{Form::label('kananame','よみがな')}}
                </div>
                <div class="col-md-10">
                    {{Form::text('kananame', $mydata->kananame, ['class' => 'form-control','id' => 'kananame','placeholder' => 'よみがな'])}}
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-md-2 mb-3">
                    {{Form::label('address','住所')}}
                </div>
                <div class="col-md-10">
                    {{Form::text('address', $mydata->address, ['class' => 'form-control','id' => 'address','placeholder' => '住所'])}}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-2 mb-3">
                    {{Form::label('email','メール')}}
                </div>
                <div class="col-md-10">
                    {{Form::text('email', $myid->email, ['class' => 'form-control','id' => 'email','placeholder' => 'メールアドレス'])}}
                </div>
            </div>

            <div class="form-group mb-3">
                {{Form::label('appealpoint','アピールポイント')}}
                {{Form::textarea('appealpoint', $mydata->appealpoint, ['class' => 'form-control', 'id' => 'appealpoint', 'placeholder' => '資格や経験など企業にアピールしましょう', 'rows' => '5'])}}
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                    {{Form::submit('プロフィールを更新する', ['class'=>'btn btn-primary btn-block'])}}
                </div>
            </div>

            {{Form::close()}}
        </div>
    </div>
</div>
@endsection
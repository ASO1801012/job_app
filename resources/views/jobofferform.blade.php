@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{Form::open(['url' => '/joboffersend', 'files' => false])}}
            {{Form::token()}}

            <div class="form-group row">
                <div class="col-md-2 mb-3">
                    {{Form::label('name','会社名')}}
                </div>
                <div class="col-md-10">
                    {{Form::text('name', null, ['class' => 'form-control','id' => 'name','placeholder' => '〇〇株式会社など'])}}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-2 mb-3">
                    {{Form::label('address','勤務地')}}
                </div>
                <div class="col-md-10">
                    {{Form::text('address', null, ['class' => 'form-control','id' => 'address','placeholder' => '博多駅、福岡市近郊など'])}}
                </div>
            </div>

            <div class="form-group row">
                <legend class="col-form-label col-md-2 mb-3">雇用形態</legend>
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
                <div class="col-md-10">
                    {{Form::number('salary', null, ['class' => 'form-control','id' => 'salary','placeholder' => '数字のみ'])}}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-2 mb-3">特徴</div>
                <div class="col-md-10">
                    <div class="custom-control custom-checkbox custom-control-inline">
                        {{Form::checkbox('feature1', '残業なし', false, ['class'=>'custom-control-input','id'=>'feature1'])}}
                        {{Form::label('feature1','残業なし',['class'=>'custom-control-label'])}}
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        {{Form::checkbox('feature2', '土日休み', false, ['class'=>'custom-control-input','id'=>'feature2'])}}
                        {{Form::label('feature2','土日休み',['class'=>'custom-control-label'])}}
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        {{Form::checkbox('feature3', '年齢不問', false, ['class'=>'custom-control-input','id'=>'feature3'])}}
                        {{Form::label('feature3','年齢不問',['class'=>'custom-control-label'])}}
                    </div>
                </div>
            </div>

            <!--
            <div class="custom-file mb-5">
                {{Form::file('image', ['class'=>'custom-file-input','id'=>'fileImage'])}}
                {{Form::label('fileImage','ファイル選択...',['class'=>'custom-file-label'])}}
            </div>
            -->

            <div class="form-group mb-3">
                {{Form::label('details','詳細')}}
                {{Form::textarea('details', null, ['class' => 'form-control', 'id' => 'details', 'placeholder' => '', 'rows' => '5'])}}
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                    {{Form::submit('この求人を掲載する', ['class'=>'btn btn-primary btn-block'])}}
                </div>
            </div>

            {{Form::close()}}
        </div>
    </div>
</div>
@endsection
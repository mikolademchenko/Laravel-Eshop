@extends('admin::layouts.master')

@section('title','E-SHOP || Tenant Create')

@section('content')

    <div class="card">
        <h5 class="card-header">@lang('partials.edit')</h5>
        <div class="card-body">
            @include('tenant::partials.form')
        </div>
    </div>

@endsection


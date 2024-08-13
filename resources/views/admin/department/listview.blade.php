@extends('admin.layouts.admin')

@section('title')
    {{__('Manage Department')}}
@endsection

@push('head')
    <link rel="stylesheet" href="{{asset('assets/libs/summernote/summernote-bs4.css')}}">
@endpush

@push('script')
    <script src="{{asset('assets/libs/summernote/summernote-bs4.js')}}"></script>
@endpush

@section('action-button')
    <div class="row d-flex justify-content-end">
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 col-12">
            <div class="all-button-box">
                <a href="{{ route('admin.departments.create') }}" data-title="{{__('Create Department')}}" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-plus"></i> {{__('Create')}} </a>
            </div>
        </div>
    </div>
@endsection



@extends('admin.layouts.admin')

@section('title')
    {{ __('Dashboard') }}
@endsection

@push('head')
   {{--  @if($calenderTasks)
        <link rel="stylesheet" href="{{asset('public/assets/libs/fullcalendar/dist/fullcalendar.min.css')}}">
    @endif --}}
@endpush

@push('script')
    <script src="{{asset('/assets/js/chart.min.js') }}"></script>
    {{-- @if($calenderTasks)
        <script src="{{asset('public/assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    @endif --}}
@endpush

@section('content')
    <div class="row">
        
        
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
     $(document).ready(function(){

$(".year_filter").change(function () {
    var selected_year = $('.year_filter option:selected').val();
    var year = '';
    // var staff_id = $(this).attr('data-staff-id');
    // var dept_id = $(this).attr('data-dept-id');
    // console.log(staff_id);
    // console.log(selected_year); return false;
    if(selected_year == ''){

        year = (new Date).getFullYear();


    }else{

        year = selected_year;

    }
    $.ajax({
                    url: '/set/'+year,
                    type: "post",
                    data : {"_token":"{{ csrf_token() }}"},
        //headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

});
});
</script>

@endsection

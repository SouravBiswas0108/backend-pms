@extends('admin.layouts.admin')


@section('title')
{{__('MPMS')}}
@endsection

@push('head')
    <link rel="stylesheet" href="{{asset('public/assets/libs/summernote/summernote-bs4.css')}}">
    <style type="text/css">
        .presidential-btn,
        .operational-btn,
        .service-wide-btn {
            width: 120px;
            padding: 5px;
            border-radius: 10px;
            color: #0f5ef7;
            background-color: #fff;
            border: 1px solid #0f5ef7;
        }

        .presidential-btn.active,
        .operational-btn.active,
        .service-wide-btn.active {
            width: 120px;
            padding: 5px;
            border-radius: 10px;
            background-color: #0f5ef7;
            border: none;
            color: white;
            font-weight: 500;
        }
    </style>
@endpush

@push('script')
    <script src="{{asset('/assets/libs/summernote/summernote-bs4.js')}}"></script>
    <script type="text/javascript">
        function active(argument) {
            if (argument == 1) {
                $(".presidential-btn").addClass("active");
                $(".operational-btn, .service-wide-btn").removeClass("active");
                $(".divForTable2, .divForTable3").hide();
                $(".divForTable1").show();
            }
            if (argument == 2) {
                $(".operational-btn").addClass("active");
                $(".presidential-btn, .service-wide-btn").removeClass("active");
                $(".divForTable3, .divForTable1").hide();
                $(".divForTable2").show();
            }
            if (argument == 3) {
                $(".service-wide-btn").addClass("active");
                $(".operational-btn, .presidential-btn").removeClass("active");
                $(".divForTable1, .divForTable2").hide();
                $(".divForTable3").show();
            }
        }
    </script>
@endpush

@section('action-button')
<div class="row d-flex justify-content-end">
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 col-12">
        <div class="all-button-box">
            <a href="{{ route('admin.mpms.create') }}" data-url="" data-ajax-popup="true" data-size="lg"
                data-title="{{__('Create Department')}}" class="btn btn-xs btn-white btn-icon-only width-auto"><i
                    class="fas fa-plus"></i> {{__('ADD')}} </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div style="margin-left: 30px;">
                        <button class="presidential-btn active" onclick="active(1)">Presidential</button>
                        <button class="operational-btn" onclick="active(2)">Operational</button>
                        <button class="service-wide-btn" onclick="active(3)">Service-Wide</button>
                    </div>
                    <div class="divForTable1">
                        <table class="table table-striped dataTable table1">
                            <thead>
                                <tr>
                                    <th style="text-align: center">{{__('KEY RESULT AREA')}}</th>
                                    <th style="text-align: center">{{__('WEIGHT')}}</th>
                                    <th style="text-align: center">{{__('OBJECTIVES')}}</th>
                                    <th style="text-align: center">{{__('WEIGHTS')}}</th>
                                    <th style="text-align: center">{{__('INITIATIVES')}}</th>
                                    <th style="text-align: center">{{__('KPI')}}</th>
                                    <th style="text-align: center">{{__('TARGET')}}</th>
                                    <th style="text-align: center">{{__('RESPONSIBLE')}}</th>
                                    <th width="300px" style="text-align: center">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(count($data1) > 0)
                                    @foreach ($data1 as $dept)
                                        <tr>
                                            <td style="color:black;">{{ $dept['kra_title'] }}</td>
                                            <td style="color:black;">{{ $dept['kra_weight'] }}</td>
                                            <td style="color:black;">{{ $dept['obj_title'] }}</td>
                                            <td style="color:black;">{{ $dept['obj_weight'] }}</td>
                                            <td style="color:black;">{{ $dept['Initiative'] }}</td>
                                            <td style="color:black;">{{ $dept['kpi'] }}</td>
                                            <td style="color:black;">{{ $dept['target'] }}</td>
                                            <td style="color:black;">{{ $dept['Responsible'] }}</td>
                                            @if(Auth::user()->type != 'Client')
                                                <td class="Action">
                                                    <span style="display: inline-block">
                                                        <a href="{{ route('admin.mpms.edit', $dept['kra_id']) }}" class="edit-icon "
                                                            data-url="" data-ajax-popup="" data-title="{{__('Edit Department')}}"><i
                                                                class="fas fa-pencil-alt"></i></a>
                                                    </span>
                                                    <span style="display: inline-block">
                                                        <form id="delete-form-{{ $dept['id'] }}"
                                                            action="{{ route('admin.mpms.destroy', $dept['id']) }}" method="POST"
                                                            style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                        <a href="#" class="delete-icon"
                                                            onclick="event.preventDefault();document.getElementById('delete-form-{{ $dept['id'] }}').submit();"
                                                            title="{{ __('Delete Department') }}">
                                                            <i class="fas fa-trash" style="color: #fdfdfd;"></i>
                                                        </a>



                                                    </span>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="font-style">
                                        <td colspan="6" class="text-center">{{ __('No data available in table') }}</td>
                                    </tr>
                                    @if($year == date('Y'))
                                        <input type="hidden" id="no_dept" name="no_dept" value="1">
                                    @endif
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div style="display: none;" class="divForTable2">
                        <table class="table table-striped dataTable table2">
                            <thead>
                                <tr>
                                    <th style="text-align: center">{{__('KEY RESULT AREA')}}</th>
                                    <th style="text-align: center">{{__('WEIGHT')}}</th>
                                    <th style="text-align: center">{{__('OBJECTIVES')}}</th>
                                    <th style="text-align: center">{{__('WEIGHTS')}}</th>
                                    <th style="text-align: center">{{__('INITIATIVES')}}</th>
                                    <th style="text-align: center">{{__('KPI')}}</th>
                                    <th style="text-align: center">{{__('TARGET')}}</th>
                                    <th style="text-align: center">{{__('RESPONSIBLE')}}</th>
                                    <th width="300px" style="text-align: center">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(count($data2) > 0)
                                    @foreach ($data2 as $dept)
                                        <tr>
                                            <td style="color:black;">{{ $dept['kra_title'] }}</td>
                                            <td style="color:black;">{{ $dept['kra_weight'] }}</td>
                                            <td style="color:black;">{{ $dept['obj_title'] }}</td>
                                            <td style="color:black;">{{ $dept['obj_weight'] }}</td>
                                            <td style="color:black;">{{ $dept['Initiative'] }}</td>
                                            <td style="color:black;">{{ $dept['kpi'] }}</td>
                                            <td style="color:black;">{{ $dept['target'] }}</td>
                                            <td style="color:black;">{{ $dept['Responsible'] }}</td>

                                            <td class="Action">
                                                <span style="display: inline-block">
                                                    <a href="{{ route('admin.mpms.edit', $dept['kra_id']) }}" class="edit-icon "
                                                        data-url="" data-ajax-popup="" data-title="{{__('Edit Department')}}"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                </span>
                                                <span style="display: inline-block">
                                                    <a href="#" class="delete-icon " data-url="" data-ajax-popup=""
                                                        data-title="{{__('Edit Department')}}"><i class="fas fa-trash"
                                                            style="color: #fdfdfd;"></i></a>
                                                </span>
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="font-style">
                                        <td colspan="6" class="text-center">{{ __('No data available in table') }}</td>
                                    </tr>
                                    @if($year == date('Y'))
                                        <input type="hidden" id="no_dept" name="no_dept" value="1">
                                    @endif
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div style="display: none;" class="divForTable3">
                        <table class="table table-striped dataTable table3">
                            <thead>
                                <tr>
                                    <th style="text-align: center">{{__('KEY RESULT AREA')}}</th>
                                    <th style="text-align: center">{{__('WEIGHT')}}</th>
                                    <th style="text-align: center">{{__('OBJECTIVES')}}</th>
                                    <th style="text-align: center">{{__('WEIGHTS')}}</th>
                                    <th style="text-align: center">{{__('INITIATIVES')}}</th>
                                    <th style="text-align: center">{{__('KPI')}}</th>
                                    <th style="text-align: center">{{__('TARGET')}}</th>
                                    <th style="text-align: center">{{__('RESPONSIBLE')}}</th>
                                    <th width="300px" style="text-align: center">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(count($data3) > 0)
                                    @foreach ($data3 as $dept)

                                        <tr>
                                            <td style="color:black;">{{ $dept['kra_title'] }}</td>
                                            <td style="color:black;">{{ $dept['kra_weight'] }}</td>
                                            <td style="color:black;">{{ $dept['obj_title'] }}</td>
                                            <td style="color:black;">{{ $dept['obj_weight'] }}</td>
                                            <td style="color:black;">{{ $dept['Initiative'] }}</td>
                                            <td style="color:black;">{{ $dept['kpi'] }}</td>
                                            <td style="color:black;">{{ $dept['target'] }}</td>
                                            <td style="color:black;">{{ $dept['Responsible'] }}</td>

                                            <td class="Action">
                                                <span style="display: inline-block">
                                                    <a href="{{ route('admin.mpms.edit', $dept['kra_id']) }}" class="edit-icon "
                                                        data-url="" data-ajax-popup="" data-title="{{__('Edit Department')}}"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                </span>
                                                <span style="display: inline-block">
                                                    <a href="{{route('admin.mpms.destroy', $dept['kra_id'])}}"
                                                        class="delete-icon " data-url="" data-ajax-popup=""
                                                        data-title="{{__('Edit Department')}}"><i class="fas fa-trash"
                                                            style="color: #fdfdfd;"></i></a>
                                                </span>
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="font-style">
                                        <td colspan="6" class="text-center">{{ __('No data available in table') }}</td>
                                    </tr>
                                    @if($year == date('Y'))
                                        <input type="hidden" id="no_dept" name="no_dept" value="1">
                                    @endif
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
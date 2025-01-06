@extends('layouts.admin')

@section('title')
{{ __('Manage Users') }}
@endsection

@section('action-button')
<div class="all-button-box row d-flex justify-content-end">
    
    {{-- @can('Create User') --}}
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
        <a href="{{ route('students.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
            <i class="fas fa-plus"></i> {{__('Add')}}
        </a>
    </div>
    {{-- @endcan --}}

   


</div>
@endsection

@section('content')
<div class="row">

    <div class="col-md-12">

        <div class="card">

            <div class="card-body ">

                <div class="UserTable">


                    <div class="table-responsive">
                      
                        <table class="table table-striped dataTable">
                            <thead>
                                <tr>
                                    <th style="display: none;"></th>
                                    <th style="display: none;"></th>

                                    <th>{{__('No')}}</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Slug')}}</th>
                                    <th>{{__('status')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp

                                @foreach($students as $student)
                              
                                <tr>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $student->title }}</td>
                                    <td>{{ $student->slug }}</td>
                                   
                                    
                                    <td class="d-flex user-icon">
                                        {{-- @if(\Auth::user()->type != 'Super Admin') --}}
                                        <a href="{{route('students.show',$student->id)}}" class="view-icon" title="View"><i class="fas fa-eye"></i></a>
                                        {{-- @endif --}}
                                        {{-- @can('Edit User') --}}
                                        <a href="{{ route('students.edit',$student->id) }}" class="edit-icon"  data-title="{{__('Edit User')}}"><i class="fas fa-pencil-alt"></i></a>
                                        {{-- @endcan --}}
                                        {{-- <a href="{{route('user.isactive',$student->id)}}" class="btn btn-xs btn-danger  width-auto" role="button">Non Active</a> --}}
                                        {{-- @can('Delete User') --}}
                                        <a class="delete-icon" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$student['id']}}').submit();">
                                            @if($student->delete_status == 0)<i class="fas fa-trash"></i> @else {{__('Restore')}}@endif
                                        </a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['students.destroy', $student['id']],'id'=>'delete-form-'.$student['id']]) !!}
                                        {!! Form::close() !!}
                                        {{-- @endcan --}}
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
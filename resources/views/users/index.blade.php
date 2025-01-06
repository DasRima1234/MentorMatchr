@extends('layouts.admin')

@section('title')
{{ __('Manage Users') }}
@endsection

@section('action-button')
<div class="all-button-box row d-flex justify-content-end">
    @can('Create User')
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
        <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create User')}}" data-url="{{route('users.create')}}">
            <i class="fas fa-plus"></i> {{__('Add')}}
        </a>
    </div>
    @endcan

   


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

                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Username')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Role')}}</th>
                                    <th>{{__('status')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                              
                                <tr>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->user_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->type}}</td>
                                   
                                    <td>
                                        @if ($user->is_active == 1)
                                        <a href="#" class="verification-btn width-auto" role="button" style="color: green;">Active</a>
                                        @else
                                        <a href="#" class="verification-btn  width-auto" role="button" style="color: red;">Inactive</a>
                                        @endif
                                    </td>
                                    @if(Gate::check('Edit User') || Gate::check('Delete User'))
                                    @if($user->is_active == 1)
                                    <td class="d-flex user-icon">
                                        @if(\Auth::user()->type != 'Super Admin')
                                        <a href="{{route('users.show',$user->id)}}" class="btn btn-xs btn-info  width-auto" title="View">View</a>
                                        @endif
                                        @can('Edit User')
                                        <a href="#" class="btn btn-warning btn-xs width-auto" data-url="{{ route('users.edit',$user->id) }}" data-ajax-popup="true" data-title="{{__('Edit User')}}">Edit</a>
                                        @endcan
                                        <a href="{{route('user.isactive',$user->id)}}" class="btn btn-xs btn-danger  width-auto" role="button">Non Active</a>
                                        @can('Delete User')
                                        <a class="btn btn-secondary btn-xs width-auto " data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$user['id']}}').submit();">
                                            @if($user->delete_status == 0)Delete @else {{__('Restore')}}@endif
                                        </a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user['id']],'id'=>'delete-form-'.$user['id']]) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @else
                                    <td><i class="fas fa-lock action-item"></i>
                                        <a href="{{route('user.isactive',$user->id)}}" class="btn btn-xs btn-success  width-auto" role="button">Active</a>
                                    </td>
                                    @endif
                                    @endif

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
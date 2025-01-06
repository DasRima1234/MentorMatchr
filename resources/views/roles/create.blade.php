<div class="card bg-none card-box">
    {{ Form::open(array('url' => 'roles')) }}
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('name', __('Role Name'),['class'=>'form-control-label']) }}
                {{ Form::text('name', null, array('class' => 'form-control')) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('permissions', __('Assign Permissions'),['class'=>'form-control-label']) }}
                <table class="table table-striped">
                    <tr>
                        <th class="text-dark">{{__('Module')}}</th>
                        <th class="text-dark">{{__('Permissions')}}</th>
                    </tr>
                    <tr>
                       {{-- <td>{{__('Account')}}</td>
                        <td>
                            <div class="row">
                                @if(in_array('System Settings',$permissions))
                                    @php($key = array_search('System Settings', $permissions))
                                    <div class="col-4 custom-control custom-checkbox">
                                        {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                        {{ Form::label('permission_'.$key, __('System Settings'),['class'=>'custom-control-label font-weight-500']) }}
                                    </div>
                                @endif
                            </div>
                        </td> --}}
                    </tr>
                    <?php
                    $modules = [
                        'User',
                        'Role',

                    ];


                    if(\Auth::user()->type == 'Super Admin')
                    {
                        $modules[] = 'Language';
                    }

                    ?>

                    @foreach($modules as $module)
                        <?php

                            $s_name = $module . "s";


                        ?>
                        <tr>
                            <td>{{__($module)}}</td>
                            <td>
                                <div class="row">
                                    @if(in_array('Manage '.$s_name,$permissions))
                                        @php($key = array_search('Manage '.$s_name, $permissions))
                                        <div class="col-3 custom-control custom-checkbox">
                                            {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                            {{ Form::label('permission_'.$key, 'Manage',['class'=>'custom-control-label font-weight-500']) }}
                                        </div>
                                    @endif
                                    @if(in_array('Create '.$module,$permissions))
                                        @php($key = array_search('Create '.$module, $permissions))
                                        <div class="col-3 custom-control custom-checkbox">
                                            {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                            {{ Form::label('permission_'.$key, __('Create'),['class'=>'custom-control-label font-weight-500']) }}
                                        </div>
                                    @endif
                                    @if(in_array('Request '.$module,$permissions))
                                        @php($key = array_search('Request '.$module, $permissions))
                                        <div class="col-3 custom-control custom-checkbox">
                                            {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                            {{ Form::label('permission_'.$key, __('Request'),['class'=>'custom-control-label font-weight-500']) }}
                                        </div>
                                    @endif
                                    @if(in_array('Edit '.$module,$permissions))
                                        @php($key = array_search('Edit '.$module, $permissions))
                                        <div class="col-3 custom-control custom-checkbox">
                                            {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                            {{ Form::label('permission_'.$key, __('Edit'),['class'=>'custom-control-label font-weight-500']) }}
                                        </div>
                                    @endif
                                    @if(in_array('Delete '.$module,$permissions))
                                        @php($key = array_search('Delete '.$module, $permissions))
                                        <div class="col-3 custom-control custom-checkbox">
                                            {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                            {{ Form::label('permission_'.$key, __('Delete'),['class'=>'custom-control-label font-weight-500']) }}
                                        </div>
                                    @endif
                                    @if(in_array('View '.$module,$permissions))
                                        @php($key = array_search('View '.$module, $permissions))
                                        <div class="col-3 custom-control custom-checkbox">
                                            {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                            {{ Form::label('permission_'.$key, __('View'),['class'=>'custom-control-label font-weight-500']) }}
                                        </div>
                                    @endif
                                    @if(in_array('Move '.$module,$permissions))
                                        @php($key = array_search('Move '.$module, $permissions))
                                        <div class="col-3 custom-control custom-checkbox">
                                            {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                            {{ Form::label('permission_'.$key, __('Move'),['class'=>'custom-control-label font-weight-500']) }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>{{__('Other')}}</td>
                        <td>
                            <div class="row">
                                @if(in_array('Dashboard',$permissions))
                                    @php($key = array_search('Dashboard', $permissions))
                                    <div class="col-6 custom-control custom-checkbox">
                                        {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                        {{ Form::label('permission_'.$key, __('Dashboard'),['class'=>'custom-control-label font-weight-500']) }}
                                    </div>
                                @endif
                                <!-- @if(in_array('Reports Management',$permissions))
                                    @php($key = array_search('Reports Management', $permissions))
                                    <div class="col-6 custom-control custom-checkbox">
                                        {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                        {{ Form::label('permission_'.$key, __('Reports Management'),['class'=>'custom-control-label font-weight-500']) }}
                                    </div>
                                @endif -->
                              
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-12 text-right">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

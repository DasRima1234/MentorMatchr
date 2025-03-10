<div class="card bg-none card-box">
    <form class="pl-3 pr-3" method="post"  action="{{ route('store.ip.client') }}">
        @csrf
        <div class="row">
            <div class="col-12 form-group"  id="form-test-ip">
                <label for="ip" class="form-control-label"  >{{ __('IP Address') }}</label>
                <input type="text" class="form-control" id="ip" name="ip" required/>
            </div>
            <div class="col-12 form-group"  id="form-test-name-ip">
                <label for="name-ip" class="form-control-label"  >{{ __('Name Client') }}</label>
                <input type="text" class="form-control" id="name-ip" name="name" required/>
            </div>
            {{-- <div class="col-12 form-group"  id="form-test-email">
                <label for="status" class="form-control-label"  >{{ __('Status') }}</label>
                <select name="status" class="form-control" id="status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>

            </div> --}}
            <div class="col-12 form-group text-right">
                <input type="submit" value="{{__('Save')}} " class="btn-create badge-red">
                <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
            </div>
        </div>
    </form>
</div>
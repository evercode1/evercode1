<form class="form"
      role="form"
      method="POST"
      action="{{ url('/user/'. $user->id) }}">

    <input type="hidden"
           name="_method"
           value="PATCH">

    {{ csrf_field() }}

    <!-- name form input -->

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

        <label class="control-label">

            User Name

        </label>

        <input type="text"
               class="form-control"
               name="name"
               value="{{ $user->name }}">

        @if ($errors->has('name'))

            <span class="help-block">

                <strong>{{ $errors->first('name') }}</strong>

            </span>

        @endif

    </div>  <!-- end name form group -->

    <!-- status_id form input -->

    <div class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }}">

        <label class="control-label">Is Active Status?</label>


        <select class="form-control" id="status_id" name="status_id">
            <option value="{{ $user->status_id }}">{{ $user->status_id == 10 ? 'Yes' : 'No' }}</option>
            <option value="10">Yes</option>
            <option value="7">No</option>
        </select>


        @if ($errors->has('status_id'))

            <span class="help-block">

                <strong>{{ $errors->first('status_id') }}</strong>

            </span>

        @endif

    </div>  <!-- end status_id form group -->

    <!-- is_subscribed form input -->

    <div class="form-group{{ $errors->has('is_subscribed') ? ' has-error' : '' }}">

        <label class="control-label">Is Subscribed?</label>

        <select class="form-control" id="is_subscribed" name="is_subscribed">
            <option value="{{ $user->is_subscribed }}">{{ $user->is_subscribed == 1 ? 'Yes' : 'No' }}</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        @if ($errors->has('is_subscribed'))

            <span class="help-block">

                <strong>{{ $errors->first('is_subscribed') }}</strong>

            </span>

        @endif

    </div> <!-- end is_subscribed form group -->

    <!-- is_admin form input -->

    <div class="form-group{{ $errors->has('is_admin') ? ' has-error' : '' }}">

        <label class="control-label">Is Admin?</label>

        <select class="form-control" id="is_admin" name="is_admin">
            <option value="{{ $user->is_admin }}">{{ $user->showAdminStatusOf($user) }}</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        @if ($errors->has('is_admin'))

            <span class="help-block">

                <strong>{{ $errors->first('is_admin') }}</strong>

            </span>

        @endif

    </div> <!-- end is_admin form group -->

    <!-- submit form group -->

    <div class="form-group">

        <button type="submit" class="btn btn-primary btn-lg">

            Update

        </button>

    </div>  <!-- end submit form group -->

</form>

<form class="form"
      role="form"
      method="POST"
      action="{{ url('/settings') }}">

    <input type="hidden" name="_method" value="patch">

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

    </div> <!-- end name form group -->

    <!-- email form input -->

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

        <label for="email"
               class="control-label">

               E-Mail Address

        </label>

        <div>

            <input id="email"
                   type="email"
                   class="form-control"
                   name="email"
                   value="{{ $user->email }}">

            @if ($errors->has('email'))

            <span class="help-block">

                <strong>{{ $errors->first('email') }}</strong>

            </span>

            @endif

        </div>

    </div>  <!-- end email form group -->

    <!-- is_subscribed form input -->

    <div class="form-group{{ $errors->has('is_subscribed') ? ' has-error' : '' }}">

        <label class="control-label">

            Is Subscribed?

        </label>


        <select class="form-control"
                id="is_subscribed"
                name="is_subscribed">

            <option value="{{ $user->is_subscribed }}">{{ $user->is_subscribed == 1 ? 'Yes' : 'No' }}</option>
            <option value="1">Yes</option>
            <option value="0">No</option>

        </select>


        @if ($errors->has('is_subscribed'))

        <span class="help-block">

            <strong>{{ $errors->first('is_subscribed') }}</strong>

        </span>

        @endif

    </div>  <!-- end is_subscribed form group -->

    <!-- submit button -->

    <div class="form-group">

        <button type="submit" class="btn btn-primary btn-lg">

            Update

        </button>

    </div>  <!-- end submit button -->

</form>
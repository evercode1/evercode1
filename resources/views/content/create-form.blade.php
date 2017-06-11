<form class="form form-border mt-25"
      role="form"
      method="POST"
      action="{{ url('/content') }}">

{{ csrf_field() }}

<!-- name input -->

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

        <label class="control-label">Name</label>

        <input type="text"
               class="form-control"
               name="name"
               value="{{ old('name') }}" />

        @if ($errors->has('name'))

            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>

        @endif

    </div>  <!-- end name input -->


    <!-- body input -->

    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">

        <label class="control-label">Body</label>

        <textarea name="body"
                  class="form-control"
                  rows="20"
                  value="{{ old('body') }}"></textarea>


        @if ($errors->has('body'))

            <span class="help-block">
                <strong>{{ $errors->first('body') }}</strong>
            </span>

        @endif

    </div>  <!-- end body input -->



    <!-- is_active select -->

    <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">

        <label class="control-label">Is Active?</label>

        <select class="form-control" id="is_active" name="is_active">

            <option value="1">Yes</option>
            <option value="0">No</option>


        </select>

        @if ($errors->has('is_active'))

            <span class="help-block">

                <strong>{{ $errors->first('is_active') }}</strong>

            </span>

        @endif

    </div>  <!-- end is_active select -->


    <!-- submit button -->

    <div class="form-group">

        <button type="submit"
                class="btn btn-primary btn-lg">

            Create

        </button>

    </div>  <!-- end submit button -->


</form>


<form class="form form-border mt-25"
      role="form"
      method="POST"
      action="{{ url('/contact-topic') }}">

{{ csrf_field() }}

<!--  name input -->

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

        <label class="control-label">Topic Name</label>

        <input type="text"
               class="form-control"
               name="name"
               value="{{ old('name') }}" />

        @if ($errors->has('name'))

            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>

        @endif

    </div>

    <!-- end name input -->


    <!-- submit button -->

    <div class="form-group">

        <button type="submit"
                class="btn btn-primary btn-lg">

            Create

        </button>

    </div>

    <!-- end submit button -->

</form>


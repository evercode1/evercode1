<form class="form form-border mt-25"
      role="form"
      method="POST"
      action="{{ url('/content/'. $content->id) }}">

{{ method_field('PATCH') }}
{{ csrf_field() }}

<!-- name input -->

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

        <label class="control-label">Title</label>

        <input type="text"
               class="form-control"
               name="name"
               value="{{ $content->name }}" />

        @if ($errors->has('name'))

            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>

        @endif

    </div>  <!-- end name input -->


    <!-- body input -->

    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">

        <label class="control-label">Author</label>

        <textarea name="body"
                  class="form-control"
                  name="body"
                  rows="20">{!! $content->body !!}</textarea>

        @if ($errors->has('body'))

            <span class="help-block">
                <strong>{{ $errors->first('body') }}</strong>
            </span>

        @endif

    </div>  <!-- end author input -->


    <!-- is_active select -->

    <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">

        <label class="control-label">Is Active?</label>

        <select class="form-control" id="is_active" name="is_active">

            <option value="{{ $content->is_active }}">{{ $content->is_active == 1 ? 'Yes' : 'No' }}</option>
            <option value="0">No</option>
            <option value="1">Yes</option>

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

            Update

        </button>

    </div>

    <!-- end submit button -->

</form>


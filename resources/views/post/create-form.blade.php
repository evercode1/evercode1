<form class="form form-border mt-25"
      role="form"
      method="POST"
      action="{{ url('/post') }}">

{{ csrf_field() }}

<!-- post title input -->

    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">

        <label class="control-label">Post Title</label>

        <input type="text"
               class="form-control"
               name="title"
               value="{{ old('title') }}" />

        @if ($errors->has('title'))

            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>

        @endif

    </div>

    <!-- end post title input -->

    <!-- category select -->

    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">

        <label class="control-label">Category</label>

        <select class="form-control" id="category_id" name="category_id">

            <option value="">Please Choose One</option>

            @foreach($categories as $category)

            <option value={{ $category->id }}>{{ $category->name }}</option>

            @endforeach

        </select>

        @if ($errors->has('category_id'))

            <span class="help-block">

                <strong>{{ $errors->first('category_id') }}</strong>

            </span>

        @endif

    </div> <!-- end category select -->


    <!-- is_published select -->

    <div class="form-group{{ $errors->has('is_published') ? ' has-error' : '' }}">

        <label class="control-label">Status</label>

        <select class="form-control" id="is_published" name="is_published">

            <option value="1">Publish</option>
            <option value="0">Save As Draft</option>

        </select>

        @if ($errors->has('is_published'))

            <span class="help-block">

                <strong>{{ $errors->first('is_published') }}</strong>

            </span>

        @endif

    </div> <!-- end is_published select -->


    <!-- post body input -->

    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">

        <label class="control-label">Post Body</label>

        <textarea name="body"></textarea>


        @if ($errors->has('body'))

            <span class="help-block">
                <strong>{{ $errors->first('body') }}</strong>
            </span>

        @endif

    </div>

    <!-- end post body input -->

    <!-- submit button -->

    <div class="form-group">

        <button type="submit"
                class="btn btn-primary btn-lg">

            Create

        </button>

    </div>

    <!-- end submit button -->

</form>

@section('scripts')

    <script>
        CKEDITOR.replace( 'body' );
    </script>

@endsection
<form class="form form-border mt-25"
      role="form"
      method="POST"
      action="{{ url('/book/'. $book->id) }}">

{{ method_field('PATCH') }}
{{ csrf_field() }}

<!-- book title input -->

    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">

        <label class="control-label">Book Title</label>

        <input type="text"
               class="form-control"
               name="title"
               value="{{ $book->title }}" />

        @if ($errors->has('title'))

            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>

        @endif

    </div>  <!-- end book title input -->


    <!-- author input -->

    <div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">

        <label class="control-label">Author</label>

        <input type="text"
               class="form-control"
               name="author"
               value="{{ $book->author }}" />

        @if ($errors->has('author'))

            <span class="help-block">
                <strong>{{ $errors->first('author') }}</strong>
            </span>

        @endif

    </div>  <!-- end author input -->


    <!-- url input -->

    <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">

        <label class="control-label">Url</label>

        <input type="text"
               class="form-control"
               name="url"
               value="{{ $book->url }}" />

        @if ($errors->has('url'))

            <span class="help-block">
                <strong>{{ $errors->first('url') }}</strong>
            </span>

        @endif

    </div>  <!-- url author input -->


    <!-- is_featured select -->

    <div class="form-group{{ $errors->has('is_featured') ? ' has-error' : '' }}">

        <label class="control-label">Is Featured?</label>

        <select class="form-control" id="is_featured" name="is_featured">

            <option value="{{ $book->is_featured }}">{{ $book->is_featured == 1 ? 'Yes' : 'No' }}</option>
            <option value="0">No</option>
            <option value="1">Yes</option>

        </select>

        @if ($errors->has('is_featured'))

            <span class="help-block">

                <strong>{{ $errors->first('is_featured') }}</strong>

            </span>

        @endif

    </div>  <!-- end is featured select -->


    <!-- submit button -->

    <div class="form-group">

        <button type="submit"
                class="btn btn-primary btn-lg">

            Update

        </button>

    </div>

    <!-- end submit button -->

</form>


<form class="form form-border mt-25"
      role="form"
      method="POST"
      action="{{ url('/contact') }}">

{{ csrf_field() }}


    <!-- topic select -->

    <div class="form-group{{ $errors->has('contact_topic_id') ? ' has-error' : '' }}">

        <label class="control-label">Topic</label>

        <select class="form-control" id="contact_topic_id" name="contact_topic_id">

            <option value="">Please Choose One</option>

            @foreach($topics as $topic)

            <option value={{ $topic->id }}>{{ $topic->name }}</option>

            @endforeach

        </select>

        @if ($errors->has('contact_topic_id'))

            <span class="help-block">

                <strong>{{ $errors->first('contact_topic_id') }}</strong>

            </span>

        @endif

    </div> <!-- end topic select -->



    <!-- message input -->

    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">

        <label class="control-label">Your Message</label>

        <textarea name="message"
                  class="form-control"
                  rows="20"
                  value="{{ old('message') }}"></textarea>


        @if ($errors->has('message'))

            <span class="help-block">
                <strong>{{ $errors->first('message') }}</strong>
            </span>

        @endif

    </div>

    <!-- end message input -->

    <!-- submit button -->

    <div class="form-group">

        <button type="submit"
                class="btn btn-primary btn-lg">

            Create

        </button>

    </div>

    <!-- end submit button -->

</form>


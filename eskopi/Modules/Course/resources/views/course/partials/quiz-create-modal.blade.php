<div class="modal-header">
  <h6 class="modal-title fs-5" id="">{{ __('Add Quize') }}</h6>
</div>

<div class="">
    <form action="{{ route('admin.course-chapter.lesson.store') }}" method="POST" class="add_lesson_form instructor__profile-form">
        @csrf
        <input type="hidden" name="course_id" value="{{ $courseId }}">
        <input type="hidden" name="chapter_id" value="{{ $chapterId }}">
        <input type="hidden" name="type" value="{{ $type }}">

        <div class="">
            <div class="form-grp">
                <label for="chapter">{{ __('Chapter') }} <code>*</code></label>
                <select name="chapter" id="chapter" class="chapter form-control">
                    <option value="">{{ __('Select') }}</option>
                    @foreach ($chapters as $chapter)
                        <option @selected($chapterId == $chapter->id) value="{{ $chapter->id }}">{{ $chapter->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="">
            <div class="form-grp">
                <label for="title">{{ __('Title') }} <code>*</code></label>
                <input id="title" name="title" type="text" value="" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-grp">
                    <label for="time_limit">{{ __('Time Limit') }} <code> ({{ __('leave empty for unlimited') }})</code></label>
                    <input id="time_limit" name="time_limit" type="text" value="" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-grp">
                    <label for="attempts">{{ __('Attempts') }} <code> ({{ __('leave empty for unlimited') }})</code></label>
                    <input id="attempts" name="attempts" type="text" value="" class="form-control">
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="form-grp">
                    <label for="total_mark">{{ __('Total mark') }} <code>*</code></label>
                    <input id="total_mark" name="total_mark" type="text" value="" class="form-control">
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="form-grp">
                    <label for="pass_mark">{{ __('Pass mark') }} <code>*</code></label>
                    <input id="pass_mark" name="pass_mark" type="text" value="" class="form-control">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary submit-btn" >{{ __('Create') }}</button>
        </div>
    </form>
</div>


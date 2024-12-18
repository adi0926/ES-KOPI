<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ __('Diklat') }} | {{ 'ES KOPI' }}</title>
    <meta name="description" content="SkillGro - Online Courses & Education Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="course-id" content="{{ @$course->id }}">
    <meta name="lesson-id" content="">
    <meta name="question-id" content="">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(Cache::get('setting')?->favicon) }}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/video_player.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/tg-cursor.css') }}">
    <link rel="stylesheet" href="{{ asset('global/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/frontend.css') }}">
    <style>
        .test * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: inherit; /* Inherit font from parent */
        }

        .test {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative; /* Added position for positioning timer */
        }

        .test-header h1 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .test-content {
            display: flex;
            flex-direction: column;
        }

        .test-question-container {
            margin-bottom: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            width: 80%;
            border: 1px solid #ccc;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .test-question {
            font-size: 1.1rem;
        }

        .test-question-text {
            margin-bottom: 15px;
        }

        .test-options {
            margin-bottom: 30px;
        }

        .test label {
            display: block;
            font-size: 1rem;
            margin: 5px 0;
        }

        .test input[type="radio"] {
            margin-right: 10px;
        }

        .test-footer {
            display: flex;
            justify-content: flex-end; /* Align buttons to the right */
            align-items: center;
            margin-top: 30px;
        }

        .test-navigation button {
            padding: 5px 20px;
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            cursor: pointer;
            margin-left: 10px; /* Ensure space between buttons */
        }

        /* Styling for the "Sebelumnya" button */
        .test-navigation .previous-button {
            background-color: white;
            color: #263D93;
            border: 2px solid #263D93;
        }

        .test-navigation .previous-button:hover {
            background-color: #E5EAF4; /* Slightly lighter background on hover */
            color: #263D93;
        }

        /* Styling for the "Selanjutnya" button */
        .test-navigation .next-button {
            background-color: #263D93;
            color: white;
            border: 2px solid #263D93;
        }

        .test-navigation .next-button:hover {
            background-color: #3A4E9A; /* Slightly darker background on hover */
        }

        /* Styling for the "Akhiri Test" button */
        .test-navigation .end-test-button {
            background-color: #49A85E;
            color: white;
            border: 2px solid #49A85E;
        }

        .test-navigation .end-test-button:hover {
            background-color: #3F9454; /* Slightly darker background on hover */
        }

        .test-question-number-container {
            position: absolute; /* Position relative to parent container */
            top: 90px; /* Align below the timer */
            right: 20px; /* Align to the right */
            background-color: #fff; /* White background */
            padding: 15px; /* Inner padding for spacing */
            border: 1px solid #ccc; /* Light gray border */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Shadow for depth */
        }

        /* Styling for the question number buttons */
        .test-question-number {
            display: flex;
            flex-wrap: wrap; /* Allow buttons to wrap if needed */
            gap: 5px; /* Space between buttons */
            max-width: calc(3 * 30px + 2 * 10px);
        }
        
        .test-q-btn {
            padding: 15px;
            width: 25px;
            height: 25px;
            font-size: 0.95rem;
            text-align: center;
            border: 2px solid #1d3557; /* Border around the square button */
            border-radius: 5px;
            background-color: #fff;
            color: #1d3557; /* Dark blue text */
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .test-red {
            background-color: rgba(230, 57, 47, 0.5);
            border: 2px solid #e63946;
            color: white;
        }

        .test-blue {
            background-color: rgba(47, 57, 160, 0.5); /* Darker blue background */
            border: 2px solid #2f399f; /* Darker blue border */
            color: white;
        }

        .test-green {
            background-color: rgba(47, 150, 40, 0.5); /* Darker green background */
            border: 2px solid #2e9628; /* Darker green border */
            color: white;
        }

        .test-gray {
            background-color: rgba(150, 150, 150, 0.5); /* Slightly lighter gray with transparency */
            border: 2px solid #969696; /* Slightly lighter gray border */
            color: white; /* White text for contrast */
        }

        .test-q-btn:hover {
            opacity: 0.8;
        }

        /* Timer specific styling */
        .test-timer {
            font-size: 1.2rem;
            color: white;
            background-color: rgba(230, 57, 47, 0.5); /* Red with reduced opacity */
            border: 2px solid #e63946; /* Red border */
            padding: 10px 20px;
            border-radius: 5px;
            position: absolute;
            top: 20px; /* Position at the top */
            right: 20px; /* Position at the right */
        }
    </style>
</head>

<body>
    @yield('contents')

    <!-- JS here -->
    <script>
        "use strict";
        var base_url = "{{ url('/') }}";
        var resource_text = "{{ __('Resource') }}";
        var download_des_text = "{{ __('Click on the download button for download the file') }}";
        var download_btn_text = "{{ __('Download') }}";
        var file_type_text = "{{ __('File Type') }}";
        var le_hea = "{{ __('Lesson is started') }}";
        var le_des = "{{ __('This lesson has now started. The lesson will end on') }}";
        var le_fi_he = "{{ __('Lesson is finished') }}";
        var le_fi_des = "{{ __('This lesson is finished. You cant join it.') }}";
        var le_wi_he = "{{ __('Lesson is not started yet') }}";
        var le_wi_des = "{{ __('This lesson will be started on') }}";
        var open_w_txt = "{{ __('Open in Website') }}";
        var cre_mi_txt = "{{ __('credential missing') }}";
        var open_des_txt = "{{ __('Click on the open button for check out the file') }}";
        var open_txt = "{{ __('Open') }}";
        var quiz_st_des_txt = "{{ __('Please go to quiz page for mor information') }}";
        var quiz_st_txt = "{{ __('Start Quiz') }}";
        var no_des_txt = "{{ __('No description') }}";
    </script>
    
    <script src="{{ asset('global/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/tg-cursor.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>

    <script src="{{ asset('global/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('frontend/js/sweetalert.js') }}"></script>

    <script src="{{ asset('frontend/js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('frontend/js/video_player.min.js') }}"></script>
    <script src="{{ asset('frontend/js/video_player_youtube.js') }}"></script>
    <script src="{{ asset('frontend/js/videojs-vimeo.js') }}"></script>
    <script>
        "use strict";
        toastr.options.closeButton = true;
        toastr.options.progressBar = true;
        toastr.options.positionClass = 'toast-bottom-right';
        @session('message')
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info("{{ $value }}");
                break;
            case 'success':
                toastr.success("{{ $value }}");
                break;
            case 'warning':
                toastr.warning("{{ $value }}");
                break;
            case 'error':
                toastr.error("{{ $value }}");
                break;
        }
        @endsession

        tinymce.init({
            selector: ".text-editor",
            plugins: ["link"],
            toolbar: "bold italic | formats | link",
            toolbar_mode: "floating",
            toolbar_sticky: true,
            menubar: false,
            contextmenu: "link openlink",
        });
    </script>
    @stack('scripts')
</body>

</html>

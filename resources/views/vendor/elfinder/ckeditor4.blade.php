<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>elFinder 2.0</title>

    <!-- jQuery and jQuery UI (REQUIRED) -->
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

    <!-- elFinder CSS (REQUIRED) -->
    <link rel="stylesheet" type="text/css" href="{{ asset($dir.'/css/elfinder.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($dir.'/css/theme.css') }}">

    <!-- elFinder JS (REQUIRED) -->
    <script src="{{ asset($dir.'/js/elfinder.min.js') }}"></script>

    @if($locale)
        <!-- elFinder translation (OPTIONAL) -->
        <script src="{{ asset($dir."/js/i18n/elfinder.$locale.js") }}"></script>
    @endif

    <!-- elFinder initialization (REQUIRED) -->
    <script type="text/javascript" charset="utf-8">
        function getUrlParam(paramName) {
            var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i');
            var match = window.location.search.match(reParam);
            return (match && match.length > 1) ? match[1] : '';
        }

        $(document).ready(function() {
            var funcNum = getUrlParam('CKEditorFuncNum');

            $('#elfinder').elfinder({
                @if($locale)
                lang: '{{ $locale }}',
                @endif
                customData: {
                    _token: '{{ csrf_token() }}'
                },
                url: '{{ route("elfinder.connector") }}',
                soundPath: '{{ asset($dir.'/sounds') }}',
                commandsOptions: {
                    getfile: { multiple: true }
                },
                getFileCallback: function(files) {
                    var urls = $.map(files, function(file) {
                        return file.url;
                    });

                    if (urls.length > 0) {
                        var editor = window.opener.CKEDITOR.instances[Object.keys(window.opener.CKEDITOR.instances)[0]];

                        if (editor) {
                            editor.focus();
                            var imageHtml = urls.map(function(url) {
                                return '<img src="' + url + '" alt="Image" />';
                            }).join('');

                            editor.insertHtml(imageHtml);

                            // Close the CKEditor dialog
                            if (window.opener.CKEDITOR.dialog.getCurrent()) {
                                window.opener.CKEDITOR.dialog.getCurrent().hide();
                            }

                            window.close();
                        } else {
                            alert('CKEditor instance not found.');
                        }
                    } else {
                        alert('No images selected.');
                    }
                }
            }).elfinder('instance');
        });

    </script>
</head>
<body>
<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>
</body>
</html>

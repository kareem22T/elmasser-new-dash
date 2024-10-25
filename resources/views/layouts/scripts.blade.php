<script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('/packages/barryvdh/elfinder/js/standalonepopup.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.33/jquery.colorbox-min.js"></script>

<script>
    @if (auth()->check())
        function get_website_title() {
            return $('meta[name="title"]').attr('content');
        }
        var notificationDropdown = document.getElementById('notificationDropdown')
        notificationDropdown.addEventListener('show.bs.dropdown', function() {
            $.ajax({
                method: "POST",
                url: "{{ route('admin.notifications.see') }}",
                data: {
                    _token: "{{ csrf_token() }}"
                }
            }).done(function(res) {
                $('#dropdown-notifications-icon').fadeOut();
                favicon.badge(0);
            });
        });

        function append_notification_notifications(msg) {
            if (msg.count_unseen_notifications > 0) {
                $('#dropdown-notifications-icon').fadeIn(0);
                $('#dropdown-notifications-icon').text(msg.count_unseen_notifications);
            } else {
                $('#dropdown-notifications-icon').fadeOut(0);
                favicon.badge(0);
            }
            $('.notifications-container').empty();
            $('.notifications-container').append(msg.response);
            $('.notifications-container a').on('click', function() {
                window.location.href = $(this).attr('href');
            });
        }

        function get_notifications() {
            $.ajax({
                method: "GET",
                url: "{{ route('admin.notifications.ajax') }}",
                success: function(data, textStatus, xhr) {

                    favicon.badge(data.notifications.response.count_unseen_notifications);

                    if (data.alert) {
                        var audio = new Audio('{{ asset('/sounds/notification.wav') }}');
                        audio.play();
                    }
                    append_notification_notifications(data.notifications.response);
                    if (data.notifications.response.count_unseen_notifications > 0) {
                        $('title').text('(' + parseInt(data.notifications.response
                                .count_unseen_notifications) + ')' + " " +
                            get_website_title());

                    } else {
                        $('title').text(get_website_title());
                    }
                }
            });
        }
        window.focused = 25000;
        window.onfocus = function() {
            get_notifications();
            window.focused = 25000;
        };
        window.onblur = function() {
            window.focused = 60000;
        };

        function get_nots() {
            setTimeout(function() {
                get_notifications();
                get_nots();
            }, window.focused);
        }
        get_nots();
        @if ($unreadNotifications != session('seen_notifications') && $unreadNotifications != 0)
            @php
                session(['seen_notifications' => $unreadNotifications]);
            @endphp
            var audio = new Audio('{{ asset('/sounds/notification.wav') }}');
            audio.play();
        @endif
    @else
        /* Guest Js */
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.info("{{ $error }}");
        @endforeach
    @endif
</script>

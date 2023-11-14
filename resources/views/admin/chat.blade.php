@extends('admin.master')
@section('title', 'Chat')
@section('main')
<style>
    ul {
        margin: 0;
        padding: 0;
    }

    li {
        list-style: none;
    }

    .user-wrapper,
    .message-wrapper {
        border: 1px solid #ddd;
        overflow-y: auto;
    }

    .user-wrapper {
        height: 675px;
    }

    .user {
        cursor: pointer;
        padding: 5px 0;
        position: relative;
    }

    .user:hover {
        background: #eee;
    }

    .user:last-child {
        margin-bottom: 0;
    }

    .pending {
        position: absolute;
        left: 13px;
        top: 9px;
        background: #b600ff;
        margin: 0;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        line-height: 18px;
        padding-left: 5px;
        color: #fff;
        font-size: 12px;
    }

    .media-left {
        margin: 0 10px;
    }

    .media-left img {
        width: 64px;
        border-radius: 64px;
    }

    .media-body p {
        margin: 6px 0;
    }

    .message-wrapper {
        padding: 10px;
        height: 600px;
        background: #eee;
    }

    .messages .message {
        margin-bottom: 15px;
    }

    .messages .message:last-child {
        margin-bottom: 0;
    }

    .received,
    .sent {
        width: 45%;
        padding: 3px 10px;
        border-radius: 10px;
    }

    .received {
        background: #fff;
    }

    .sent {
        background: #3bebff;
        float: right;
        text-align: right;
    }

    .message p {
        margin: 5px 0;
    }

    .date {
        color: #777;
        font-size: 12px;
    }

    .active {
        background: #eee;
    }

    input[type=text] {
        width: 100%;
        padding: 12px 20px;
        margin: 15px 0 0 0;
        display: inline-block;
        border-radius: 4px;
        box-sizing: border-box;
        outline: none;
        border: 1px solid #ccc;
    }

    input[type=text]:focus {
        border: 1px solid #aaa;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="user-wrapper">
                <ul class="users">
                    @foreach($users as $user)
                    <li class="user" id="{{ $user->id }}">
                        @if($user->unread)
                        <span class="pending">{{ $user->unread }}</span>
                        @endif
                        <div class="media row">
                            <div class="col-3">
                                <div class="media-left">
                                    @if(!$user->avatar)
                                    <img src="https://via.placeholder.com/150" alt="" class="media-object">
                                    @else
                                    <img src="{{ $user->avatar }}" alt="" class="media-object">
                                    @endif
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="media-body">
                                    <p class="name">{{ $user->name }}</p>
                                    <p class="email">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-8" id="messages">

        </div>
    </div>
</div>
@stop

@section('script')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    var received_id = '';
    var my_id = "{{ Auth::id() }}";
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('9817d80e13bca47d56d1', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            // alert(JSON.stringify(data));
            if (my_id == data.from) {
                // alert('sender');
                $('#' + data.from).click();
            } else if (my_id == data.to) {
                if (received_id == data.from) {
                    $('#' + data.from).click();
                } else {
                    var pending = parseInt($('#' + data.from).find('.pending').html());

                    if (pending) {
                        $('#' + data.from).find('.pending').html(pending + 1);
                    } else {
                        $('#' + data.from).append('<span class="pending">1</span>');
                    }
                }
            }
        });

        $('.user').click(function() {
            $('.user').removeClass('active');
            $(this).addClass('active');
            $(this).find('.pending').remove();

            received_id = $(this).attr('id');
            // alert(received_id);
            $.ajax({
                type: "get",
                url: '{{ url("admin/chat/message") }}/' + received_id,
                data: "",
                cache: false,
                success: function(data) {
                    $('#messages').html(data);
                    scrollToBottomFunc();
                }
            });
        });

        $(document).on('keyup', '.input-text input', function(e) {
            var message = $(this).val();

            if (e.keyCode == 13 && message != '' && received_id != '') {
                // alert(message);
                $(this).val('');

                // var datastr = "received_id=" + received_id + "&message=" + message;
                var datastr = "received_id=" + received_id + "&message=" + message + "&_token={{ csrf_token() }}";
                // alert(datastr);
                // Nhan duoc: received_id=2&message=Hi
                $.ajax({
                    type: "post",
                    url: '{{ url("admin/chat/message") }}',
                    // url: "message",
                    data: datastr,
                    cache: false,
                    success: function(data) {

                    },

                    error: function(jqXHR, status, err) {

                    },
                    complete: function() {}
                });
            }
        });
    });

    function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }
</script>
<script>
    $(document).ready(function() {
        // Loại bỏ lớp active từ tất cả các liên kết trong phần tử có class "navbar-nav"
        $(".navbar-nav .nav-link").removeClass("active");

        // Thêm lớp active vào liên kết "Quản lý tài khoản"
        $(".navbar-nav .fa-comments").parent().addClass("active");
    });
</script>
</body>

</html>

@stop
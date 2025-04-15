<script>
    var message = '';
    document.addEventListener('DOMContentLoaded', function() {
        var message = '';
        var icon = '';

        @if(session('login') == 'false')
            message = 'User tidak ditemukan';
            icon = 'error';
            title = 'Failed';
        @elseif (session('login') == 'not_found')
            title = 'error';
            message = 'Email/Password Salah';
            icon = 'Failed';
        @endif


        if (message != '') {
            Swal.fire({
                title: title,
                text: message,
                icon: icon
            });

            @php
                session()->forget('login');
            @endphp
        }
    });
</script>
Hello

<footer class="footer pt-3  ">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    {{-- made with <i class="fa fa-heart"></i> by --}}
                    {{-- <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a> --}}
                    <a href="#" class="font-weight-bold" target="_blank">MINT Technology</a>
                    {{-- &
                    <a href="https://www.updivision.com" class="font-weight-bold" target="_blank">UPDIVISION</a>
                    for a better web. --}}
                </div>
            </div>
            {{-- <div class="col-lg-6">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <li class="nav-item">
                        <a href="https://www.updivision.com" class="nav-link text-muted" target="_blank">UPDIVISION</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                            target="_blank">License</a>
                    </li>
                </ul>
            </div> --}}
        </div>
    </div>
</footer>
<script>
    var message = '';
    document.addEventListener('DOMContentLoaded', function() {
        var message = '';

        @if(session('success') == 'updated')
            message = 'Data Updated';
        @elseif (session('success') == 'created')
            message = 'Data Created Successfully';
        @endif

        if (message !== '') {
            Swal.fire({
                title: 'Success!',
                text: message,
                icon: 'success'
            });

            // Clear the 'success' session variable
            @php
                session()->forget('success');
            @endphp
        }
    });
</script>
<style>
footer {
  position: fixed;
  padding-left: 15%;
  left: 0;
  padding-right: 5%;
  bottom: 0;
  height: 5%;
  width: 100%;
  background: white;
}
</style>

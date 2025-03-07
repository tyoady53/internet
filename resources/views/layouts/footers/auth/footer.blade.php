<div class="modal fade" id="modal_change_pass" tabindex="-1" aria-labelledby="UserDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UserDetailsModalLabel">Ganti Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="p-2">
                <form role="form" method="post" action="{{ route('user.change_password') }}">
                    @csrf
                    <div>
                        <label class="fw-bold">Password Baru</label>
                        <input class="form-control" value="" name="password" type="text" placeholder="Password Baru">
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button class="btn btn-success shadow-sm rounded-sm" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <form  method="get" action="{{ route('billing.store',$unique_id) }}">
                <div class="modal-body">
                    <div id="payment_encrypted"></div>
                    <div id="content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form> --}}
        </div>
    </div>
</div>
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
        var icon = '';

        @if(session('success') == 'updated')
            message = 'Data Updated';
            icon = 'success';
            title = 'Success';
        @elseif (session('success') == 'created')
            title = 'Success';
            message = 'Data Created Successfully';
            icon = 'success';
        @elseif (session('success') == 'failed')
            title = 'Failed';
            message = 'Create/Update data failed';
            icon = 'error';
        @endif


        if (message != '') {
            Swal.fire({
                title: title,
                text: message,
                icon: icon
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

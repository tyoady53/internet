@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Laporan'])
    <div class="card shadow-lg mx-4 mt-8" id="report">
        {{-- Here strart the report --}}
        <div class="card-body p-3">
            <div class="row gx-4">
                <form>
                    <div class="input-group mb-3">
                        <div class="input-group mb-3">
                            <form role="form" method="get" action="{{ route('report.index') }}">
                                <select class="form-control input-group-text mb-3" name="periode">
                                @foreach ($filters as $filter)
                                    <option value="{{ $filter->key }}" {{ request('periode') == $filter->key ? 'selected' : '' }}>{{ $filter->value }}</option>
                                @endforeach
                                </select>
                                <button class="btn btn-primary input-group-text me-1" type="button" id="filter"> <i class="fa fa-search me-2"></i> Filter</button>
                                <button class="btn btn-primary input-group-text" type="button" id="daftar"> <i class="fa fa-list me-2"></i> Daftar Laporan</button>
                            </form>
                        </div>
                    </div>
                </form>

                <div id="loading" style="display: none">
                    <div id="loading-content" class="loading-content"></div>

                </div>
                <div class="table-responsive">
                <div id="table_title"></div>
                <table class="table table-striped table-bordered table-hover" id="example">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width:5%"> No </th>
                            <th scope="col" class="text-center"> Nama </th>
                            <th scope="col" class="text-center"> Paket </th>
                            <th scope="col" class="text-center"> Jumlah </th>
                        </tr>
                    </thead>
                    <tbody id="table_content">

                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4" id="question">
        <div class="row">

        </div>
        @include('layouts.footers.auth.footer')
    </div>

    <style>
        .fixed {
            position: fixed;
            top: 0;
            right: 0;
            left: 17rem;
            margin-top: 15px;
            margin-right: 1.5rem;
            z-index: 99;
        }

        .additionalDiv {
            margin-top: 22.5rem;
        }

        .hover:hover{
            background: blue;
        }

        @media(max-width: 1199px){
            .fixed {
                position: fixed;
                top: 0;
                right: 0;
                left: 0;
                margin-top: 15px;
                z-index: 99;
            }

            .additionalDiv {
                margin-top: 22rem;
            }
        }

        @media(max-width: 910px){
            .card.card-profile-bottom{
                margin-top: 15rem;
            }
            .py-4{
                padding-top: 1rem !important;
            }
            .fixed {
                position: fixed;
                top: 0;
                right: 0;
                left: 0;
                margin-top: 15px;
                z-index: 99;
            }

            .additionalDiv {
                margin-top: 22rem;
            }
        }

        @media(max-width: 501px){
            .card.card-profile-bottom{
                margin-top: 12rem;
            }
            .py-4{
                padding-top: 1rem !important;
            }
            .fixed {
                position: fixed;
                top: 0;
                right: 0;
                left: 0;
                margin-top: 15px;
                z-index: 99;
            }

            .additionalDiv {
                margin-top: 20rem;
            }
        }

        @media(max-width: 464px){
            .card.card-profile-bottom{
                margin-top: 12rem;
            }
            .py-4{
                padding-top: 0.55rem !important;
            }
            .fixed {
                position: fixed;
                top: 0;
                right: 0;
                left: 0;
                margin-top: 15px;
                z-index: 99;
            }

            .additionalDiv {
                margin-top: 20rem;
            }
        }
    </style>
    <script>
        $(document).ready(function($) {
            // console.log("Document is ready!");
            // Get current month in Y-m format (e.g., 2025-03)

            $("#filter").click(function(){
                // window.showLoading()
                $('#loading').show();
                var periode = document.getElementsByName('periode');
                // console.log(periode[0]?.value)
                get_data(periode[0]?.value);
            });

            $("#daftar").click(function(){
                location.href = '/report/lists';
            });

            var month = new Date();
            var formattedMonth = month.getFullYear() + '-' + ("0" + (month.getMonth() + 1)).slice(-2);
            // console.log("Current Month (Y-m):", formattedMonth);

            // Call the get_data function with the formatted date
            get_data(formattedMonth);
        });

        function get_data(date) {
            console.log(date);
            $('#loading').show(); // Show loading indicator

            // Make the API request using the provided date
            axios({
                method: 'get',
                url: '/report/get/' + date
            })
            .then(function(response) {
                // If the response status is 200, show success and load data
                if (response.data.status == 200) {
                    Swal.fire({
                        title: "Success!",
                        text: "Berhasil Memuat "+response.data.message,
                        icon: "success",
                    }).then(() => {
                        console.log(response.data)
                        load_data(response.data.data,response.data.message); // Pass the data to load_data
                    });
                } else {
                    // Handle failure
                    Swal.fire({
                        title: "Error!",
                        text: "Fetch data gagal",
                        icon: "error",
                    });
                }
            })
            .catch(function(error) {
                console.error("Error fetching data:", error);
                Swal.fire({
                    title: "Error!",
                    text: "Terjadi kesalahan saat mengambil data",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            });
        }

        function load_data(data,message) {
            console.log(data);
            $('#loading').hide(); // Hide loading indicator
            var inner = '';

            // Loop through each group (e.g., "Pesona Anggrek")
            Object.keys(data).forEach((groupName) => {
                var current_group = data[groupName]; // Group data for this groupName
                console.log(groupName, current_group);

                // Group header
                inner += '<tr>';
                inner += '<td colspan="3"><strong>' + groupName + ' (' + current_group["sudah_bayar"].length + ' Sudah Bayar, ' + current_group["belum_bayar"].length + ' Belum Bayar)</strong></td>';
                inner += '<td class="text-end"><strong>'+Number(current_group.total_group).toLocaleString()+'</strong></td>';
                inner += '</tr>';

                // Sudah Bayar Section
                if (current_group["sudah_bayar"].length > 0) {
                    inner += '<tr><td colspan="3"><strong>Sudah Bayar</strong></td>';
                    inner += '<td class="text-end"><strong>'+Number(current_group.total_dibayar).toLocaleString()+'</strong></td></tr>';
                    current_group["sudah_bayar"].forEach((customer, index) => {
                        inner += formatCustomerRow(index + 1, customer, true);
                    });
                }

                // Belum Bayar Section
                if (current_group["belum_bayar"].length > 0) {
                    inner += '<tr><td colspan="3"><strong>Belum Bayar</strong></td>';
                    inner += '<td class="text-end"><strong>'+Number(current_group.total_belum_bayar).toLocaleString()+'</strong></td></tr>';
                    current_group["belum_bayar"].forEach((customer, index) => {
                        inner += formatCustomerRow(index + 1, customer, false);
                    });
                }
            });

            // Update the table content
            document.getElementById("table_content").innerHTML = inner;
            document.getElementById("table_title").innerHTML = `<div class="row"><div class="col-8"><h4>${message}</h4></div><div class="col-4 text-end"><button id="exportBtn" class="btn btn-primary">Export</button></div></div>`;

            document.getElementById("exportBtn").addEventListener("click", function() {
                exportData();
            });
        }

        function exportData() {
            var periode = document.getElementsByName('periode');
                // console.log(periode[0]?.value)
            var month = periode[0]?.value;
            // Display a loading message or indication
            // alert('Exporting data for month: ' + month);
            Swal.fire({
                title: "Info!",
                text: 'Exporting data for month: ' + month,
                icon: "info",
                timer: 2000, // Dismiss after 2 seconds
                showConfirmButton: false, // Hide the confirm button
                showConfirmButton: false, // Hide the confirm button
                timerProgressBar: true, // Show the progress bar
                didOpen: () => {
                    Swal.showLoading();
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            });

            // Perform the export operation (you can use AJAX or navigate directly)
            $.ajax({
                url: '/report/export/' + month,
                method: 'GET',
                success: function(response) {
                    // Handle success response (for example, notify the user)
                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                    });
                    // console.log(response)
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    alert('Error exporting data: ' + error);
                }
            });
        }

        // Helper function to format customer row
        function formatCustomerRow(index, customer, isPaid) {
            var formattedJumlah = Number(customer.jumlah).toLocaleString();
            return `
                <tr>
                    <td>${index}</td>
                    <td>${customer.name}</td>
                    <td>${customer.paket}</td>
                    <td class="text-end">
                        ${formattedJumlah}
                    </td>
                </tr>
            `;
        }

        function show(param){
            var baseUrl = window.location;
            window.location.href = '/report/'+param+'/show'
        }
    </script>

@endsection

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">

    {{-- DataTable --}}
    <link href="{{ asset('plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- Toast --}}
    <link href="{{ asset('plugins/toast-master/css/jquery.toast.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('items.index') }}">Items</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/toast-master/js/jquery.toast.js') }}"></script>

    <script type="text/javascript">
        function setDataTable(tableElementId, url, data = {}, columns, options = null)
        {
            if ($.fn.DataTable.isDataTable(tableElementId)){
                $(tableElementId).DataTable().destroy()
            }

            if (!options) {
                options = {
                    order: [0, 'desc']
                }
            }

            console.log('data', data)

            $(tableElementId).DataTable({
                ...options,
                processing: true,
                serverSide: true,
                // fixedHeader: {
                //     header: true,
                //     headerOffset: $(".navbar").height()
                // },
                ajax: {
                    url: url,
                    data: data,
                },
                columns: columns,
                initComplete: function () {
                    // this.api()
                    //     .columns()
                    //     .every(function () {
                    //         let column = this;
                    //         let title = column.header().textContent;
            
                    //         // Create input element
                    //         let input = document.createElement('input');
                    //         input.placeholder = 'Search...';
                    //         column.header().replaceChildren(input);
            
                    //         // Event listener for user input
                    //         input.addEventListener('keyup', () => {
                    //             if (column.search() !== this.value) {
                    //                 column.search(input.value).draw();
                    //             }
                    //         });
                    //     });

                    // this.api().columns().every(function () {
                    //     var that = this;
                    //     $('input', this.header()).on('change clear', function () {
                    //         if (that.search() !== this.value) {
                    //             that.search(this.value).draw();
                    //         }
                    //     });
                    // });
                }
            })
        }

        // public function for store data
        function storeData(url, data, isUploadFile = false, tableElementId = null)
        {
            let ajaxParams = {
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                type: 'POST'
            }

            if(isUploadFile){
                ajaxParams = {
                    ...ajaxParams,
                    contentType: false,
                    processData: false,
                }
            }

            $.ajax({
                ...ajaxParams,
                beforeSend: function(){
                    $("#btn-simpan").attr("disabled", true);
                    $(".loading").show();
                },
                success: function(res){
                    $("#btn-simpan").attr("disabled", false);
                    $(".loading").hide();
                    $(".modal").modal("hide");
                    $(".btn-close-modal").click();
                    $.toast({
                        heading: 'Berhasil',
                        text: 'Berhasil menyimpan data!',
                        position: 'top-right',
                        loaderBg: '#fff',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });

                    let table = tableElementId ? tableElementId : ".data-table";
                    $(table).dataTable().fnDraw(false);
                },
                error: function(err){
                    $("#btn-simpan").attr("disabled", false);
                    $(".loading").hide();
                    $(".modal").modal("hide");
                    $(".btn-close-modal").click();
                    $.toast({
                        heading: 'Gagal',
                        text: 'Gagal menyimpan data!',
                        position: 'top-right',
                        loaderBg: '#fff',
                        icon: 'warning',
                        hideAfter: 3500,
                        stack: 6
                    });
                }
            });
        }

        // public function for update data
        function updateData(url, data, isUploadFile = false, tableElementId = null)
        {
            if(data instanceof FormData) data.append('_method', 'PUT');

            let ajaxParams = {
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                type: 'POST'
            }

            if(isUploadFile){
                ajaxParams = {
                    ...ajaxParams,
                    contentType: false,
                    processData: false,
                }
            }

            $.ajax({
                ...ajaxParams,
                beforeSend: function(){
                    $("#btn-update").attr("disabled", true);
                    $(".loading").show();
                },
                success: function(res){
                    $("#btn-update").attr("disabled", false);
                    $(".loading").hide();
                    $(".modal").modal("hide");
                    $(".btn-close-modal").click();
                    $.toast({
                        heading: 'Berhasil',
                        text: 'Berhasil menyimpan data!',
                        position: 'top-right',
                        loaderBg: '#fff',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });
                    
                    let table = tableElementId ? tableElementId : ".data-table";
                    $(table).dataTable().fnDraw(false);
                },
                error: function(err){
                    $("#btn-update").attr("disabled", false);
                    $(".loading").hide();
                    $(".modal").modal("hide");
                    $(".btn-close-modal").click();
                    $.toast({
                        heading: 'Gagal',
                        text: 'Gagal menyimpan data!',
                        position: 'top-right',
                        loaderBg: '#fff',
                        icon: 'warning',
                        hideAfter: 3500,
                        stack: 6
                    });
                }
            });
        }

        function deleteData(url, tableElementId = null)
        {
            let ajaxParams = {
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _method: 'DELETE'
                },
                type: 'POST'
            }

            $.ajax({
                ...ajaxParams,
                beforeSend: function(){
                    $("#btn-hapus").attr("disabled", true);
                    $(".loading").show();
                },
                success: function(res){
                    $("#btn-hapus").attr("disabled", false);
                    $(".loading").hide();
                    $(".modal").modal("hide");
                    $(".btn-close-modal").click();
                    $.toast({
                        heading: 'Berhasil',
                        text: 'Berhasil menghapus data!',
                        position: 'top-right',
                        loaderBg: '#fff',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });
                    
                    let table = tableElementId ? tableElementId : ".data-table";
                    $(table).dataTable().fnDraw(false);
                },
                error: function(err){
                    $("#btn-hapus").attr("disabled", false);
                    $(".loading").hide();
                    $(".modal").modal("hide");
                    $(".btn-close-modal").click();
                    $.toast({
                        heading: 'Gagal',
                        text: 'Gagal menghapus data!',
                        position: 'top-right',
                        loaderBg: '#fff',
                        icon: 'warning',
                        hideAfter: 3500,
                        stack: 6
                    });
                }
            });
        }
    </script>
    
    @stack('after-script')
</body>
</html>

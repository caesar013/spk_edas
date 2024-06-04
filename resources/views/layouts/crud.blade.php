<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EDAS | @yield('title') </title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- jQuery for Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>
</head>

@yield('variable')

<body class="sb-nav-fixed">
    @auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @endauth
    @include('layouts.nav')
    <div id="layoutSidenav">
        @include('layouts.sidenav')
        <div id="layoutSidenav_content">
            <main>
                @yield('main')

                @isset($model)

                <!-- Add Modal -->
                <div class="modal fade" id="add_{!!$model!!}_modal" tabindex="-1" role="dialog"
                    aria-labelledby="modal_add_{!!$model!!}Label" aria-hidden="true" data-toggle="modal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_add_{!!$model!!}Label">Title</h5>
                                <button type="button" class="" aria-label="Close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="errorAdd"></div>
                                <div class="form-group mb-3">
                                    @yield('add_modal')
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary add_{!!$model!!}">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End- Add Modal -->

                <!-- Delete Modal -->
                <div class="modal fade" id="modal_delete_{!!$model!!}" tabindex="-1" role="dialog"
                    aria-labelledby="modal_delete_{!!$model!!}Label" aria-hidden="true" data-toggle="modal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_delete_{!!$model!!}Label">Title</h5>
                                <button type="button" class="close" aria-label="Close" data-dismiss="modal"
                                    onclick="closeModal('modal_delete_{!!$model!!}')">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="delete_id">
                                <h2>WARNING</h2>
                                <h3>Are you sure to delete everything inside this @php
                                    echo ucwords($model);
                                    @endphp!!!</h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    onclick="closeModal('modal_delete_{!!$model!!}')">Close</button>
                                <button type="button" class="btn btn-primary proceed_delete_{!!$model!!}">Yes,
                                    delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End- Delete Modal -->

                <!-- Edit Modal -->
                <div class="modal fade" id="modal_edit_{!!$model!!}" tabindex="-1" role="dialog"
                    aria-labelledby="modal_edit_{!!$model!!}Label" aria-hidden="true" data-toggle="modal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_edit_{!!$model!!}Label">Title</h5>
                                <button type="button" class="close" aria-label="Close" data-dismiss="modal"
                                    onclick="closeModal('modal_edit_{!!$model!!}')">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="errorEdit"></div>
                                <div class="form-group mb-3">
                                    @yield('edit_modal')
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    onclick="closeModal('modal_edit_{!!$model!!}')">Close</button>
                                <button type="button" class="btn btn-primary update_{!!$model!!}">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End- Edit Modal -->
                @endisset
            </main>
            <footer class="py-4 bg-light mt-auto">
                @include('layouts.footer')
            </footer>
        </div>
    </div>
    </script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    {{-- for modal --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    </script>

    <script src="{{asset('js/scripts.js')}}"></script>

    @yield('js')
</body>

</html>

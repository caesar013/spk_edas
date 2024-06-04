@extends('layouts.crud')

@section('title', 'Edas')

@section('variable')
@php
$model = 'edas';
@endphp
@endsection

@section('main')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="success" class="mt-2"></div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 table-title"><b>EDAS</b></div>
                        <div class="col-md-6 d-flex justify-content-end"><button type="button" href=""
                                class=" btn btn-primary" data-toggle="modal" data-target="#add_edas_modal">
                                + Add new EDAS
                            </button> </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama EDAS</th>
                                <th>Jumlah Kriteria</th>
                                <th>Jumlah Alternatif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('add_modal')
<input type="hidden" id="id_user" value="{{Auth::getUser()->id}}">
<label for="name">Name</label>
<input type="text" class="name form-control" id="name" value="{{ old('name') }}" required>
@endsection

@section('edit_modal')
<input type="hidden" id="id_edit">
<input type="hidden" id="id_user_edit">
<label for="name">Nama Baru</label>
<input type="text" class="name form-control" id="name_edit" value="" required>
@endsection

@section('js')
<script>
    function fetch() {
        $.ajax({
            type: "GET",
            url: "{{ route('dashboard.fetchDataEdas') }}",
            dataType: "json",
            success: function(data) {
                $('#modal_add_edasLabel').html('Add EDAS');
                $('tbody').html("");
                if (data.edas.length==0) {
                    $('tbody').append(`
                    <tr>
                        <td colspan="5" class="text-center"> No EDAS tracked. Try creating one.</td>
                    </tr>`);
                } else {
                    $.each(data.edas, function(foo, bar) {
                        var url_criteria = "/dashboard/criteria/"+bar.id;
                        $('tbody').append(`
                            <tr>
                                <td>` + (foo+1) + `</td>
                                <td><a class='nav nav-link' href= "`+url_criteria+`">` + bar.name + `</a></td>
                                <td>` + bar.criterias_count + `</td>
                                <td>` + bar.alternatives_count + `</td>
                                <td>
                                        <button type="button" class="edit_edas btn btn-primary btn-sm" value="` +
                            bar.id + `">Edit</button>
                                        <button type="button" class="delete_edas btn btn-danger btn-sm" value="` +
                            bar.id + `">Delete</button>
                                </td>
                            </tr>`);
                    })
                }
            }
        });
    }

    function closeModal(idModal) {
            $("#" + idModal).modal('hide');
    }

    function updateData(){
        fetch();
    }

    $(document).ready(function() {


    fetch();

    $(document).on('click', '.add_edas', function(e) {
                e.preventDefault();
                var edas = {
                    'name': $('.name').val(),
                    'id_user': $('#id_user').val(),
                };

                $.ajax({
                    type: "POST",
                    url: "{{ route('dashboard.edas.store') }}",
                    data: edas,
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            $('#success').addClass('alert alert-success');
                            $('#success').text(response.message);
                            fetch();
                            $('#add_edas_modal').modal('hide');
                        } else {
                            $('#errorAdd').html("");
                            $('#errorAdd').addClass('alert alert-danger');
                            for (const [key, value] of Object.entries(response.error)) {
                                $('#errorAdd').append(`<li>` + value + `</li>`);
                            }
                        }
                    }
                });
            });

            $(document).on('click', '.delete_edas', function(e) {
                e.preventDefault();
                let id_edas = $(this).val();
                $('#delete_id').val(id_edas);
                $('#modal_delete_edasLabel').text('Delete Warning!!!');
                $('#modal_delete_edas').modal('show');
    });

    $(document).on('click', '.proceed_delete_edas', function(e) {
                e.preventDefault();
                let id_edas = $('#delete_id').val();

                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/edas/' + id_edas,
                    success: function(res) {
                        if (res.status) {
                            $('#success').html("");
                            $('#success').addClass('alert alert-success');
                            $('#success').text(res.message);
                            updateData();
                            $('#modal_delete_edas').modal('hide');
                        } else {
                            $('#success').html("");
                            $('#success').addClass('alert alert-danger');
                            for (const [key, value] of Object.entries(response.error)) {
                                $('#success').append(`<li>` + value + `</li>`);
                            }
                            $('#modal_delete_edas').modal('hide');
                        }
                    }
                });
            });

            $(document).on('click', '.edit_edas', function(e) {
                e.preventDefault();
                let id_edas = $(this).val();
                $("#modal_edit_edasLabel").html('Edit EDAS');
                $('#modal_edit_edas').modal('show');
                let editUrl = "/dashboard/edas/" + id_edas + "/edit";
                $.ajax({
                    type: "GET",
                    url: editUrl,
                    success: function(response) {
                        if (response.status) {
                            $('#id_edit').val(response.edas.id);
                            $('#id_user_edit').val(response.edas.id_user);
                            $('#name_edit').val(response.edas.name);
                        } else {
                            $('#success').html('');
                            $('#success').addClass('alert alert-danger');
                            for (const [key, value] of Object.entries(response.error)) {
                                $('#success').append(`<li>` + value + `</li>`);
                            }
                        }
                    }
                });
            });

            $(document).on('click', '.update_edas', function(e) {
                e.preventDefault();

                let id_edas = $("#id_edit").val();

                let data = {
                    'id_user': $('#id_user_edit').val(),
                    'id': $('#id_edit').val(),
                    'name': $('#name_edit').val(),
                };

                $.ajax({
                    type: 'PUT',
                    url: '/dashboard/edas/' + id_edas,
                    data: data,
                    dataType: 'json',
                    success: function(res) {
                        if (res.status) {
                            $('#success').html('');
                            $('#success').addClass('alert alert-success');
                            $('#success').text(res.message);
                            $('#modal_edit_edas').modal('hide');
                            fetch();
                        } else {
                            $('#errorEdit').html('');
                            $('#errorEdit').addClass('alert alert-danger');
                            for (const [key, value] of Object.entries(response.error)) {
                                $('#errorEdit').append(`<li>` + value + `</li>`);
                            }
                        }
                    }
                });
            });
        });
</script>
@endsection
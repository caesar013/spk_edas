@extends('layouts.sepuh')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="success" class="mt-2"></div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 table-title"><b>Alternatif</b></div>
                        <div class="col-md-6 d-flex justify-content-end" id="portal"><button type="button" href=""
                                class=" btn btn-primary" data-toggle="modal" data-target="#add_alternative_modal">
                                + Tambah Alternatif
                            </button> </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th>Kode Alternatif</th>
                                <th>Nama Alternatif</th>
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

<!-- Add Alternative Modal -->
<div class="modal fade" id="add_alternative_modal" tabindex="-1" role="dialog"
    aria-labelledby="modal_add_alternativeLabel" aria-hidden="true" data-toggle="modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_add_alternativeLabel">Title</h5>
                <button type="button" class="" aria-label="Close" data-dismiss='modal'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="errorAdd"></div>
                <div class="form-group mb-3">
                    <input type="hidden" id="id_edas" value="">
                    <label for="name">Nama Alternatif</label>
                    <input type="text" class="name form-control" id="name" value="{{ old('name') }}" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-target="modal" data-dismiss="modal"
                    onclick="closeModal('add_alternative_modal')">Close</button>
                <button type="button" class="btn btn-primary add_alternative">Save</button>
            </div>
        </div>
    </div>
</div>
<!--End- Add Alternative Modal -->

<!-- Delete Alternative Modal -->
<div class="modal fade" id="modal_delete_alternative" tabindex="-1" role="dialog"
    aria-labelledby="modal_delete_alternativeLabel" aria-hidden="true" data-toggle="modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_delete_alternativeLabel">Title</h5>
                <button type="button" class="close" aria-label="Close" data-dismiss="modal"
                    onclick="closeModal('modal_delete_alternative')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="delete_id">
                <h2>WARNING</h2>
                <h3>Are you sure to delete everything inside this Alternative!!!</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal"
                    onclick="closeModal('modal_delete_alternative')">Close</button>
                <button type="button" class="btn btn-primary proceed_delete_alternative">Yes, delete</button>
            </div>
        </div>
    </div>
</div>
<!--End- Delete Alternative Modal -->

<!-- Edit Alternative Modal -->
<div class="modal fade" id="modal_edit_alternative" tabindex="-1" role="dialog"
    aria-labelledby="modal_edit_alternativeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_edit_alternativeLabel">Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    onclick="closeModal('modal_edit_alternative')">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="errorEdit"></div>
                <div class="form-group mb-3">
                    <input type="hidden" id="id_edit">
                    <input type="hidden" id="id_edas_edit">
                    <label for="name">Nama Alternatif</label>
                    <input type="text" class="name form-control" id="name_edit" value="{{ old('name') }}" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    onclick="closeModal('modal_edit_alternative')">Close</button>
                <button type="button" class="btn btn-primary update_alternative">Update</button>
            </div>
        </div>
    </div>
</div>
<!--End- Edit Alternative Modal -->

@endsection

@section('js')
<script>
    let id_edas = @json($edas->id);
    let edas = @json($edas);
    let alternatives = @json($alternatives);
    let status_criteria = @json($status_criteria);
    let status_subcriteria = @json($status_subcriteria);

    document.addEventListener('DOMContentLoaded', function() {

    $('#href_criteria').attr('href', "/dashboard/criteria/"+id_edas+""); 
    $('#href_alternative').attr('href' , "/dashboard/alternative/"+id_edas+ "");
    $('#href_matrix').attr('href' , "/dashboard/decisionmatrix/"+id_edas+ "");

    $('#href_average').attr('href' , "/dashboard/average/"+id_edas+ "");
    $('#href_pda').attr('href' , "/dashboard/pda/"+id_edas+ "");
    $('#href_nda').attr('href' , "/dashboard/nda/"+id_edas+ "");
    $('#href_sp').attr('href' , "/dashboard/sp/"+id_edas+ "");
    $('#href_sn').attr('href' , "/dashboard/sn/"+id_edas+ "");
    $('#href_nsp').attr('href' , "/dashboard/nsp/"+id_edas+ "");
    $('#href_nsn').attr('href' , "/dashboard/nsn/"+id_edas+ "");
    $('#href_apraisalscore').attr('href' , "/dashboard/apraisalscore/"+id_edas+ "");

    $('#href_result').attr('href' , "/dashboard/result/"+id_edas+ "");

    $('.table-title').html('<b>Alternatif of ' + edas.name +'</b>');

    $('#id_edas').val(id_edas);

        if (status_criteria == false) {
            $('#portal').html("");
            $('#portal').append(`<button type="button" href="/dashboard/criteria/`+id_edas+`" class="btn btn-primary portal_button" value="`+id_edas+`">+ Tambah Kriteria</button>`);
            $('tbody').append(`
                <tr>
                    <td colspan="3" class="text-center"> No Criteria tracked. Try creating one.</td>
                </tr>`);
        } else if (status_subcriteria == false) {
            $('#portal').html("");
            $('#portal').append(`<button type="button" href="/dashboard/criteria/`+id_edas+`" class="btn btn-primary portal_button" value="`+id_edas+`">+ Tambah Kriteria</button>`);
                    $('tbody').append(`
                    <tr>
                        <td colspan="3" class="text-center"> Insufficient Sub-Criteria tracked. Fill up sub-criteria for each Criteria from Criteria page    .</td>
                    </tr>`);
        } else {
            if (alternatives.length==0) {
                $('tbody').append(`
                    <tr>
                        <td colspan="3" class="text-center"> No Alternative tracked. Try creating one.</td>
                    </tr>`);
            } else {
                
            }
            $.each(alternatives, function(foo, bar) {
                $('tbody').append(`
                    <tr>
                        <td> Q` + (foo+1) + `</td>
                        <td>` + bar.name + `</td>
                        <td>
                                <button type="button" class="edit_alternative btn btn-primary btn-sm" value="` +
                            bar.id + `">Edit</button>
                                <button type="button" class="delete_alternative btn btn-danger btn-sm" value="` +
                            bar.id + `">Delete</button>
                        </td>
                    </tr>`);
            })
        }
    });

    function fetch() {
        $.ajax({
            type: "GET",
            url: "/dashboard/alternative/data/"+ id_edas,
            dataType: "json",
            success: function(data) {
                $('#errorAdd').html("");
                $('#errorEdit').html("");
                $('#modal_add_alternativeLabel').html('Add Alternative');
                $('tbody').html("");
                if (data.alternatives.length==0) {
                    $('tbody').append(`
                        <tr>
                            <td colspan="3" class="text-center"> No Alternatives tracked. Try creating one.</td>
                        </tr>`);
                } else {
                    $.each(data.alternatives, function(foo, bar) {
                        $('tbody').append(`
                            <tr>
                                <td> Q` + (foo+1) + `</td>
                                <td>` + bar.name + `</td>
                                <td>
                                        <button type="button" class="edit_alternative btn btn-primary btn-sm" value="` +
                                    bar.id + `">Edit</button>
                                        <button type="button" class="delete_alternative btn btn-danger btn-sm" value="` +
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

    $(document).ready(function() {


    $(document).on('click', '.add_alternative', function(e) {
                e.preventDefault();
                var alternative = {
                    'id_edas': $('#id_edas').val(),
                    'name': $('#name').val(),
                };

                $.ajax({
                    type: "POST",
                    url: "{{ route('dashboard.alternative.store') }}",
                    data: alternative,
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            $('#success').addClass('alert alert-success');
                            $('#success').text(response.message);
                            fetch();
                            $('#add_alternative_modal').modal('hide');
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
            
    $(document).on('click', '.delete_alternative', function(e) {
        e.preventDefault();
        let id_alternative = $(this).val();
        $('#delete_id').val(id_alternative);
        $('#modal_delete_alternativeLabel').text('Delete Warning!!!');
        $('#modal_delete_alternative').modal('show');
    });

    $(document).on('click', '.proceed_delete_alternative', function(e) {
                e.preventDefault();
                let id_alternative = $('#delete_id').val();

                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/alternative/' + id_alternative,
                    success: function(res) {
                        if (res.status) {
                            $('#success').html("");
                            $('#success').addClass('alert alert-success');
                            $('#success').text(res.message);
                            fetch();
                            $('#modal_delete_alternative').modal('hide');
                        } else {
                            $('#success').html("");
                            $('#success').addClass('alert alert-danger');
                            for (const [key, value] of Object.entries(response.error)) {
                                $('#success').append(`<li>` + value + `</li>`);
                            }
                            $('#modal_delete_alternative').modal('hide');
                        }
                    }
                });
            });
            
            $(document).on('click', '.edit_alternative', function(e) {
                e.preventDefault();
                let id_alternative = $(this).val();
                $("#modal_edit_alternativeLabel").html('Edit Alternatif');
                $('#modal_edit_alternative').modal('show');
                let editUrl = "/dashboard/alternative/" + id_alternative + "/edit";
                $.ajax({
                    type: "GET",
                    url: editUrl,
                    success: function(response) {
                        if (response.status) {
                            $('#id_edit').val(response.alternative.id);
                            $('#id_edas_edit').val(response.alternative.id_edas);
                            $('#name_edit').val(response.alternative.name);
                            $('#weight_edit').val(response.alternative.weight);
                            $('#type_edit').val(response.alternative.type);
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

            $(document).on('click', '.update_alternative', function(e) {
                e.preventDefault();

                let id_alternative = $("#id_edit").val();

                let data = {
                    'id' : $('#id_edit').val(),
                    'id_edas': $('#id_edas_edit').val(),
                    'name': $('#name_edit').val(),
                    'weight': $('#weight_edit').val(),
                    'type': $('#type_edit').val(),
                };

                $.ajax({
                    type: 'PUT',
                    url: '/dashboard/alternative/' + id_alternative,
                    data: data,
                    dataType: 'json',
                    success: function(res) {
                        if (res.status) {
                            $('#success').html('');
                            $('#success').addClass('alert alert-success');
                            $('#success').text(res.message);
                            $('#modal_edit_alternative').modal('hide');
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

            $(document).on('click', '.portal_button', function(e) {
                e.preventDefault();
                let id_criteria = $(this).val();
                window.location.href = "/dashboard/criteria/" + id_criteria + "";
            });
        });
</script>
@endsection
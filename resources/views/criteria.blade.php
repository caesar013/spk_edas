@extends('layouts.sepuh')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="success" class="mt-2"></div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"><b>Kriteria</b></div>
                        <div class="col-md-6 d-flex justify-content-end"><button type="button" href=""
                                class=" btn btn-primary" data-toggle="modal" data-target="#add_criteria_modal">
                                + Tambah Kriteria
                            </button> </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th>Kode Kriteria</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot</th>
                                <th>Tipe</th>
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

<!-- Add Criteria Modal -->
<div class="modal fade" id="add_criteria_modal" tabindex="-1" role="dialog" aria-labelledby="modal_add_criteriaLabel"
    aria-hidden="true" data-toggle="modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_add_criteriaLabel">Title</h5>
                <button type="button" class="" aria-label="Close" data-dismiss='modal'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="errorAdd"></div>
                <div class="form-group mb-3">
                    <input type="hidden" id="id_edas" value="">
                    <label for="name">Nama Kriteria</label>
                    <input type="text" class="name form-control" id="name" value="{{ old('name') }}" required>
                    <label for="weight">Bobot</label>
                    <input type="number" class="weight form-control" id="weight" value="{{ old('weight') }}" required>
                    <label for="type">Type</label>
                    <select class="form-control" id="type" required>
                        <option value="" selected hidden disabled>Benefit/Cost</option>
                        <option value="1">Benefit</option>
                        <option value="0">Cost</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-target="modal" data-dismiss="modal"
                    onclick="closeModal('add_criteria_modal')">Close</button>
                <button type="button" class="btn btn-primary add_criteria">Save</button>
            </div>
        </div>
    </div>
</div>
<!--End- Add Criteria Modal -->

<!-- Delete Criteria Modal -->
<div class="modal fade" id="modal_delete_criteria" tabindex="-1" role="dialog"
    aria-labelledby="modal_delete_criteriaLabel" aria-hidden="true" data-toggle="modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_delete_criteriaLabel">Title</h5>
                <button type="button" class="close" aria-label="Close" data-dismiss="modal"
                    onclick="closeModal('modal_delete_criteria')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="delete_id">
                <h2>WARNING</h2>
                <h3>Are you sure to delete everything inside this Criteria!!!</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal"
                    onclick="closeModal('modal_delete_criteria')">Close</button>
                <button type="button" class="btn btn-primary proceed_delete_criteria">Yes, delete</button>
            </div>
        </div>
    </div>
</div>
<!--End- Delete Criteria Modal -->

<!-- Edit Criteria Modal -->
<div class="modal fade" id="modal_edit_criteria" tabindex="-1" role="dialog" aria-labelledby="modal_edit_criteriaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_edit_criteriaLabel">Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    onclick="closeModal('modal_edit_criteria')">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="errorEdit"></div>
                <div class="form-group mb-3">
                    <input type="hidden" id="id_edit">
                    <input type="hidden" id="id_edas_edit">
                    <label for="name">Nama Kriteria</label>
                    <input type="text" class="name form-control" id="name_edit" value="{{ old('name') }}" required>
                    <label for="weight">Bobot</label>
                    <input type="number" class="weight form-control" id="weight_edit" value="{{ old('weight') }}"
                        required>
                    <label for="type">Type</label>
                    <select class="form-control" id="type_edit" required>
                        <option value="1">Benefit</option>
                        <option value="0">Cost</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    onclick="closeModal('modal_edit_criteria')">Close</button>
                <button type="button" class="btn btn-primary update_criteria">Update</button>
            </div>
        </div>
    </div>
</div>
<!--End- Edit Criteria Modal -->

@endsection

@section('js')
<script>
    var id_edas = @json($edas->id);
    var criterias = @json($criterias);

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

        $('#id_edas').val(id_edas);

        if (criterias.length==0) {
                    $('tbody').append(`
                    <tr>
                        <td colspan="5" class="text-center"> No Criteria tracked. Try creating one.</td>
                    </tr>`);
        } else {
            $.each(criterias, function(foo, bar) {
                $('tbody').append(`
                    <tr>
                        <td> C` + (foo+1) + `</td>
                        <td>` + bar.name + `</td>
                        <td>` + bar.weight + `</td>
                        <td> {{` + bar.type + ` ? 'Benefit' : 'Cost' }} </td>
                        <td>
                                <button type="button" class="subcriteria btn btn-secondary btn-sm" value="` + 
                            bar.id + `">Subcriteria</button>
                                <button type="button" class="edit_criteria btn btn-primary btn-sm" value="` +
                            bar.id + `">Edit</button>
                                <button type="button" class="delete_criteria btn btn-danger btn-sm" value="` +
                            bar.id + `">Delete</button>
                        </td>
                    </tr>`);
            })
        }
    });

    function fetch() {
        $.ajax({
            type: "GET",
            url: "/dashboard/criteria/data/"+ id_edas,
            dataType: "json",
            success: function(data) {
                $('#errorAdd').html("");
                $('#errorEdit').html("");
                $('#modal_add_criteriaLabel').html('Add Criteria');
                $('tbody').html("");
                if (data.criterias.length==0) {
                    $('tbody').append(`
                        <tr>
                            <td colspan="5" class="text-center"> No Criteria tracked. Try creating one.</td>
                        </tr>`);
                } else {
                    $.each(data.criterias, function(foo, bar) {
                        $('tbody').append(`
                            <tr>
                                <td> C` + (foo+1) + `</td>
                                <td>` + bar.name + `</td>
                                <td>` + bar.weight + `</td>
                                <td> {{` + bar.type + ` ? 'Benefit' : 'Cost' }} </td>
                                <td>
                                        <button type="button" class="subcriteria btn btn-secondary btn-sm" value="` + 
                                    bar.id + `">Subcriteria</button>
                                        <button type="button" class="edit_criteria btn btn-primary btn-sm" value="` +
                                    bar.id + `">Edit</button>
                                        <button type="button" class="delete_criteria btn btn-danger btn-sm" value="` +
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


    $(document).on('click', '.add_criteria', function(e) {
                e.preventDefault();
                var criteria = {
                    'id_edas': $('#id_edas').val(),
                    'code': $('#code').val(),
                    'name': $('#name').val(),
                    'weight': $('#weight').val(),
                    'type': $('#type').val(),
                };

                $.ajax({
                    type: "POST",
                    url: "{{ route('dashboard.criteria.store') }}",
                    data: criteria,
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            $('#success').addClass('alert alert-success');
                            $('#success').text(response.message);
                            fetch();
                            $('#add_criteria_modal').modal('hide');
                        } else {
                            $('#errorAdd').addClass('alert alert-danger');
                            $('#errorAdd').text(response.error);
                        }
                    }
                });
            });
            
    $(document).on('click', '.delete_criteria', function(e) {
        e.preventDefault();
        let id_criteria = $(this).val();
        $('#delete_id').val(id_criteria);
        $('#modal_delete_criteriaLabel').text('Delete Warning!!!');
        $('#modal_delete_criteria').modal('show');
    });

    $(document).on('click', '.proceed_delete_criteria', function(e) {
                e.preventDefault();
                let id_criteria = $('#delete_id').val();

                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/criteria/' + id_criteria,
                    success: function(res) {
                        if (res.status) {
                            $('#success').html("");
                            $('#success').addClass('alert alert-success');
                            $('#success').text(res.message);
                            fetch();
                            $('#modal_delete_criteria').modal('hide');
                        } else {
                            $('#success').html("");
                            $('#success').addClass('alert alert-danger');
                            $('#success').text(res.error);
                            $('#modal_delete_criteria').modal('hide');
                        }
                    }
                });
            });
            
            $(document).on('click', '.edit_criteria', function(e) {
                e.preventDefault();
                let id_criteria = $(this).val();
                $("#modal_edit_criteriaLabel").html('Edit Criteria');
                $('#modal_edit_criteria').modal('show');
                let editUrl = "/dashboard/criteria/" + id_criteria + "/edit";
                $.ajax({
                    type: "GET",
                    url: editUrl,
                    success: function(response) {
                        if (response.status) {
                            $('#id_edit').val(response.criteria.id);
                            $('#id_edas_edit').val(response.criteria.id_edas);
                            $('#name_edit').val(response.criteria.name);
                            $('#weight_edit').val(response.criteria.weight);
                            $('#type_edit').val(response.criteria.type);
                        } else {
                            $('#success').html('');
                            $('#success').addClass('alert alert-danger');
                            $('#success').text(response.error);
                        }
                    }
                });
            });

            $(document).on('click', '.update_criteria', function(e) {
                e.preventDefault();

                let id_criteria = $("#id_edit").val();

                let data = {
                    'id' : $('#id_edit').val(),
                    'id_edas': $('#id_edas_edit').val(),
                    'name': $('#name_edit').val(),
                    'weight': $('#weight_edit').val(),
                    'type': $('#type_edit').val(),
                };

                $.ajax({
                    type: 'PUT',
                    url: '/dashboard/criteria/' + id_criteria,
                    data: data,
                    dataType: 'json',
                    success: function(res) {
                        if (res.status) {
                            $('#success').html('');
                            $('#success').addClass('alert alert-success');
                            $('#success').text(res.message);
                            $('#modal_edit_criteria').modal('hide');
                            fetch();
                        } else {
                            $('#errorEdit').html('');
                            $('#errorEdit').addClass('alert alert-danger');
                            $('#errorEdit').text(res.error);
                        }
                    }
                });
            });

            $(document).on('click', '.subcriteria', function(e) {
                e.preventDefault();
                let id_criteria = $(this).val();
                window.location.href = "/dashboard/subcriteria/" + id_criteria;
            });
        });
</script>
@endsection
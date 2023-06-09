@extends('welcome')

@section('title')
<h1>
    Escuela de Fomración Cristiana - EFC /
    <small>Cambios en el curso</small>
</h1>
@endsection

@section('content')
<div class="card text-white col-lg-12" style="padding: 0px">
    @csrf
    <div class="card-header bg-primary">
        Configuración de Curso
        <div class="pull-right">
            <a href="" type="button" class="btn btn-sm btn-primary"><i class="fa fa-book"></i> Nuevo Curso</a>
            <a href="" type="button" class="btn btn-sm btn-primary"><i class="fa fa-user"></i> Alumnos</a>
        </div>
    </div>
    <div class="card-body text-black">
        <form id="adminSchool">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xs-6">
                    <div class="text-center">
                        <h4>Datos del Alumno</h4>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="run">RUN</label>
                            <input type="text" class="form-control" maxlength="12" id="run" name="run" value="{{ $usr->rut ?? null }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="first_name">Nombre</label>
                            <input type="text" class="form-control" maxlength="150" id="first_name" name="first_name" value="{{ $usr->first_name ?? null }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="last_name">Apellido</label>
                            <input type="text" class="form-control" maxlength="150" id="last_name" name="last_name" value="{{ $usr->last_name ?? null }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xs-6">
                    <div class="text-center">
                        <h4>Listado de Alumnos</h4>
                    </div>
                    <br>
                    <table id="table-list-studients" class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Edad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="text-center">
                                    <h6><span class="fa fa-spin"><i class="fa fa-spinner"></i></span> Cargando Estudiantes...</h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {});

    function init() {
        showChargePageLoad(true);
        $.ajax({
            url: 'user-admin/data',
            type: 'POST',
            success: function(json) {
                var data = JSON.parse(json);
                var HTML = "";
                $.each(data.data, function(i, row) {
                    console.log(row);
                    HTML += `<tr>
                                <td class='text-center'>${row.rut}</td>
                                <td class='text-center'>${row.name}</td>
                                <td class='text-center'>${row.phone}</td>
                                <td class='text-center'>
                                    <a href="${ urlCreateEditUser }/${row.id}" class='btn btn-info btn-sm btn-edit-user' data-user='${row.id}'><i class='fa fa-edit'></i></a>
                                    <a class='btn btn-danger btn-sm btn-remove-user' data-user='${row.id}'><i class='fa fa-trash'></i></a>
                                </td>
                            </tr>`;
                });
                if (HTML !== "" && $.fn.DataTable.isDataTable('#table-list-user')) {
                    $('#table-list-user').DataTable().destroy();
                }
                $('#table-list-user tbody').html(HTML);
                initDataTable();
            },
            error: function(xhr, status) {
                alert('Disculpe las molestias, existió un problema');
            },
            complete: function(jqXHR, textStatus) {
                showChargePageLoad();
            }
        });
    }
</script>
@endsection
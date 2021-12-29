@extends('welcome')

@section('title')
<h1>
    Escuela de Fomración Cristiana - EFC /
    <small>Listado de Cursos</small>
</h1>
@endsection

@section('content')
<div class="card text-white col-lg-12" style="padding: 0px">
    @csrf
    <div class="card-header bg-primary">
        Cursos Dictados
        <div class="pull-right">
            <a href="{{ route('adminUserCreated') }}" type="button" class="btn btn-sm btn-primary"><i class="fa fa-book"></i> Nuevo Curso</a>
            <a href="{{ route('adminUserCreated') }}" type="button" class="btn btn-sm btn-primary"><i class="fa fa-user"></i> Alumnos</a>
        </div>
    </div>
    <div class="card-body text-black">
        <table id="table-list-user" class="table">
            <thead>
                <tr>
                    <th class='text-center'>Nivel</th>
                    <th class='text-center'>Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script>
    var urlCreateEditUser = `{{ route('adminUserCreated') }}`;
    var urlDelete = `{{ route('adminUserRemove') }}`;

    $(document).ready(function() {
        // init();
    });

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
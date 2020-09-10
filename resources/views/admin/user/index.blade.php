@extends('welcome')

@section('title')
    <h1>
        Administrador de Usuarios /
        <small>Listado de Usuarios</small>
    </h1>
@endsection

@section('content')
<div class="card text-white col-lg-12" style="padding: 0px">
    @csrf
    <div class="card-header bg-primary">
        Administrador de Usuarios
        <div class="pull-right">
            <a href="{{ route('adminUserCreated') }}" type="button" class="btn btn-sm btn-primary"><i class="fa fa-user"></i> Nuevo Usuario</a>
        </div>
    </div>
    <div class="card-body text-black">
        <table id="table-list-user" class="table display DataTables">
            <thead>
                <tr>
                    <th class='text-center'>Rut</th>
                    <th class='text-center'>Nombre</th>
                    <th class='text-center'>Celular</th>
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
    $(document).ready(function () {
        initDataTable();
        init();
    });

    function init () {
        $.ajax({
            url : 'user-admin/data',
            type : 'POST',
            success : function(json) {
                var data = JSON.parse(json);
                var HTML = "";
                $.each(data.data, function (i, row) {
                    var route = '{{ route('adminUserCreated') }}';
                    console.log(route);
                    HTML = `<tr>
                                <td class='text-center'>${row.rut}</td>
                                <td class='text-center'>${row.first_name} ${row.last_name}</td>
                                <td class='text-center'>${row.phone}</td>
                                <td class='text-center'>
                                    <a href="${ route }" class='btn btn-info btn-sm' data-user='${row.id}'><i class='fa fa-edit'></i></a>
                                    <a href="${ route }" class='btn btn-danger btn-sm' data-user='${row.id}'><i class='fa fa-trash'></i></a>
                                </td>
                            </tr>`;
                });
                if(HTML !== "" && $.fn.DataTable.isDataTable('#table-list-user')) {
                    $('#table-list-user').DataTable().destroy();
                }
                $('#table-list-user tbody').html(HTML);
                initDataTable();
            },
            error : function(xhr, status) {
                alert('Disculpe las molestias, existió un problema');
            }
        });
    }

    function initDataTable() {
        $('#table-list-user').DataTable({
            "language": getLenguajeByDataTable({"name" : "Usuarios"})
        });
    }

</script>
@endsection
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Booked Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="mt-4 text-xl text-center text-gray-800 font-semibold">Listado de Citas</h2>
                <div class="col-12">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nombres</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Tipo de Servicio</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Empleado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lecitas as $agenda)
                                <tr>
                                    <td>{{ $agenda->nombres }}</td>
                                    <td>{{ $agenda->correo }}</td>
                                    <td>{{ $agenda->telefono }}</td>
                                    <td>{{ $agenda->tiposervicio }}</td>
                                    <td>{{ $agenda->fecha }}</td>
                                    <td>{{ $agenda->empleado->nombres ?? 'N/A' }}</td>
                                    <td>
                                        <a href="" class="btn btn-success editar-btn">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                        <a onclick="confirmDelete('{{ route('deleteCita.destroy', $agenda->id) }}')" class="btn btn-danger eliminar-btn">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Scripts jQuery y DataTables -->
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>

<script>
    function confirmDelete(deleteUrl) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.createElement('form');
                form.action = deleteUrl;
                form.method = 'POST';

                var csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                var methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

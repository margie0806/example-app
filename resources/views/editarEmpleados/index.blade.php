<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container" style="margin: 5px; font-family: Arial, sans-serif; background-color: #ffff; padding: 70px; border-radius: 10px;">
                    @if ($errors->any())
                        <div class="alert alert-danger" style="margin-bottom: 20px; padding: 10px; border-radius: 5px; background-color: #f8d7da; color: #721c24;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <script>
                            Swal.fire({
                                title: 'Éxito',
                                text: '{{ session('success') }}',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        </script>
                    @endif

                    <form class="needs-validation" method="post" action="{{ route('updatempleado.update', $empleado->id) }}">
                        @method('PUT')
                        @csrf

                        <!-- Campos del formulario del empleado -->
                        <div class="row" style="margin-bottom: 0px;">
                            <div class="col-2" style="margin-bottom: 5px; margin: 15px;">
                                <label for="identificacion" style="font-weight: bold;">Identificación</label>
                                <input type="text" id="identificacion" placeholder="Identificación" name="identificacion" value="{{ $empleado->identificacion }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; margin-top: 5px;">
                                @error('identificacion')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px; display: flex; justify-content: space-between;">
                            <div class="col-2" style="width: 48%; margin-bottom: 5px; margin: 15px;">
                                <label for="nombres" style="font-weight: bold;">Nombres</label>
                                <input type="text" id="nombres" placeholder="Nombre" name="nombres" value="{{ $empleado->nombres }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; margin-top: 5px;">
                                @error('nombres')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-2" style="width: 48%; margin-bottom: 5px; margin: 15px;">
                                <label for="apellidos" style="font-weight: bold;">Apellidos</label>
                                <input type="text" id="apellidos" placeholder="Apellido" name="apellidos" value="{{ $empleado->apellidos }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; margin-top: 5px;">
                                @error('apellidos')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px;">
                            <div class="col-2" style="margin-bottom: 5px; margin: 15px;">
                                <label for="correo" style="font-weight: bold;">Correo</label>
                                <input type="email" id="correo" placeholder="Correo" name="correo" value="{{ $empleado->correo }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; margin-top: 5px;">
                                @error('correo')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px; display: flex; justify-content: space-between;">
                            <div class="col-2" style="width: 48%; margin-bottom: 5px; margin: 15px;">
                                <label for="direccion" style="font-weight: bold;">Dirección</label>
                                <input type="text" id="direccion" placeholder="Dirección" name="direccion" value="{{ $empleado->direccion }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; margin-top: 5px;">
                                @error('direccion')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-2" style="width: 48%; margin-bottom: 5px; margin: 15px;">
                                <label for="telefono" style="font-weight: bold;">Teléfono</label>
                                <input type="text" id="telefono" placeholder="Teléfono" name="telefono" value="{{ $empleado->telefono }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; margin-top: 5px;">
                                @error('telefono')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px;">
                            <div class="col-2" style="margin-bottom: 5px; margin: 15px;">
                                <label for="tipocontrato" style="font-weight: bold;">Tipo de Contrato</label>
                                <select class="form-select" name="tipocontrato" aria-label="Default select example">
                                    <option value="temporal" {{ $empleado->tipocontrato == 'temporal' ? 'selected' : '' }}>Temporal</option>
                                    <option value="indefinido" {{ $empleado->tipocontrato == 'indefinido' ? 'selected' : '' }}>Indefinido</option>
                                    <option value="tiempo_completo" {{ $empleado->tipocontrato == 'tiempo_completo' ? 'selected' : '' }}>Tiempo Completo</option>
                                    <option value="medio_tiempo" {{ $empleado->tipocontrato == 'medio_tiempo' ? 'selected' : '' }}>Medio Tiempo</option>
                                    <option value="por_horas" {{ $empleado->tipocontrato == 'por_horas' ? 'selected' : '' }}>Por Horas</option>
                                </select>   
                                @error('tipocontrato')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-2" style="width: 48%; margin-bottom: 5px; margin: 15px;">
                                <label for="datesemana" style="font-weight: bold;">Fecha de Registro</label>
                                <input type="datetime-local" id="datesemana" name="datesemana" value="{{ $empleado->datesemana }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; margin-top: 5px;">
                                @error('datesemana')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                           <div class="container mt-5">
                            <div id='calendar'></div>

                            <!-- Modal para modificar fecha y hora -->
                            <div class="modal" id="editEventModal" data-animation="slideInOut">
                                <div class="modal-dialog">
                                    <header class="modal-header">
                                        <h5>Modificar Fecha y Hora  <button class="close-modal" aria-label="close modal" data-close>
                                            ✕  
                                        </button></h5>
                                        
                                    </header>
                                    <section class="modal-content">
                                        <label for="modalDate">Fecha:</label>
                                        <input type="date" id="modalDate" class="form-control" required>
                                        <br>
                                        <br>
                                        <label for="modalTime">Hora:</label>
                                        <input type="time" id="modalTime" class="form-control" required>
                                    </section>
                                    <footer class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-close>Cancelar</button>
                                        <button type="button" class="btn btn-primary" id="saveChanges">Guardar</button>
                                        <button type="button" class="btn btn-danger" id="deleteEvent">Eliminar cita</button>
                                    </footer>
                                </div>
                            </div>

                            <!-- Campos ocultos para almacenar la fecha y hora -->
                            <input type="hidden" id="fechaSeleccionada" name="fecha" value="{{ $empleado->datesemana }}">
                            <input type="hidden" id="horaSeleccionada" name="hora" value="">
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-2">
                                <button type="submit" class="mt-2 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                    Actualizar Datos
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const openEls = document.querySelectorAll("[data-open]");
    const closeEls = document.querySelectorAll("[data-close]");
    const isVisible = "is-visible";

    for (const el of openEls) {
        el.addEventListener("click", function() {
            const modalId = this.dataset.open;
            document.getElementById(modalId).classList.add(isVisible);
        });
    }

    for (const el of closeEls) {
        el.addEventListener("click", function() {
            this.closest('.modal').classList.remove(isVisible);
        });
    }

    document.addEventListener("click", e => {
        if (e.target.classList.contains("modal") && e.target.classList.contains("is-visible")) {
            e.target.classList.remove(isVisible);
        }
    });

    document.addEventListener("keyup", e => {
        if (e.key === "Escape" && document.querySelector(".modal.is-visible")) {
            document.querySelector(".modal.is-visible").classList.remove(isVisible);
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                {
                    title: 'Cita Agendada',
                    start: '{{ $empleado->datesemana }}',
                    allDay: true
                }
            ],
            dateClick: function(info) {
                const selectedDate = info.dateStr;
                document.getElementById('modalDate').value = selectedDate;
                document.getElementById('editEventModal').classList.add(isVisible);
            }
        });

        calendar.render();

        document.getElementById('saveChanges').addEventListener('click', function() {
            const newDate = document.getElementById('modalDate').value;
            const newTime = document.getElementById('modalTime').value;
            const combinedDateTime = `${newDate}T${newTime}`;

            document.getElementById('datesemana').value = combinedDateTime;

            // Limpiar eventos anteriores
            calendar.getEvents().forEach(event => {
                if (event.title === 'Cita Agendada') {
                    event.remove();
                }
            });

            // Agregar el nuevo evento
            calendar.addEvent({
                title: 'Cita Agendada',
                start: combinedDateTime,
                allDay: true
            });

            document.getElementById('editEventModal').classList.remove(isVisible);
        });

        document.getElementById('deleteEvent').addEventListener('click', function() {
            calendar.getEvents().forEach(event => {
                if (event.title === 'Cita Agendada') {
                    event.remove();
                }
            });

            document.getElementById('fechaSeleccionada').value = '';
            document.getElementById('horaSeleccionada').value = '';
            document.getElementById('datesemana').value = '';

            document.getElementById('editEventModal').classList.remove(isVisible);
        });
    });
</script>

<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'></script>












































































































































































<style>
    /* Estilos para el calendario */
    #calendar {
        margin: 40px auto;
    }

    /* Estilos para el modal */
    .modal {
        z-index: 20000;
        display: none;
        background-color: rgba(0, 0, 0, 0.5);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        justify-content: center;
        align-items: center;
    }

    .modal.is-visible {
        display: flex;
    }

    .modal-dialog {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        width: 400px; /* Ancho ajustado del modal */
    }

    .close-modal {
        background: none;
        border: none;
        font-size: 1.5rem;
        
    }

    .modal-header h5 {
        margin: 0;
        font-weight: bold;
        margin-right: 20px;
    }

    .modal-footer {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .modal-footer .btn {
        flex: 1;
        margin: 0 5px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }
</style>




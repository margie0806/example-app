<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                text: "{{ session('success') }}", // Use double quotes for JavaScript
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        </script>
                    @endif

                    <form action="{{ route('agendacita.store') }}" method="POST">
                        @csrf

                         <!-- Nombres -->      
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="nombres" class="form-label">Nombres Completos</label>
                                <input type="text" id="nombres" placeholder="Nombre" name="nombres" value="{{ old('nombres') }}" class="form-input-nombre w-full p-2 border rounded" required>
                                @error('nombres')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Correo -->
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" id="correo" placeholder="Correo" name="correo" value="{{ old('correo') }}" class="form-input w-full p-2 border rounded" required>
                                @error('correo')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                              <!-- Teléfono -->
                            <div class="col-2 form-group">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" id="telefono" placeholder="Teléfono" name="telefono" value="{{ old('telefono') }}" class="form-input w-full p-2 border rounded" required>
                                @error('telefono')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                         <!-- Tipo de Servicio -->
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="tiposervicio" class="form-label">Tipo Servicio</label>
                                <select id="tiposervicio" name="tiposervicio" class="form-select w-full p-2 border rounded" required>
                                    <option value="">Seleccione un Servicio</option>
                                    <option value="Facial" {{ old('tiposervicio') == 'Facial' ? 'selected' : '' }}>Facial</option>
                                    <option value="Barba" {{ old('tiposervicio') == 'Barba' ? 'selected' : '' }}>Barba</option>
                                    <option value="Acondicionar" {{ old('tiposervicio') == 'Acondicionar' ? 'selected' : '' }}>Acondicionar</option>
                                    <option value="Alisar" {{ old('tiposervicio') == 'Alisar' ? 'selected' : '' }}>Alisar</option>
                                </select>
                                @error('tiposervicio')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                             <!-- Empleado -->
                            <div class="col-2 form-group">
                                <label for="empleado" class="form-label">Empleado</label>
                                <select id="empleado_id" name="empleado_id" class="form-select w-full p-2 border rounded" required>
                                    <option value="" disabled selected>Seleccione un Empleado</option>
                                    @foreach ($lempleado as $empleado)
                                        <option value="{{ $empleado->id }}">{{ $empleado->nombres }}</option>
                                    @endforeach
                                </select>
                                @error('empleado_id')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                             <!-- Fecha Disponible -->
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="fecha" class="form-label">Fecha y Hora de Cita</label>
                                <input type="datetime-local" id="fecha" name="fecha" value="{{ old('fecha') }}" class="form-input w-full p-2 border rounded" required>
                                <div id="mensaje-error" class="error-message"></div>
                                @error('fecha')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="justify">
                            <div class="tooltip">
                                <span class="color-disponible"></span>
                                <span class="tooltip-text">fechas disponibles para reservar</span>
                            </div>
                            <h3>Fechas Disponibles</h3>
                            <ul id="fechas-disponibles"></ul>
                        </div>

                        <div class="justify">
                            <h2>Empleado </h2>
                            <div id="empleado-nombre"></div>
                        </div>

                        <div id="mensaje-error" style="color: red;"></div>
                        
                        <div class="container mt-5">
                            <div id='calendar'></div>
                            <ul id="eventos-exteriores" style="list-style-type: none; padding: 0;">
                                <!-- Aquí se agregarán los eventos externos -->
                            </ul>
                        </div> <!-- Botón de Guardar -->
                        <div class="row" style="text-align: center;">
                            <button type="submit" style="background-color: #e75b72; color: white; padding: 15px 100px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin-top: 20px; border-radius: 5px; border: none; cursor: pointer;">
                                Agendar cita 
                        </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css' rel='stylesheet' />
<link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css" />
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        let fechasDisponibles = [];

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            selectable: true,
            events: [],
            select: function(info) {
                const selectedDate = info.startStr.split("T")[0];
                const selectedTime = info.startStr.split("T")[1].substring(0, 5);
                const datetimeLocalFormat = `${selectedDate}T${selectedTime}`;
                
                // Asignar al input
                document.getElementById('fecha').value = datetimeLocalFormat; 

                // Obtener la hora seleccionada
                const horaSeleccionada = parseInt(selectedTime.split(':')[0], 10); // Obtener la hora en formato 24 horas

                // Validar que la hora esté entre 7 AM y 7 PM
                if (horaSeleccionada < 7 || horaSeleccionada > 19) {
                    document.getElementById('mensaje-error').innerHTML = "Error: Las citas solo pueden asignarse entre las 7:00 AM y las 7:00 PM.";
                    document.getElementById('mensaje-error').style.color = "red";
                    calendar.unselect(); // Desmarcar la selección
                    return; // Salir de la función
                }

                if (fechasDisponibles.includes(selectedDate)) {
                    document.getElementById('mensaje-error').innerHTML = "La cita ha sido asignada exitosamente.";
                    document.getElementById('mensaje-error').style.color = "green";

                    // Limpiar eventos anteriores
                    calendar.removeAllEvents();

                    // Agregar el nuevo evento
                    calendar.addEvent({
                        title: `Cita: ${selectedDate} a las ${selectedTime}`,
                        start: info.start,
                        end: info.end,
                        classNames: ['selected-event']
                    });

                    // Mover el calendario a la fecha del evento y ajustar el scrollTime
                    calendar.gotoDate(info.start); 
                    calendar.scrollToTime(selectedTime); 
                } else {
                    document.getElementById('mensaje-error').innerHTML = "Error: La fecha seleccionada no está disponible.";
                    document.getElementById('mensaje-error').style.color = "red";
                }

                calendar.unselect(); // Desmarcar la selección
            },
            eventDidMount: function(info) {
                // Obtener la fecha y hora en un formato legible
                const fecha = info.event.start.toLocaleDateString('es-CO', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                const horaInicio = info.event.start.toLocaleTimeString('es-CO', { hour: '2-digit', minute: '2-digit' });
                const horaFin = info.event.end.toLocaleTimeString('es-CO', { hour: '2-digit', minute: '2-digit' });
                
                tippy(info.el, {
                    content: `${info.event.title} : ${fecha} de ${horaInicio} a ${horaFin}`,
                    placement: 'top',
                    arrow: true
                });
            }
        });

        calendar.render();

        // Obtener fechas del empleado
        function obtenerFechaEmpleado(empleadoId) {
            if (empleadoId) {
                fetch(`/empleado/${empleadoId}/fechas`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la red');
                        }
                        return response.json();
                    })
                    .then(data => {
                        fechasDisponibles = data.datesemana;
                        const fechasDisponiblesList = document.getElementById('fechas-disponibles');
                        fechasDisponiblesList.innerHTML = '';

                        // Limpiar eventos del calendario
                        calendar.removeAllEvents();

                        const fragment = document.createDocumentFragment();
                        if (Array.isArray(data.datesemana)) {
                            data.datesemana.forEach(fecha => {
                                const li = document.createElement('li');
                                li.textContent = `${new Date(fecha).toLocaleDateString('es-CO', { weekday: 'long' })} ${fecha}`;
                                fragment.appendChild(li);

                                calendar.addEvent({
                                    title: 'Disponible',
                                    start: fecha,
                                    end: new Date(new Date(fecha).getTime() + 3600000),
                                    classNames: ['available-date']
                                });
                            });

                            // Mover el calendario a la primera fecha disponible
                            const primeraFecha = new Date(data.datesemana[0]);
                            calendar.gotoDate(primeraFecha); 
                        } else {
                            const li = document.createElement('li');
                            li.textContent = `${new Date(data.datesemana).toLocaleDateString('es-CO', { weekday: 'long' })} ${data.datesemana}`;
                            fragment.appendChild(li);

                            calendar.addEvent({
                                title: 'Disponible',
                                start: data.datesemana,
                                end: new Date(new Date(data.datesemana).getTime() + 3600000),
                                classNames: ['available-date']
                            });

                            calendar.gotoDate(new Date(data.datesemana));
                        }

                        fechasDisponiblesList.appendChild(fragment);
                        document.getElementById('empleado-nombre').innerHTML = `${data.nombres} ${data.apellidos}`;

                        // Limpiar el campo de fecha al cambiar de empleado
                        document.getElementById('fecha').value = '';
                        document.getElementById('mensaje-error').innerHTML = '';
                    })
                    .catch(error => {
                        console.error('Error al obtener los datos del empleado:', error);
                        document.getElementById('mensaje-error').innerHTML = "Error al cargar las fechas disponibles.";
                        document.getElementById('mensaje-error').style.color = "red";
                    });
            } else {
                document.getElementById('fechas-disponibles').innerHTML = '';
                document.getElementById('empleado-nombre').innerHTML = '';
                calendar.removeAllEvents();
                document.getElementById('fecha').value = '';
                document.getElementById('mensaje-error').innerHTML = '';
            }
        }

        // Cambio de empleado
        document.getElementById('empleado_id').addEventListener('change', function(event) {
            const empleadoId = event.target.value;
            obtenerFechaEmpleado(empleadoId);
        });
    });
</script>








































































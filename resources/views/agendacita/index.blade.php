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
                  
                   

                    <form method="post" action="{{ route('empleado.store') }}">
                       
                        @csrf
                        
                        
                       

                    <div class="row">
                        <div class="col-2 form-group">
                            <label for="nombres" class="form-label">Nombres Completos</label>
                            <input type="text" id="nombres" placeholder="Nombre" name="nombres" value="{{ old('nombres') }}" class="form-input-nombre">
                            @error('nombres')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Alineación de Correo y Teléfono lado a lado -->
                    <div class="row">
                        <div class="col-2 form-group">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" id="correo" placeholder="Correo" name="correo" value="{{ old('correo') }}" class="form-input">
                            @error('correo')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-2 form-group">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" id="telefono" placeholder="Teléfono" name="telefono" value="{{ old('telefono') }}" class="form-input">
                            @error('telefono')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2 form-group">
                            <label for="tipocontrato" class="form-label">Tipo Servicio</label>
                            <select id="tipocontrato" name="tipocontrato" class="form-select">
                                <option value="">Facial</option>
                                <option value="Facial">Facial</option>
                                <option value="Barba">Barba</option>
                                <option value="Acondicionar">Acondicionar</option>
                                <option value="Alisar">Alisar</option>
                                <option value="por_horas">Por Horas</option>
                            </select>
                            @error('tipocontrato')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-2 form-group">
                            <label for="empleadosAsignado" class="form-label">Empleados</label>
                            <select id="empleadosAsignado" name="empleadosAsignado" class="form-select">
                                <option value=""></option>
                                <!-- Agrega opciones aquí -->
                            </select>
                            @error('empleadosAsignado')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2 form-group">
                            <label for="datesemana" class="form-label">Fecha de Registro</label>
                            <input type="datetime-local" id="datesemana" name="datesemana" value="{{ old('datesemana') }}" class="form-input">
                            @error('datesemana')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                        <div class="container mt-5">
                            <div id='calendar'></div>

                            <!-- Modal para modificar fecha y hora -->
                            <div class="modal" id="editEventModal" data-animation="slideInOut">
                                <div class="modal-dialog">
                                    <header class="modal-header">
                                        <h5>Asigna tus Citas: Hora y Fecha   <button class="close-modal" aria-label="close modal" data-close>
                                            ✕  
                                        </button></h5>
                                        
                                    </header>
                                    <hr class="modal-header-hr">
                                    <section class="modal-content">
                                        <label  for="modalDate" class="label-con">Fecha:</label>
                                        <br>
                                        <input type="date" id="modalDate" class="form-control" required>
                                        <br>
                                        <label  for="modalTime" class="label-con" >Hora:</label>
                                        <br>
                                        <input type="time" id="modalTime" class="form-control" required>
                                    </section>
                                    <hr class="hr-footer">
                                    <footer class="modal-footer">
                                        
                                        <button type="button" class="btn btn-secondary" data-close>Cancelar</button>
                                        <button type="button" class="btn btn-primary" id="saveChanges">Guardar</button>
                                        <button type="button" class="btn btn-danger" id="deleteEvent">Eliminar cita</button>
                                    </footer>
                                </div>
                            </div>

                           
                            <!-- Campos ocultos para almacenar la fecha y hora -->
                            <input type="hidden" id="fechaSeleccionada" name="fecha" value="">
                            <input type="hidden" id="horaSeleccionada" name="hora" value="">
                            
                        </div>


                        <div class="row" style="margin-top: 20px;">
                            <div class="col-2" style="margin-bottom: 5px; margin: 15px;">
                                <button type="submit" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; background-color: #000000; color: #fff; cursor: pointer;">Guardar</button>
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
            initialView: 'dayGridMonth', // Cambiado para mostrar la vista de mes inicialmente
            events: [], // Inicialmente vacío

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },

            dateClick: function(info) {
                const selectedDate = info.dateStr;
                document.getElementById('modalDate').value = selectedDate;
                document.getElementById('modalTime').value = ''; // Limpiar la hora
                document.getElementById('editEventModal').classList.add(isVisible);
            },

            eventClick: function(info) {
                const event = info.event;
                document.getElementById('modalDate').value = event.start.toISOString().split('T')[0]; // Solo la fecha
                document.getElementById('modalTime').value = event.start.toTimeString().substring(0, 5); // Formato HH:mm
                document.getElementById('editEventModal').classList.add(isVisible);
            }
        });

        calendar.render();

        document.getElementById('saveChanges').addEventListener('click', function() {
            const newDate = document.getElementById('modalDate').value;
            const newTime = document.getElementById('modalTime').value;

            if (!newTime) {
                alert("Por favor, selecciona una hora.");
                return; // Salir si no hay hora seleccionada
            }

            const combinedDateTime = `${newDate}T${newTime}`;

            // Limpiar eventos anteriores solo si no es el mismo
            const existingEvent = calendar.getEvents().find(event => event.title === 'Cita Agendada' && event.startStr === combinedDateTime);
            if (!existingEvent) {
                // Agregar el nuevo evento
                calendar.addEvent({
                    title: 'Cita Agendada',
                    start: combinedDateTime,
                    allDay: false // Cambia a false para manejar horas específicas
                });
            } else {
                alert("Ya existe una cita agendada en este horario.");
            }

            document.getElementById('editEventModal').classList.remove(isVisible);
        });

        document.getElementById('deleteEvent').addEventListener('click', function() {
            const eventToDelete = calendar.getEvents().find(event => event.title === 'Cita Agendada');
            if (eventToDelete) {
                eventToDelete.remove();
            }

            document.getElementById('modalDate').value = '';
            document.getElementById('modalTime').value = '';

            document.getElementById('editEventModal').classList.remove(isVisible);
        });
    });
</script>

<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'></script>


<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'></script>































































































































































































































<style>
    .form-group {
        margin: 15px 0;
    }
    
.form-input-nombre {
    width: 208%; 
    box-sizing: border-box; 
}


    .form-label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        color: #333;
    }
    
    .form-input, .form-select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        transition: border-color 0.3s;
    }
    
    .form-input:focus, .form-select:focus {
        border-color: #007bff; /* Cambia el color según tu preferencia */
        outline: none;
    }
    
    .error-message {
        color: red;
        font-size: 0.875em;
        margin-top: 5px;
    }
    
    .row {
        display: flex;
        flex-wrap: wrap; /* Permite que los elementos se ajusten en pantallas pequeñas */
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .col-2 {
        flex: 0 0 48%; /* Ajusta el ancho de las columnas */
        box-sizing: border-box; /* Incluye padding y borde en el ancho total */
    }






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

.form-control {
    border-radius: 5px;
    margin-left: 20px;
    margin-top:10px;
    margin-bottom: 10px; 
    width: 80%;
}



.modal-dialog {
      background-image: 
        linear-gradient(rgba(83, 78, 78, 0.534), rgba(65, 57, 57, 0.568)), 
        url('images/barberia.png');
     background-size: cover;
     background-repeat: no-repeat;
    padding: 15px;
    filter: brightness(1);
    
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 430px; /* Ancho ajustado del modal */
    height: 360px;
    display: flex; /* Cambiar a flex para controlar el espaciado */
    flex-direction: column; /* Organizar los elementos en columna */
    gap: 10px; /* Espacio uniforme entre elementos */
    box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.637);
 
}

.close-modal {
    background: none;
    border: none;
    font-size: 1.5rem;
    margin-left: 120px;
}

.close-modal:hover{
    color: #ff0019;
}

.modal-header-hr{
margin-bottom: 25px;
}

.modal-header h5 {
    margin: 0;
    font-weight: bold;
    margin-right: 20px;
    text-align: center;
    align-items: center;
    color: #fff;
    text-shadow: 1px 1px 10px rgba(2, 255, 234, 0.884);
}

.hr-footer{
margin-top: 20px;
}

.label-con{
    margin-left: 20px;
    color: #fff7f7;
    font-size: bold;
    font-weight: 700;
    text-shadow: 1px 1px 10px rgba(0, 255, 238, 0.959);
}

.modal-footer {
    display: flex;
    justify-content: space-between;
    
    gap: 10px; /* Espacio uniforme entre los botones */
}

.modal-footer .btn {
    flex: 1;
    margin: 0 5px; /* Asegúrate de que haya un margen uniforme */
}

.btn-primary {
    background-color: #007bff;
    border: 1px solid #4e4e4e;
    border-radius: 10px;
    color: white;
    padding: 5px; /* Añadir padding para aumentar el tamaño del botón */
    transition: background-color 0.3s, border-color 0.3s; /* Suaviza la transición */
}

.btn-primary:hover {
    background-color: #0056b3; /* Cambia el color de fondo al pasar el cursor */
    border-color: #003f7f; /* Cambia el color del borde al pasar el cursor */
     border-color: #00f7ff;
}

.btn-danger {
    background-color: #dc3545;
    border: 1px solid #4e4e4e;
    border-radius: 10px;
    color: white;
    padding: 5px; /* Asegúrate de que todos los botones tengan padding consistente */
    transition: background-color 0.3s, border-color 0.3s; /* Suaviza la transición */
    
}

.btn-danger:hover {
    background-color: #c82333; /* Cambia el color de fondo al pasar el cursor */
    border-color: #a71c1c; /* Cambia el color del borde al pasar el cursor */
     border-color: #00f7ff;
}

.btn-secondary {
    background-color: #6c757d;
    border: 1px solid #4e4e4e;
    border-radius: 10px;
    color: white;
    padding: 5px; /* Consistencia en el tamaño del botón */
    transition: background-color 0.3s, border-color 0.3s; /* Suaviza la transición */
}

.btn-secondary:hover {
    background-color: #5a6268; /* Cambia el color de fondo al pasar el cursor */
    border-color: #00f7ff; /* Cambia el color del borde al pasar el cursor */
}

</style>

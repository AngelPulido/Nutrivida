<!-- resources/views/dashboard/paciente/profile.blade.php -->
<x-layouts.app title="Gestión de Citas" metaDescription="Calendario de citas del nutriólogo">
  <div class="flex min-h-screen bg-gray-50">
    {{-- NAV IZQUIERDO --}}
    <aside class="w-64">
      <x-layouts.navNutriologo />
    </aside>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="flex-1 p-8 overflow-y-auto">
      <div class="max-w-7xl mx-auto">
        <div class="mb-6">
          <h1 class="text-2xl font-bold text-gray-800">Gestión de Citas</h1>
          <p class="text-green-600">Visualiza y gestiona tus citas programadas</p>
        </div>

        {{-- Calendario --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
          <div id="calendar" class="min-h-[600px]"></div>
        </div>

        {{-- Modal para detalles de cita --}}
        <div id="appointmentModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
          <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
              <!-- Título con nombre del paciente -->
              <div class="flex items-center justify-center mb-4">
                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-2">
                  <span class="text-green-600 font-medium">●</span>
                </div>
                <h3 id="modalTitle" class="text-lg leading-6 font-medium text-gray-900"></h3>
              </div>
              
              <!-- Fecha y Estado -->
              <div class="mt-2 px-7 py-3 space-y-2 text-left">
                <p id="modalDate" class="text-sm text-gray-500"></p>
                <p id="modalStatus" class="text-sm"></p>
              </div>
              

              <!-- Selector de Estado -->
              <div class="px-4 py-3">
                <select id="statusSelect" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                  <option value="pendiente">Pendiente</option>
                  <option value="aprobada">Aprobada</option>
                  <option value="rechazada">Rechazada</option>
                  <option value="reprogramada">Reprogramada</option>
                  <option value="completada">Completada</option>
                </select>
              </div>
              
              <!-- Botones -->
              <div class="items-center px-4 py-3 grid grid-cols-2 gap-4">
                <button id="saveBtn" class="px-4 py-2 bg-green-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                  Guardar Cambios
                </button>
                <button id="closeBtn" class="px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                  Cerrar
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <!-- FullCalendar CSS -->
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
  
  <!-- FullCalendar JS -->
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js'></script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const calendarEl = document.getElementById('calendar');
      const modal = document.getElementById('appointmentModal');
      let currentEventId = null;
      
      // Configurar calendario
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: function(fetchInfo, successCallback, failureCallback) {
          fetch('/dashboard/nutriologo/citas/data', {
            headers: {
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
          })
          .then(response => {
            if (!response.ok) {
              throw new Error('Error al obtener citas');
            }
            return response.json();
          })
          .then(data => successCallback(data))
          .catch(error => {
            console.error('Error:', error);
            failureCallback(error);
            showToast('error', 'Error al cargar citas');
          });
        },
        eventClick: function(info) {
          currentEventId = info.event.id;
          document.getElementById('modalTitle').textContent = info.event.title;
          
          // Formatear fecha legible
          const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
          };
          document.getElementById('modalDate').textContent = 
            'Fecha: ' + info.event.start.toLocaleDateString('es-ES', options);
            
          const statusElement = document.getElementById('modalStatus');
          statusElement.textContent = 'Estado: ' + info.event.extendedProps.status;
          statusElement.className = 'mt-2 text-sm font-medium ' + 
            (info.event.extendedProps.status === 'aprobada' ? 'text-green-600' : 
             info.event.extendedProps.status === 'rechazada' ? 'text-red-600' : 
             info.event.extendedProps.status === 'completada' ? 'text-green-600' : 'text-blue-600');
               
          document.getElementById('statusSelect').value = info.event.extendedProps.status;
          modal.classList.remove('hidden');
        }
      });
      
      calendar.render();
      
      // Manejar eventos del modal
      document.getElementById('closeBtn').addEventListener('click', function() {
        modal.classList.add('hidden');
      });
      
      document.getElementById('saveBtn').addEventListener('click', function() {
        const newStatus = document.getElementById('statusSelect').value;
        const saveBtn = document.getElementById('saveBtn');
        
        // Deshabilitar botón durante la petición
        saveBtn.disabled = true;
        saveBtn.innerHTML = 'Guardando...';
        
        fetch(`/dashboard/nutriologo/citas/${currentEventId}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            estado: newStatus
          })
        })
        .then(response => {
          if (!response.ok) {
            throw new Error(response.statusText);
          }
          return response.json();
        })
        .then(data => {
          showToast('success', data.message || 'Estado actualizado correctamente');
          
          // Actualizar el evento en el calendario
          const event = calendar.getEventById(currentEventId);
          if (event) {
            event.setProp('color', getStatusColor(newStatus));
            event.setExtendedProp('status', newStatus);
          }
          modal.classList.add('hidden');
        })
        .catch(error => {
          console.error('Error:', error);
          showToast('error', error.message || 'Error al actualizar estado');
        })
        .finally(() => {
          saveBtn.disabled = false;
          saveBtn.innerHTML = 'Guardar Cambios';
        });
      });
      
      // Función para obtener color según estado
      function getStatusColor(status) {
        switch (status) {
          case 'pendiente': return '#3b82f6';
          case 'aprobada': return '#10b981';
          case 'rechazada': return '#ef4444';
          case 'reprogramada': return '#8b5cf6';
          case 'completada': return '#10b981';
          default: return '#6b7280';
        }
      }
      
      // Función para mostrar notificaciones
      function showToast(type, message) {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 px-6 py-3 rounded-md text-white ${
          type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
          toast.classList.add('opacity-0', 'transition-opacity', 'duration-500');
          setTimeout(() => toast.remove(), 500);
        }, 3000);
      }
    });
  </script>
</x-layouts.app>

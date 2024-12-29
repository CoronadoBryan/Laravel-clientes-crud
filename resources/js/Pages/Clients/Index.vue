<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link , usePage } from '@inertiajs/vue3';
import {ref} from 'vue';
import { format } from 'date-fns';


const page = usePage();

const clients = ref(page.props.clients);

const onDeleteSuccess=(e)=>{

    clients.value=e.props.clients;
}





const showModal = ref(false);
const selectedClient = ref(null);

const openModal = (client) => {
    selectedClient.value = client;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    selectedClient.value = null;
};

// Función para obtener la clase de estado
const getStatusClass = (status) => {
    switch (status) {
        case 'active':
            return 'bg-green-500';
        case 'pending':
            return 'bg-yellow-500';
        case 'inactive':
            return 'bg-red-500';
        default:
            return 'bg-gray-500'; // Color por defecto
    }
};

// Función para formatear fechas
const formatDate = (dateString) => {
    if (!dateString) return ''; // Manejar caso de fecha vacía
    const date = new Date(dateString);
    return format(date, 'dd/MM/yyyy'); // Formato deseado
};

</script>

<template>
    <Head title="Clientes" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Clientes</h2>
                <Link :href="route('client.create')">
                    <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500">
                        Crear Cliente
                    </button>
                </Link>
            </div>
        </template>

        <div class="py-4">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <table class="min-w-full text-sm text-left text-gray-500">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Correo</th>
                                <th class="px-4 py-2">Teléfono</th>
                                <th class="px-4 py-2">Usuario</th>
                                <!-- <th class="px-4 py-2">Observaciones</th> -->
                                <th class="px-4 py-2">Estado</th>
                                <th class="px-4 py-2">Inicio de Suscripción</th>
                                <th class="px-4 py-2">Fin de Suscripción</th>

                                <th class="px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="client in clients" :key="client.id" class="border-b">
                                <td class="px-4 py-2">{{ client.name }}</td>
                                <td class="px-4 py-2">{{ client.email }}</td>
                                <td class="px-4 py-2">{{ client.phone }}</td>
                                <td class="px-4 py-2">{{ client.usuario }}</td> 
                                <!-- <td class="px-4 py-2">{{ client.observaciones }}</td> -->
                                <td class="px-4 py-2">
                                    <span :class="getStatusClass(client.status)" class="inline-block px-2 py-1 rounded-full text-white">
                                        {{ client.status }}
                                    </span>
                                </td>
                               
                                <td class="px-4 py-2">{{ formatDate(client.start_date) }}</td>
                                <td class="px-4 py-2">{{ formatDate(client.end_date) }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex space-x-2">
                                        <Link :href="route('client.edit', client)">
                                            <button class="inline-flex items-center px-2 py-1 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500">
                                                Editar
                                            </button>
                                        </Link>
                                        <Link @success="onDeleteSuccess" :href="route('client.destroy', client)" method="delete">
                                            <button class="inline-flex items-center px-2 py-1 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-500">
                                                Eliminar
                                            </button>
                                        </Link>
                                        <button @click="openModal(client)" class="inline-flex items-center px-2 py-1 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-500">
                                            Ver Detalles
                                        </button>
                                    </div>
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                            <h3 class="text-lg font-semibold mb-4">Detalles del Cliente</h3>
                            <div class="mb-2">
                                <p><strong>Nombre:</strong> {{ selectedClient.name }}</p>
                            </div>
                            <div class="mb-2">
                                <p><strong>Correo:</strong> {{ selectedClient.email }}</p>
                            </div>
                            <div class="mb-2">
                                <p><strong>Teléfono:</strong> {{ selectedClient.phone }}</p>
                            </div>
                            <div class="mb-2">
                                <p><strong>Inicio de Suscripción:</strong> {{ formatDate(selectedClient.start_date) }}</p>
                            </div>
                            <div class="mb-2">
                                <p><strong>Fin de Suscripción:</strong> {{ formatDate(selectedClient.end_date) }}</p>
                            </div>
                            <div class="mb-2">
                                <p><strong>Usuario:</strong> {{ selectedClient.usuario }}</p>
                            </div>
                            <div class="mb-2">
                                <p><strong>Observaciones:</strong> {{ selectedClient.observaciones }}</p>
                            </div>
                            <div class="mb-2">
                                <p><strong>Estado:</strong>
                                    <span :class="getStatusClass(selectedClient.status)" class="inline-block px-2 py-1 rounded-full text-white">
                                           {{ selectedClient.status }}
                                    </span>
                                </p>
                            </div>
                            <button @click="closeModal" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

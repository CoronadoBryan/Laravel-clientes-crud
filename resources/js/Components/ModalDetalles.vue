<template>
    <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="fixed inset-0 bg-black opacity-50" @click="closeModal"></div>
        <div class="bg-white rounded-lg shadow-lg p-6 z-10">
            <h2 class="text-xl font-bold mb-4">Detalles del Cliente</h2>
            <div>
                <p><strong>Nombre:</strong> {{ client.name }}</p>
                <p><strong>Correo:</strong> {{ client.email }}</p>
                <p><strong>Teléfono:</strong> {{ client.phone }}</p>
                <p><strong>Inicio de Suscripción:</strong> {{ client.start_date }}</p>
                <p><strong>Fin de Suscripción:</strong> {{ client.end_date }}</p>
                <p><strong>Estado:</strong> {{ client.status }}</p>
                <p><strong>Usuario:</strong> {{ client.user_id }}</p>
                <p><strong>Observaciones:</strong> {{ client.observaciones }}</p>
                <!-- Agrega más campos según sea necesario -->
            </div>
            <button @click="closeModal" class="mt-4 bg-red-600 text-white px-4 py-2 rounded">Cerrar</button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    client: Object,
    isOpen: Boolean,
});

const emit = defineEmits(['close']);

const closeModal = () => {
    emit('close');
};
</script>

<style scoped>
/* Estilos para el modal */
</style>
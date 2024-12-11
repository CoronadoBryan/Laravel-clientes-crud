<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link , usePage } from '@inertiajs/vue3';
import {ref} from 'vue';


const page = usePage();

const clients = ref(page.props.clients);

const onDeleteSuccess=(e)=>{

    clients.value=e.props.clients;
}


</script>

<template>
    <Head title="Clientes" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800"
                >
                    Clientes
                </h2>
                <Link :href="route('client.create')">
                    <button
                        class="inline-flex items-center px-4 py-2 mt-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700"
                    >
                        Crear  Cliente
                    </button>
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">

                    <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nombre</th>
                                <th scope="col" class="px-6 py-3">Correo</th>
                                <th scope="col" class="px-6 py-3">Teléfono</th>
                                <th scope="col" class="px-6 py-3">Inicio de Suscripción</th>
                                <th scope="col" class="px-6 py-3">Fin de Suscripción</th>
                                <th scope="col" class="px-6 py-3">Avatar</th>
                                <th scope="col" class="px-6 py-3">Privacidad</th>
                                <th scope="col" class="px-6 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="client in clients" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" className="px-6 pv-4 font-medium text-gray-50 whitespace-nowrap ">
                                    {{ client.name }}
                                </th>
                                <td className="px-6 py-4">
                                    {{ client.email }}
                                </td>
                                <td className="px-6 py-4">
                                    {{ client.phone }}
                                </td>
                                <td className="px-6 py-4">
                                    {{ client.start_date }}
                                </td>
                                <td className="px-6 py-4">
                                    {{ client.end_date }}
                                </td>
                                <td className="px-6 py-4">
                                    <img :src="'/storage/' + client.avatar" alt="avatar" class="h-20 w-20 rounded-full" />
                                </td>
                                <td className="px-6 py-4">
                                    {{ client.privacity }}
                                </td>
                                <td className="px-6 py-4">

                                    <div class="">
                                        <Link :href="route('client.edit', client)">
                                            <button
                                                class="inline-flex items-center px-4 py-2 mt-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700"
                                            >
                                                Editar
                                            </button>
                                        </Link>
                                        <Link @success="onDeleteSuccess" :href="route('client.destroy', client) " method="delete">
                                            <button
                                                class="inline-flex items-center px-4 py-2 mt-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700"
                                            >
                                                eliminar
                                            </button>
                                        </Link>
                                    </div>

                                </td>


                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import FileInput from "@/Components/FileInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const initialValues = {
    name: "",
    email: "",
    phone: "",
    start_date: new Date(), // Fecha actual por defecto
    end_date: null, // Sin fecha seleccionada
    avatar: null,
    status: "pending",
    usuario: "",
    observaciones: "",
    privacity: "public",
};

const form = useForm(initialValues);

const onSelectAvatar=(e)=>{
    const files = e.target.files;

    if(files.length > 0){
        form.avatar = files[0];
    }
}

const submit=()=>{
    form.post(route('client.store'))

}

</script>

<template>
    <Head title="crear cliente"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Formulario para Crear Cliente
                </h2>
                <Link :href="route('client.index')">
                    <button
                        class="inline-flex items-center px-4 py-2 mt-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700"
                    >
                        Lista de Clientes
                    </button>
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="flex justify-center overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <form class="py-5 w-1/3 space-y-3" @submit.prevent="submit" >
                        <div>
                            <InputLabel for="name" value="Nombre" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                autofocus
                                autocomplete="name"
                                aria-placeholder="bryan coronado"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.name"
                            />
                        </div>
                        <div>
                            <InputLabel for="email" value="Correo" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                placeholder="bryan@coronado"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>
                        <div>
                            <InputLabel for="phone" value="Telefono" />

                            <TextInput
                                id="phone"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.phone"
                                placeholder="+51 999 999 999"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.phone"
                            />
                        </div>
                        <div>
                            <InputLabel for="start_date" value="Inicio de suscripcion" />

                            <TextInput
                                id="start_date"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.start_date"
                                aria-placeholder="+51 999 999 999"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.start_date"
                            />
                        </div>
                        <div>
                            <InputLabel for="end_date" value="Fin de suscripcion" />

                            <TextInput
                                id="end_date"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.end_date"
                                aria-placeholder="+51 999 999 999"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.end_date"
                            />
                        </div>
                        <div>
                            <InputLabel for="avatar" value="Avatar" />

                            <FileInput name="avatar" @change="onSelectAvatar" />

                            <InputError
                                class="mt-2"
                                :message="form.errors.avatar"
                            />
                        </div>
                        <div>
                            <InputLabel for="status" value="Estado" />
                            <select v-model="form.status" name="status" id="status" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="active">Activo</option>
                                <option value="inactive">Inactivo</option>
                                <option value="pending">Pendiente</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.status" />
                        </div>
                        <div>
                            <InputLabel for="usuario" value="Usuario" />
                            <TextInput
                                id="usuario"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.usuario"
                                placeholder="Nombre de usuario"
                            />
                            <InputError class="mt-2" :message="form.errors.usuario" />
                        </div>
                        <div>
                            <InputLabel for="observaciones" value="Observaciones" />
                            <TextInput
                                id="observaciones"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.observaciones"
                                placeholder="Observaciones"
                            />
                            <InputError class="mt-2" :message="form.errors.observaciones" />
                        </div>
                        <div>
                            <InputLabel for="privacity" value="Privacidad" />

                            <select v-model="form.privacity" name="privacity" id="privacity" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="public">Publico</option>
                                <option value="private">Privado</option>
                            </select>

                            <InputError
                                class="mt-2"
                                :message="form.errors.privacity"
                            />
                        </div>
                        <div class="flex justify-center">
                            <PrimaryButton  >
                                CREAR CLIENTE
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

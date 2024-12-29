<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link ,  usePage } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import FileInput from "@/Components/FileInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref } from 'vue';

const page = usePage();

const client =  ref(page.props.client);



const initialValues = {
    name: client.value.name ,
    email: client.value.email,
    phone: client.value.phone,
    start_date: client.value.start_date ,
    end_date: client.value.end_date ,
    avatar: client.value.avatar,
    privacity: client.value.privacity,
    usuario: client.value.usuario,
    observaciones: client.value.observaciones,
    status: client.value.status,
};


const form = useForm(initialValues);

const onSelectAvatar=(e)=>{
    const files = e.target.files;

    if(files.length > 0){
        form.avatar = files[0];
    }
}

const submit=()=>{
    form.post(route('client.update', client.value),{
        onSuccess:(e)=>{
           client.value = e.props.client;
        }
    })

}

</script>

<template>
    <Head title="Editar Cliente"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Editar Cliente
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

                        <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-green-600 text-center"
                    >
                        Ekl cliente se actualizo correctamente
                    </p>
                </Transition>
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
                        <div class="">
                            <img :src="'/storage/' + client.avatar" alt="">
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
                                ACTUALIZAR CLIENTE
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

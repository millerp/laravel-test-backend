<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cadastrar Imóvel
            </h2>
        </template>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Dados sobre o Imóvel</h3>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form @submit.prevent="createImovel" method="POST">
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <alert-success :on="createImovelForm.recentlySuccessful" class="mb-3">
                                        Imóvel cadastrado!
                                    </alert-success>
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="email_proprietario"
                                                   class="block text-sm font-medium leading-5 text-gray-700">
                                                Email do Proprietário
                                            </label>
                                            <input type="email" id="email_proprietario"
                                                   v-model="createImovelForm.email_proprietario"
                                                   name="email_proprietario" required
                                                   class="mt-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <jet-input-error :message="createImovelForm.error('email_proprietario')"
                                                             class="mt-2"/>
                                        </div>

                                        <div class="col-span-10 sm:col-span-3">
                                            <label for="rua" class="block text-sm font-medium leading-5 text-gray-700">Rua</label>
                                            <input id="rua" name="rua" v-model="createImovelForm.rua" required
                                                   class="mt-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <jet-input-error :message="createImovelForm.error('rua')" class="mt-2"/>
                                        </div>

                                        <div class="col-span-2 sm:col-span-1">
                                            <label for="numero"
                                                   class="block text-sm font-medium leading-5 text-gray-700">Numero</label>
                                            <input id="numero" name="numero" v-model="createImovelForm.numero"
                                                   class="mt-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <jet-input-error :message="createImovelForm.error('numero')" class="mt-2"/>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2">
                                            <label for="complemento"
                                                   class="block text-sm font-medium leading-5 text-gray-700">Complemento</label>
                                            <input id="complemento" name="complemento"
                                                   v-model="createImovelForm.complemento"
                                                   class="mt-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <jet-input-error :message="createImovelForm.error('complemento')"
                                                             class="mt-2"/>
                                        </div>

                                        <div class="col-span-10 sm:col-span-2">
                                            <label for="bairro"
                                                   class="block text-sm font-medium leading-5 text-gray-700">Bairro</label>
                                            <input id="bairro" name="bairro" v-model="createImovelForm.bairro" required
                                                   class="mt-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <jet-input-error :message="createImovelForm.error('bairro')" class="mt-2"/>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2">
                                            <label for="cidade"
                                                   class="block text-sm font-medium leading-5 text-gray-700">Cidade</label>
                                            <input id="cidade" name="cidade" v-model="createImovelForm.cidade" required
                                                   class="mt-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <jet-input-error :message="createImovelForm.error('cidade')" class="mt-2"/>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2">
                                            <label for="estado"
                                                   class="block text-sm font-medium leading-5 text-gray-700">Estado</label>
                                            <input id="estado" name="estado" v-model="createImovelForm.estado" required
                                                   class="mt-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <jet-input-error :message="createImovelForm.error('estado')" class="mt-2"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-75 text-right sm:px-6">
                                    <jet-link :href="route('imoveis.index')" class="mr-3">
                                        Voltar
                                    </jet-link>
                                    <button :class="{ 'opacity-25': createImovelForm.processing }"
                                            :disabled="createImovelForm.processing"
                                            type="submit"
                                            class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                                        Cadastrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout'
import JetInputError from "@/Jetstream/InputError";
import AlertSuccess from "@/Shared/AlertSuccess";
import JetLink from "@/Jetstream/Link"

export default {
    name: "Create",
    components: {
        AlertSuccess,
        AppLayout,
        JetInputError,
        JetLink,
    },
    data() {
        return {
            createImovelForm: this.$inertia.form({
                email_proprietario: null,
                rua: null,
                numero: null,
                complemento: null,
                bairro: null,
                cidade: null,
                estado: null,
            }, {
                resetOnSuccess: true,
            }),
        }
    },
    methods: {
        createImovel() {
            this.createImovelForm.post(route('imoveis.store'), {
                preserveScroll: true,
            });
        },
    }
}
</script>

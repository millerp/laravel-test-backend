<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Imóveis
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div>
                    <div class="mb-6 flex justify-between items-center">
                        <!--                        <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">-->
                        <!--                            <label class="block text-gray-700">Trashed:</label>-->
                        <!--                            <select v-model="form.trashed" class="mt-1 w-full form-select">-->
                        <!--                                <option :value="null"/>-->
                        <!--                                <option value="with">With Trashed</option>-->
                        <!--                                <option value="only">Only Trashed</option>-->
                        <!--                            </select>-->
                        <!--                        </search-filter>-->
                        <inertia-link class="btn-indigo" :href="route('imoveis.create')">
                            <span>Cadastrar</span>
                            <span class="hidden md:inline">Imóvel</span>
                        </inertia-link>
                    </div>
                    <div class="bg-white rounded shadow overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <tr class="text-left font-bold">
                                <th class="px-6 pt-6 pb-4">#</th>
                                <th class="px-6 pt-6 pb-4">E-mail do Proprietário</th>
                                <th class="px-6 pt-6 pb-4">Endereço</th>
                                <th class="px-6 pt-6 pb-4">Status</th>
                                <th class="px-6 pt-6 pb-4">Ações</th>
                            </tr>
                            <tr v-for="imovel in imoveis.data" :key="imovel.id"
                                class="hover:bg-gray-100 focus-within:bg-gray-100">
                                <td class="border-t p-4">
                                    {{ imovel.id }}
                                </td>
                                <td class="border-t p-4">
                                    {{ imovel.email_proprietario }}
                                </td>
                                <td class="border-t p-4">
                                    {{ imovel.endereco_completo }}
                                </td>
                                <td class="border-t p-4">
                                    {{ imovel.status }}
                                </td>
                                <td class="border-t p-4">
                                    <jet-danger-button class="ml-2" @click.native="confirmImovelDeletion(imovel)">
                                        Remover
                                    </jet-danger-button>
                                </td>
                            </tr>
                            <tr v-if="imoveis.data.length === 0">
                                <td class="border-t px-6 py-4" colspan="4">Nenhum Imóvel cadastrado</td>
                            </tr>
                        </table>
                    </div>
                    <pagination :links="imoveis.links"/>
                </div>
            </div>
            <jet-confirmation-modal :show="imovelDeleted" @close="imovelDeleted = null">
                <template #title>
                    Remover Imóvel
                </template>

                <template #content>
                    Tem certeza que deseja remover este Imóvel?
                </template>

                <template #footer>
                    <jet-secondary-button @click.native="imovelDeleted = null">
                        Cancelar
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click.native="deleteImovel"
                                       :class="{ 'opacity-25': deleteImovelForm.processing }"
                                       :disabled="deleteImovelForm.processing">
                        Remover
                    </jet-danger-button>
                </template>
            </jet-confirmation-modal>
        </div>


    </app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout'
import JetDangerButton from "@/Jetstream/DangerButton";
import Pagination from "@/Shared/Pagination";
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'

export default {
    name: "Index",
    props: {
        imoveis: Object,
    },
    components: {
        AppLayout,
        JetDangerButton,
        Pagination,
        JetConfirmationModal,
        JetSecondaryButton
    },
    data() {
        return {
            deleteImovelForm: this.$inertia.form(),
            imovelDeleted: null,
        }
    },
    methods: {
        deleteImovel() {
            this.deleteImovelForm.delete(route('imoveis.destroy', this.imovelDeleted), {
                preserveScroll: true,
                preserveState: true,
            }).then(() => {
                this.imovelDeleted = null
            })
        },

        confirmImovelDeletion(imovel) {
            this.imovelDeleted = imovel
        },
    }
}
</script>

<style scoped>

</style>

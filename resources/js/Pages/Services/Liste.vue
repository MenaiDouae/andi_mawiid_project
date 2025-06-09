<template>
    <Head title="Services" />
    
    <div class="row justify-content-center">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Services</h4>
                        </div>
                    </div> 
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table datatable" id="datatable_1">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 16px;" @click.prevent="handleMultipleSelect">
                                        <div class="form-check mb-0 ms-n1">
                                            <input type="checkbox" class="form-check-input" name="select-all"
                                                id="select-all" v-model="selectedAll" :value="true">
                                        </div>
                                    </th>
                                    <th>Designation</th>
                                    <th>Prix</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="service in services_data" :key="service.id_service">
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check"
                                                id="customCheck1" v-model="checked_services" :value="service.id_service">
                                        </div>
                                    </td>
                                    <td @click="checkService(service.id_service)">{{ service.service_name }}</td>
                                    <td @click="checkService(service.id_service)">{{ service.prix }} DH</td>
                                    <td class="text-end">
                                        <a href="#" @click="updateService(service.id_service)"><i class="las la-pen text-secondary fs-20"></i></a>
                                        <a href="#" @click="deleteService(service.id_service)"><i
                                                class="las la-trash-alt text-secondary fs-20"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button class="btn btn-danger" @click="deleteMultipleServices(checked_services)" :disabled="checked_services.length === 0">
                            Supprimer les services sélectionnés
                        </button>
                        <button :class="['btn', 'btn-secondary']" @click="handleMultipleSelect">
                            {{ selectedAll ? 'Désélectionner tout' : 'Sélectionner tout' }}
                        </button>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-5">
            <CreateService @serviceAdded="refreshServices" v-if="!updating" />
            <UpdateService @serviceUpdated="refreshServices" @cancelUpdate="handleCancelUpdate" :service="updated_service" v-if="updating" />
        </div>
    </div>
</template>

<script>
import CreateService from '@/Pages/Services/Create.vue';
import UpdateService from '@/Pages/Services/Edit.vue';
import axios from 'axios';
import { Head } from '@inertiajs/vue3';
import {DataTable} from "simple-datatables";


export default {
    props: {
        services: Array,
    },
    components: {
        CreateService,
        Head,
        UpdateService,
    },
    data() {
        return {
            services_data: this.services || [],
            updating: false,
            updated_service: null,
            checked_services: [],
            selectedAll: false,
        }
    },
    watch: {
        checked_services(newValue) {
            if(newValue.length === this.services_data.length) {
                this.selectedAll = true;
            } else {
                this.selectedAll = false;
            }
        }
    },
    mounted() {
        new DataTable("#datatable_1", {
            searchable: true,
            perPage: 10,
            perPageSelect: [10, 25, 50, 100],
            labels: {
                placeholder: "Rechercher...",
                perPage: " Services par page",
                noRows: "Aucun service trouvé",
                info: "Affichage de {start} à {end} sur {rows} services",
            },
        });
    },
    methods: {
        async getServices() {
            try {
                const response = await axios.get(route('api.services.index'));
                if (response.status === 200) {
                    this.services_data = response.data;
                } else {
                    this.$swal(
                        'Erreur',
                        response.data.error,
                        'error'
                    );
                }
            } catch (error) {
                this.$swal(
                    'Erreur',
                    'Une erreur est survenue lors de la récupération des services.',
                    'error'
                );
            }
        },
        refreshServices() {
            this.getServices();
        },
        handleServiceUpdated(){
            this.getServices();
            this.handleCancelUpdate();
        },
        async deleteService(id) {
            this.$swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer !'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        await axios.delete(route('api.services.delete', id));
                        this.$swal.fire(
                            'Supprimé !',
                            'Le service a été supprimé.',
                            'success'
                        );
                        this.getServices();
                    } catch (error) {
                        console.error(error);
                        this.$swal.fire(
                            'Erreur',
                            'Une erreur est survenue lors de la suppression du service.',
                            'error'
                        );
                    }
                }
            });
        },
        updateService(id) {
            this.updated_service = this.services_data.find(s => s.id_service === id);
            this.updating = true;
        },
        handleCancelUpdate(){
            this.updating = false;
            this.updated_service = null;
        },
        handleMultipleSelect(){
            if (this.selectedAll) {
                this.checked_services = [];
                this.selectedAll = false;
            } else {
                this.checked_services = this.services_data.map(service => service.id_service);
                this.selectedAll = true;
            }
        },
        checkService(id) {
            const index = this.checked_services.indexOf(id);
            if (index > -1) {
                this.checked_services.splice(index, 1);
            } else {
                this.checked_services.push(id);
            }
            this.selectedAll = this.checked_services.length === this.services_data.length;
        },
        deleteMultipleServices(){
            if (this.checked_services.length === 0) {
                this.$swal.fire(
                    'Aucun service sélectionné',
                    'Veuillez sélectionner au moins un service à supprimer.',
                    'warning'
                );
                return;
            }

            this.$swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer !'
            }).then(async (result) => {
                console.log(this.checked_services);
                if (result.isConfirmed) {
                    try {
                        await axios.delete(route('api.services.delete_all'), {
                            data: {
                                ids: this.checked_services
                            }
                        });
                        this.$swal.fire(
                            'Supprimé !',
                            'Les services sélectionnés ont été supprimés.',
                            'success'
                        );
                        this.getServices();
                        this.checked_services = [];
                        this.selectedAll = false;
                    } catch (error) {
                        console.error(error);
                        this.$swal.fire(
                            'Erreur',
                            'Une erreur est survenue lors de la suppression des services.',
                            'error'
                        );
                    }
                }
            });
        }
    },
}
</script>
<style scoped>
.la-pen,
.la-eye {
    margin-right: 5px;
}
</style>
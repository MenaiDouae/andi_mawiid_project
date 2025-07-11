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
                        <DataTable :data="services_data" :columns="columns" :options="options" class="datatable table">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Prix</th>
                                </tr>
                            </thead>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-5">
            <CreateService @serviceAdded="refreshServices" v-if="!updating" />
            <UpdateService @serviceUpdated="refreshServices" @cancelUpdate="handleCancelUpdate"
                :service="updated_service" v-if="updating" />
        </div>
    </div>
</template>

<script setup>
import CreateService from '@/Pages/Services/Create.vue';
import UpdateService from '@/Pages/Services/Edit.vue';
import axios from 'axios';
import { Head } from '@inertiajs/vue3';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import { onMounted, ref } from 'vue';
import Swal from 'sweetalert2';
import 'datatables.net-responsive';
import 'datatables.net-select';


const props = defineProps({
    services: Array,
});
console.log(props.services);
const services_data = ref(props.services || []);
const updating = ref(false);
const updated_service = ref(null);
const columns = [
    { data: 'service_name', title: 'Service Name' },
    { data: 'prix', title: 'Prix' },
    {
        data: null,
        title: 'Actions',
        orderable: false,
        searchable: false,
        render: function (data, type, row) {
            return `
        <button class="btn btn-sm btn-primary btn-edit" data-id="${row.id_service}">
          <i class="la la-pen"></i>
        </button>
        <button class="btn btn-sm btn-danger btn-delete" data-id="${row.id_service}">
          <i class="la la-trash"></i>
        </button>
      `;
        }
    }
];
const options = {
  responsive: true,
  select: true,
};

DataTable.use(DataTablesCore);

onMounted(() => {
    document.addEventListener('click', (e) => {
        if (e.target.closest('.btn-delete')) {
            const id = e.target.closest('.btn-delete').dataset.id;
            deleteService(parseInt(id));
        }
        if (e.target.closest('.btn-edit')) {
            const id = e.target.closest('.btn-edit').dataset.id;
            updateService(parseInt(id));
        }
    });
});

console.log(services_data);


const getServices = async () => {
    try {
        const response = await axios.get(route('api.services.index'));
        if (response.status === 200) {
            services_data.value = response.data;
        } else {
            Swal.fire(
                'Erreur',
                response.data.error,
                'error'
            );
        }
    } catch (error) {
        Swal.fire(
            'Erreur',
            'Une erreur est survenue lors de la récupération des services.',
            'error'
        );
    }
};

const refreshServices = () => {
    getServices();
};

const handleServiceUpdated = () => {
    getServices();
    handleCancelUpdate();
};

const deleteService = async (id) => {
    Swal.fire({
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
                Swal.fire(
                    'Supprimé !',
                    'Le service a été supprimé.',
                    'success'
                );
                getServices();
            } catch (error) {
                console.error(error);
                Swal.fire(
                    'Erreur',
                    'Une erreur est survenue lors de la suppression du service.',
                    'error'
                );
            }
        }
    });
};

const updateService = (id) => {
    updated_service.value = services_data.value.find(s => s.id_service === id);
    updating.value = true;
};

const handleCancelUpdate = () => {
    updating.value = false;
    updated_service.value = null;
};

</script>

<style scoped>
.la-pen,
.la-eye {
    margin-right: 5px;
}
</style>
<style>
@import 'datatables.net-dt';
</style>
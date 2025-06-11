<template>
    <Head title="Régions" />

    <div class="row justify-content-center">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Régions</h4>
                        </div>
                    </div> 
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <DataTable :data="regions_data" :columns="columns" :options="options" class="datatable table">
                            <thead>
                                <tr>
                                    <th>Région</th>
                                </tr>
                            </thead>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-5">
            <CreateRegion @regionAdded="refreshRegions" v-if="!updating" />
            <UpdateRegion @regionUpdated="refreshRegions" @cancelUpdate="handleCancelUpdate"
                :region="updated_region" v-if="updating" />
        </div>
    </div>
</template>

<script setup>
import CreateRegion from '@/Pages/Regions/Create.vue';
import UpdateRegion from '@/Pages/Regions/Edit.vue';
import axios from 'axios';
import { Head } from '@inertiajs/vue3';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import { onMounted, ref } from 'vue';
import Swal from 'sweetalert2';
import 'datatables.net-responsive';
import 'datatables.net-select';

const props = defineProps({
    regions: Array,
});
const regions_data = ref(props.regions || []);
const updating = ref(false);
const updated_region = ref(null);
const columns = [
    { data: 'region', title: 'Région' },
    {
        data: null,
        title: 'Actions',
        orderable: false,
        searchable: false,
        render: function (data, type, row) {
            return `
        <button class="btn btn-sm btn-primary btn-edit" data-id="${row.id_region}">
          <i class="la la-pen"></i>
        </button>
        <button class="btn btn-sm btn-danger btn-delete" data-id="${row.id_region}">
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
            deleteRegion(parseInt(id));
        }
        if (e.target.closest('.btn-edit')) {
            const id = e.target.closest('.btn-edit').dataset.id;
            updateRegion(parseInt(id));
        }
    });
});


const getRegions = async () => {
    try {
        const response = await axios.get(route('api.regions.index'));
        if (response.status === 200) {
            regions_data.value = response.data;
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
            'Une erreur est survenue lors de la récupération des régions.',
            'error'
        );
    }
};

const refreshRegions = () => {
    getRegions();
};

const deleteRegion = async (id) => {
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
                await axios.delete(route('api.region.delete', id));
                Swal.fire(
                    'Supprimé !',
                    'La région a été supprimée.',
                    'success'
                );
                getRegions();
            } catch (error) {
                console.error(error);
                Swal.fire(
                    'Erreur',
                    'Une erreur est survenue lors de la suppression de la région.',
                    'error'
                );
            }
        }
    });
};

const updateRegion = (id) => {
    updated_region.value = regions_data.value.find(r => r.id_region === id);
    updating.value = true;
};

const handleCancelUpdate = () => {
    updating.value = false;
    updated_region.value = null;
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
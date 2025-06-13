<template>

    <Head title="Villes" />

    <div class="row justify-content-center">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Villes</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <DataTable :data="villes_data" :columns="columns" :options="options" class="datatable table">
                            <thead>
                                <tr>
                                    <th>ville</th>
                                </tr>
                            </thead>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-5">
            <CreateVille @villeAdded="refreshVilles" v-if="!updating" />
            <UpdateVille @villeUpdated="refreshVilles" @cancelUpdate="handleCancelUpdate"
                :ville="updated_ville" v-if="updating" />
        </div>
    </div>
</template>

<script setup>
import CreateVille from '@/Pages/Villes/Create.vue';
import UpdateVille from '@/Pages/Villes/Edit.vue';
import axios from 'axios';
import { Head } from '@inertiajs/vue3';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import { onMounted, ref } from 'vue';
import Swal from 'sweetalert2';
import 'datatables.net-responsive';
import 'datatables.net-select';


const props = defineProps({
    villes: Array,
});
const villes_data = ref(props.villes || []);
const updating = ref(false);
const updated_ville = ref(null);
const columns = [
    { data: 'ville', title: 'ville' },
    
    {
        data: null,
        title: 'Actions',
        orderable: false,
        searchable: false,
        className: 'text-end',
        render: function (data, type, row) {
            return `
        <button class="btn btn-sm btn-primary btn-edit" data-id="${row.id_ville}">
          <i class="la la-pen"></i>
        </button>
        <button class="btn btn-sm btn-danger btn-delete" data-id="${row.id_ville}">
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
            deleteVille(parseInt(id));
        }
        if (e.target.closest('.btn-edit')) {
            const id = e.target.closest('.btn-edit').dataset.id;
            updateVille(parseInt(id));
        }
    });
});


const getVilles = async () => {
    try {
        const response = await axios.get(route('api.villes.index'));
        if (response.status === 200) {
            villes_data.value = response.data;
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
            'Une erreur est survenue lors de la récupération des villes.',
            'error'
        );
    }
};

const refreshVilles = () => {
    getVilles();
};

const handleVilleUpdated = () => {
    getVilles();
    handleCancelUpdate();
};

const deleteVille = async (id) => {
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
                await axios.delete(route('api.ville.delete', id));
                Swal.fire(
                    'Supprimé !',
                    'La ville a été supprimée.',
                    'success'
                );
                getVilles();
            } catch (error) {
                console.error(error);
                Swal.fire(
                    'Erreur',
                    'Une erreur est survenue lors de la suppression du ville.',
                    'error'
                );
            }
        }
    });
};

const updateVille = (id) => {
    updated_ville.value = villes_data.value.find(v => v.id_ville === id);
    updating.value = true;
};

const handleCancelUpdate = () => {
    updating.value = false;
    updated_ville.value = null;
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
<template>
    <Head title="Specialités" />

    <div class="row justify-content-center">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Specialités</h4>
                        </div>
                    </div> 
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <DataTable :data="specialities_data" :columns="columns" :options="options" class="datatable table">
                            <thead>
                                <tr>
                                    <th>Spécialités</th>
                                </tr>
                            </thead>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-5">
            <CreateSpeciality @specialityAdded="refreshSpecialities" v-if="!updating" />
            <UpdateSpeciality @specialityUpdated="refreshSpecialities" @cancelUpdate="handleCancelUpdate"
                :speciality="updated_speciality" v-if="updating" />
        </div>
    </div>
</template>

<script setup>
import CreateSpeciality from '@/Pages/Specialities/Create.vue';
import UpdateSpeciality from '@/Pages/Specialities/Edit.vue';
import axios from 'axios';
import { Head } from '@inertiajs/vue3';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import { onMounted, ref } from 'vue';
import Swal from 'sweetalert2';
import 'datatables.net-responsive';
import 'datatables.net-select';

const props = defineProps({
    specialities: Array,
});
const specialities_data = ref(props.specialities || []);
const updating = ref(false);
const updated_speciality = ref(null);
const columns = [
    { data: 'designation', title: 'Designation' },
    {
        data: null,
        title: 'Actions',
        orderable: false,
        searchable: false,
        render: function (data, type, row) {
            return `
        <button class="btn btn-sm btn-primary btn-edit" data-id="${row.id_specialite}">
          <i class="la la-pen"></i>
        </button>
        <button class="btn btn-sm btn-danger btn-delete" data-id="${row.id_specialite}">
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
            deleteSpeciality(parseInt(id));
        }
        if (e.target.closest('.btn-edit')) {
            const id = e.target.closest('.btn-edit').dataset.id;
            updateSpeciality(parseInt(id));
        }
    });
});


const getSpecialities = async () => {
    try {
        const response = await axios.get(route('api.specialities.index'));
        if (response.status === 200) {
            specialities_data.value = response.data;
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
            'Une erreur est survenue lors de la récupération des specialités.',
            'error'
        );
    }
};

const refreshSpecialities = () => {
    getSpecialities();
};

const deleteSpeciality = async (id) => {
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
                await axios.delete(route('api.speciality.delete', id));
                Swal.fire(
                    'Supprimé !',
                    'La specialité a été supprimée.',
                    'success'
                );
                getSpecialities();
            } catch (error) {
                console.error(error);
                Swal.fire(
                    'Erreur',
                    'Une erreur est survenue lors de la suppression de la specialité.',
                    'error'
                );
            }
        }
    });
};

const updateSpeciality = (id) => {
    updated_speciality.value = specialities_data.value.find(s => s.id_specialite === id);
    updating.value = true;
};

const handleCancelUpdate = () => {
    updating.value = false;
    updated_speciality.value = null;
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
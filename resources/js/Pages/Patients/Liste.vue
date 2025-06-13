<template>
    <Head title="Patients" />

    <div class="row justify-content-center">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Liste des patients</h4>
                        </div>
                    </div> 
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <DataTable :data="patients_data" :columns="columns" :options="options" class="datatable table">
                            <thead>
                                <tr>
                                    <th>Patients</th>
                                </tr>
                            </thead>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-5">
            <CreatePatient v-if="mode === 'create'" @patientAdded="refreshPatients" />
            <UpdatePatient v-if="mode === 'update'" :patient="updated_patient" @patientUpdated="refreshPatients" @cancelUpdate="handleCancelUpdate" />
            <DetailsPatient v-if="mode === 'details'" :patient="details_patient" :lastAppointment="lastAppointment"  @close="closeDetails" />
        </div>
    </div>
</template>

<script setup>
import CreatePatient from '@/Pages/Patients/Create.vue';
import UpdatePatient from '@/Pages/Patients/Edit.vue';
import DetailsPatient from '@/Pages/Patients/Details.vue';
import axios from 'axios';
import { Head } from '@inertiajs/vue3';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import { onMounted, ref } from 'vue';
import Swal from 'sweetalert2';
import 'datatables.net-responsive';
import 'datatables.net-select';

const props = defineProps({
    patients: Array,
});
const patients_data = ref(props.patients || []);
const updating = ref(false);
const mode = ref("create");
const updated_patient=ref(null);
const details_patient=ref(null);
const lastAppointment = ref(null);
const columns = [
    { data: 'nom', title: 'Nom' },
    { data: 'prenom', title: 'Prénom' },
    { data: 'num_tel', title: 'Numéro de téléphone' },
    {
        data: null,
        title: 'Actions',
        orderable: false,
        searchable: false,
        render: function (data, type, row) {
            return `
        <button class="btn btn-sm btn-primary btn-edit" data-id="${row.id_patient}">
          <i class="la la-pen"></i>
        </button>
        <button class="btn btn-sm btn-danger btn-delete" data-id="${row.id_patient}">
          <i class="la la-trash"></i>
        </button>
        <button class="btn btn-sm btn-secondary btn-details" data-id="${row.id_patient}">
          <i class="la la-eye"></i>
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
            deletePatient(parseInt(id));
        }
        if (e.target.closest('.btn-edit')) {
            const id = e.target.closest('.btn-edit').dataset.id;
            updatePatient(parseInt(id));
        }
        if (e.target.closest('.btn-details')) {
            const id = e.target.closest('.btn-details').dataset.id;
            showDetails(parseInt(id));
        }
    });
});


const getPatients = async () => {
    try {
        const response = await axios.get(route('api.patients.index'));
        if (response.status === 200) {
            patients_data.value = response.data;
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
            'Une erreur est survenue lors de la récupération des patients.',
            'error'
        );
    }
};

const refreshPatients = () => {
    getPatients();
};

const deletePatient = async (id) => {
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
                await axios.delete(route('api.patients.delete', id));
                Swal.fire(
                    'Supprimé !',
                    'Le patient a été supprimé.',
                    'success'
                );
                getPatients();
            } catch (error) {
                console.error(error);
                Swal.fire(
                    'Erreur',
                    'Une erreur est survenue lors de la suppression du patient.',
                    'error'
                );
            }
        }
    });
};

const updatePatient = (id) => {
    updated_patient.value = patients_data.value.find(p => p.id_patient === id);
    mode.value = 'update';
};

const showDetails = async (id) => {
    try {
        const response = await axios.get(route('api.patients.show', id));
        if (response.status === 200) {
            details_patient.value = response.data.patient;
            lastAppointment.value = response.data.lastAppointment;
            mode.value = 'details';
        }
    } catch (error) {
        console.error(error);
        Swal.fire('Erreur', 'Impossible de charger les détails', 'error');
    }
};

const closeDetails = () => {
    details_patient.value = null;
    lastAppointment.value = null;
    mode.value = 'create';
};

const handleCancelUpdate = () => {
    updated_patient.value = null;
    mode.value = 'create';
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
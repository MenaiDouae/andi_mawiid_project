<template>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Modifier le patient</h4>
        </div>
        <div class="card-body">
            <form @submit.prevent="submitForm">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" v-model="patient.nom" id="nom"
                        placeholder="Nom du patient" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" v-model="patient.prenom" id="prenom"
                        placeholder="Prénom du patient" required>
                </div>
                <div class="mb-3">
                    <label for="cnie" class="form-label">Cnie</label>
                    <input type="text" class="form-control" v-model="patient.cnie" id="cnie"
                        placeholder="Carte Nationale d'identité">
                </div>
                <div class="mb-3">
                    <label for="date_naissance" class="form-label">Date de naissance</label>
                    <input type="text" class="form-control" v-model="patient.date_naissance" id="date_naissance"
                        placeholder="Date de naissance">
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" v-model="patient.adresse" id="adresse"
                        placeholder="Adresse du patient">
                </div>
                <div class="mb-3">
                    <label for="num_tel" class="form-label">Numéro de téléphone <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" v-model="patient.num_tel" id="num_tel"
                        placeholder="Numéro de telephone" required>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label text-lg-end">Sexe <span style="color: red;">*</span></label>
                    <div class="col-sm-10 d-flex align-items-center gap-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="sexe-masculin" value="1" v-model="patient.sexe">
                            <label class="form-check-label" for="sexe-masculin">
                                Masculin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="sexe-feminin" value="2" v-model="patient.sexe">
                            <label class="form-check-label" for="sexe-feminin">
                                Féminin
                            </label>
                        </div>
                    </div>
                </div>

               <button type="submit" class="btn btn-warning">Modifier</button>
              <button type="button" class="btn btn-secondary" @click="cancelUpdate">Annuler</button>
            </form>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    name: 'UpdatePatient',
    emits: ['patientUpdated', 'cancelUpdate'],
    props: {
        patient: {
            type: Object,
            required: true
        }
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.put(route('api.patients.update', this.patient.id_patient), this.patient);
                if (response.status === 200) {
                    this.$swal(
                        'Succès',
                        response.data.success,
                        'success'
                    );
                    this.$emit('patientUpdated');
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
                    'Une erreur est survenue lors de la modification des informations du patient.',
                    'error'
                );
            }
        },
        cancelUpdate() {
            this.$emit('cancelUpdate');
        }
    },

}
</script>
<style scoped>
.btn-warning {
    margin-right: 5px;
}
</style>
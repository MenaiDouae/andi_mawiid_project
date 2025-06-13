<template>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Ajouter un patient</h4>
        </div>
        <div class="card-body">
            <form @submit.prevent="submitForm">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" v-model="data.nom" id="nom"
                        placeholder="Nom du patient" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" v-model="data.prenom" id="prenom"
                        placeholder="Prénom du patient" required>
                </div>
                <div class="mb-3">
                    <label for="cnie" class="form-label">Cnie</label>
                    <input type="text" class="form-control" v-model="data.cnie" id="cnie"
                        placeholder="Carte Nationale d'identité" >
                </div>
                <div class="mb-3">
                    <label for="date_naissance" class="form-label">Date de naissance</label>
                    <input type="date" class="form-control" v-model="data.date_naissance" id="date_naissance"
                        placeholder="Date de naissance">
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" v-model="data.adresse" id="adresse"
                        placeholder="Adresse du patient" >
                </div>
                <div class="mb-3">
                    <label for="num_tel" class="form-label">Numéro de téléphone <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" v-model="data.num_tel" id="num_tel"
                        placeholder="Numéro de telephone" >
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" v-model="data.email" id="email"
                        placeholder="Courrier électronique" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe <span style="color: red;">*</span></label>
                    <input type="password" class="form-control" v-model="data.password" id="password"
                        placeholder="" required>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label text-lg-end">Sexe</label>
                    <div class="col-sm-10 d-flex align-items-center gap-4">
                        <div class="form-check">
                        <input class="form-check-input" type="radio" id="sexe-masculin" value="1" v-model="data.sexe">
                        <label class="form-check-label" for="sexe-masculin">
                            Masculin
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" id="sexe-feminin" value="2" v-model="data.sexe">
                        <label class="form-check-label" for="sexe-feminin">
                            Féminin
                        </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'CreatePatient',
    emits: ['patientAdded'],
    data() {
        return {
            data: {
                nom: '',
                prenom:'',
                cnie:'',
                date_naissance:'',
                adresse:'',
                num_tel:'',
                sexe:''?
                email:'',
                password:''
            },
        };
    },
    methods: {
        async submitForm() {
            try {
                console.log(this.data);
                const response = await axios.post(route('api.patients.store'), this.data);
                this.data.nom = '';
                this.data.prenom = '';
                this.data.cnie = '';
                this.data.date_naissance = '';
                this.data.adresse = '';
                this.data.num_tel = '';
                this.data.sexe = '';
                this.data.email='';
                this.data.password='';
                if (response.status === 201) {
                    this.$swal('Succès', response.data.success, 'success');
                    this.$emit('patientAdded');
                } else {
                    this.$swal('Erreur', response.data.error, 'error');
                }
            } catch (error) {
                this.$swal('Erreur', 'Une erreur est survenue lors de l\'ajout du patient.', 'error');
            }
        },
    },
};
</script>

<style scoped>
.btn-primary {
    margin-right: 5px;
}
</style>

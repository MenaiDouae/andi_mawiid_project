<template>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Ajouter une specialité</h4>
        </div>
        <div class="card-body">
            <form @submit.prevent="submitForm">
                <div class="mb-3">
                    <label for="designation" class="form-label">Désignation</label>
                    <input type="text" class="form-control" v-model="data.designation" id="designation"
                        placeholder="Désignation de la specialité" required>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'CreateSpeciality',
    emits: ['specialityAdded'],
    data() {
        return {
            data: {
                designation: '',
            },
        };
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post(route('api.speciality.store'), this.data);
                this.data.designation = '';
                if (response.status === 201) {
                    this.$swal('Succès', response.data.success, 'success');
                    this.$emit('specialityAdded');
                } else {
                    this.$swal('Erreur', response.data.error, 'error');
                }
            } catch (error) {
                this.$swal('Erreur', 'Une erreur est survenue lors de l\'ajout de la specialité.', 'error');
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

<template>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Modifier une specialité</h4>
        </div>
        <div class="card-body">
            <form @submit.prevent="submitForm">
                <div class="mb-3">
                    <label for="speciality" class="form-label">Désignation</label>
                    <input type="text" class="form-control" v-model="speciality.designation" id="speciality"
                        placeholder="Désignation de la specialité">
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
    name: 'UpdateSpeciality',
    emits: ['specialityUpdated', 'cancelUpdate'],
    props: {
        speciality: {
            type: Object,
            required: true
        }
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.put(route('api.speciality.update', this.speciality.id_specialite), this.speciality);
                if (response.status === 200) {
                    this.$swal(
                        'Succès',
                        response.data.success,
                        'success'
                    );
                    this.$emit('specialityUpdated');
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
                    'Une erreur est survenue lors de la modification de la specialité.',
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




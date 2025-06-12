<template>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Modifier un service</h4>
        </div>
        <div class="card-body">
            <form @submit.prevent="submitForm">
                <div class="mb-3">
                    <label for="designation" class="form-label">Désignation</label>
                    <input type="text" class="form-control" v-model="service.service_name" id="designation"
                        placeholder="Désignation du service">
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix</label>
                    <input type="number" class="form-control" v-model="service.prix" id="prix"
                        placeholder="Prix du service">
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
    name: 'UpdateService',
    emits: ['serviceUpdated', 'cancelUpdate'],
    props: {
        service: {
            type: Object,
            required: true
        }
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.put(route('api.services.update', this.service.id_service), this.service);
                if (response.status === 200) {
                    this.$swal(
                        'Succès',
                        response.data.success,
                        'success'
                    );
                    this.$emit('serviceUpdated');
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
                    'Une erreur est survenue lors de la modification du service.',
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
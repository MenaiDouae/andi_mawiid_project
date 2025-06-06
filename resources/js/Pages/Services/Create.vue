<template>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Ajouter un service</h4>
        </div>
        <div class="card-body">
            <form @submit.prevent="submitForm">
                <div class="mb-3">
                    <label for="designation" class="form-label">Désignation</label>
                    <input type="text" class="form-control" v-model="data.service_name" id="designation"
                        placeholder="Désignation du service">
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix</label>
                    <input type="number" class="form-control" v-model="data.prix" id="prix"
                        placeholder="Prix du service">
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
    name: 'CreateService',
    emits: ['serviceAdded'],

    data() {
        return {
            data: {
                service_name: '',
                prix: ''
            },
        }
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post(route('api.services.store'), this.data);
                this.data.service_name = '';
                this.data.prix = '';
                if (response.status === 201) {
                    this.$swal(
                        'Succès',
                        response.data.success,
                        'success'
                    );
                    
                    this.$emit('serviceAdded');

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
                    'Une erreur est survenue lors de l\'ajout du service.',
                    'error'
                );
            }
        },
    }

}
</script>
<style scoped>
.btn-primary {
    margin-right: 5px;
}
</style>
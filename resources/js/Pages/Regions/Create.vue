
<template>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Ajouter une région</h4>
        </div>
        <div class="card-body">
            <form @submit.prevent="submitForm">
                <div class="mb-3">
                    <label for="region" class="form-label">Désignation</label>
                    <input type="text" class="form-control" v-model="data.region" id="region"
                        placeholder="Désignation du région">
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
    name: 'CreateRegion',
    emits: ['regionAdded'],

    data() {
        return {
            data: {
                region: '',
            },
        }
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post(route('api.region.store'), this.data);
                this.data.region = '';
                if (response.status === 201) {
                    this.$swal(
                        'Succès',
                        response.data.success,
                        'success'
                    );
                    
                    this.$emit('regionAdded');

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
                    'Une erreur est survenue lors de l\'ajout du région.',
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

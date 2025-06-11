<template>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Modifier une région</h4>
        </div>
        <div class="card-body">
            <form @submit.prevent="submitForm">
                <div class="mb-3">
                    <label for="region" class="form-label">Désignation</label>
                    <input type="text" class="form-control" v-model="region.region" id="region"
                        placeholder="Désignation du région">
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
    name: 'UpdateRegion',
    emits: ['regionUpdated', 'cancelUpdate'],
    props: {
        region: {
            type: Object,
            required: true
        }
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.put(route('api.region.update', this.region.id_region), this.region);
                if (response.status === 200) {
                    this.$swal(
                        'Succès',
                        response.data.success,
                        'success'
                    );
                    this.$emit('regionUpdated');
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
                    'Une erreur est survenue lors de la modification du région.',
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




<template>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Ajouter une ville</h4>
        </div>
        <div class="card-body">
            <form @submit.prevent="submitForm">
                <div class="mb-3">
                    <label for="designation" class="form-label">Désignation</label>
                    <input type="text" class="form-control" v-model="data.ville" id="designation"
                        placeholder="Désignation de la ville" required>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label text-lg-end">Région</label>
                    <div class="col-sm-10">
                        <select class="form-select" v-model="data.id_region" required>
                            <option disabled value="">Sélectionner une région</option>
                            <option v-for="region in regions" :key="region.id_region" :value="region.id_region">
                                {{ region.region }}
                            </option>
                        </select>
                    </div>
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
    name: 'CreateVille',
    emits: ['villeAdded'],
    data() {
        return {
            data: {
                ville: '',
                id_region: ''
            },
            regions: []
        };
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post(route('api.ville.store'), this.data);
                this.data.ville = '';
                this.data.id_region = '';
                if (response.status === 201) {
                    this.$swal('Succès', response.data.success, 'success');
                    this.$emit('villeAdded');
                } else {
                    this.$swal('Erreur', response.data.error, 'error');
                }
            } catch (error) {
                this.$swal('Erreur', 'Une erreur est survenue lors de l\'ajout de la ville.', 'error');
            }
        },
        async getRegions() {
            try {
                const response = await axios.get(route('api.regions.index'));
                if (response.status === 200) {
                    this.regions = response.data;
                } else {
                    this.$swal('Erreur', response.data.error, 'error');
                }
            } catch (error) {
                this.$swal('Erreur', 'Une erreur est survenue lors de la récupération des régions.', 'error');
            }
        }
    },
    mounted() {
        this.getRegions();
    }
};
</script>

<style scoped>
.btn-primary {
    margin-right: 5px;
}
</style>

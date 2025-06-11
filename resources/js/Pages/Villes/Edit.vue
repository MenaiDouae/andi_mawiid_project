<template>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Modifier une ville</h4>
        </div>
        <div class="card-body">
            <form @submit.prevent="submitForm">
                <div class="mb-3">
                    <label for="designation" class="form-label">Désignation</label>
                    <input type="text" class="form-control" v-model="ville.ville" id="designation"
                        placeholder="Désignation du ville">
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label text-lg-end">Région</label>
                    <div class="col-sm-10">
                        <select class="form-select" v-model="ville.id_region" required>
                            <option disabled value="">Sélectionner une région</option>
                            <option v-for="region in regions" :key="region.id_region" :value="region.id_region">
                                {{ region.region }}
                            </option>
                        </select>
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
    name: 'UpdateVille',
    emits: ['villeUpdated', 'cancelUpdate'],
    props: {
        ville: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            regions: []
        };
    },
    methods: {
        async submitForm() {
            try {
                // console.log(this.ville);
                const response = await axios.put(route('api.ville.update', this.ville.id_ville), this.ville);
                if (response.status === 200) {
                    this.$swal('Succès', response.data.success, 'success');
                    this.$emit('villeUpdated');
                } else {
                    this.$swal('Erreur', response.data.error, 'error');
                }
            } catch (error) {
                console.log('object'.this.ville);
                this.$swal('Erreur', 'Une erreur est survenue lors de la modification du ville.', 'error');
            }
        },
        cancelUpdate() {
            this.$emit('cancelUpdate');
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
.btn-warning {
    margin-right: 5px;
}
</style>

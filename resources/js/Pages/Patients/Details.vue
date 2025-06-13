<template>
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Détails du patient</h5>
    </div>
    <div class="card-body p-0">
      <table class="table table-bordered table-hover w-100">
        <tbody>
          <tr>
            <td>Nom</td>
            <td>{{ patient.nom }}</td>
          </tr>
          <tr>
            <td>Prénom</td>
            <td>{{ patient.prenom }}</td>
          </tr>
          <tr>
            <td>Téléphone</td>
            <td>{{ patient.num_tel }}</td>
          </tr>
          <tr>
            <td>Sexe</td>
            <td >{{ patient.sexe == 1 ? 'Masculin' : 'Féminin' }}</td>
          </tr>
          <tr>
            <td>Cnie</td>
            <td :class="{'text-muted': patient.cnie === null}">{{ patient.cnie?? 'Non spécifiée' }}</td>
          </tr>
          <tr>
            <td>Date de naissance</td>
            <td :class="{'text-muted': patient.date_naissance === null}">{{ patient.date_naissance?? 'Non spécifié' }}</td>
          </tr>
          <tr>
            <td>Adresse</td>
            <td :class="{'text-muted': patient.adresse === null}">{{ patient.adresse?? 'Non spécifiée' }}</td>
          </tr>
          </tbody>
      </table>

          <div v-if="lastAppointment" class="card mt-3">
            <div class="card-header">
              <h5 class="mb-0">Dernier Rendez-vous</h5>
            </div>
            <div class="card-body p-0">
              <table class="table table-bordered table-hover w-100">
                <tbody>
                  <tr>
                    <td>Date</td>
                    <td>{{ lastAppointment.date_rendez_vous }}</td>
                  </tr>
                  <tr>
                    <td>Heure</td>
                    <td>{{ lastAppointment.heure_rendez_vous }}</td>
                  </tr>
                  <tr>
                    <td>Service</td>
                    <td>{{ lastAppointment.service.service_name}}</td>
                  </tr>
                  <tr>
                    <td>Commentaire</td>
                    <td>{{ lastAppointment.commentaire }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div v-else class="mt-3">
            <p><em>Pas de rendez-vous disponible.</em></p>
          </div>

        
    </div>
     <button class="btn btn-sm btn-secondary m-3" @click="$emit('close')">Fermer</button>
  </div>
</template>

<script>
export default {
    name: 'DetailsPatient',
    props: {
        patient: {
            type: Object,
            required: true
        },
        lastAppointment:{
          type: Object,
          required: false
        }
    },
    emits :['close']
}
</script>

<style scoped>
th {
  width: 30%;
  background-color: #f8f9fa;
}
td {
  font-weight: 500;
}
</style>

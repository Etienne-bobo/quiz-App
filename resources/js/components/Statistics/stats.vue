<template>
  <v-main>
    <v-container fluid>
      <div>
        <v-row>
          <v-col lg="4" cols="sm" class="pb-2">
            <v-alert border="left" colored-border color="blue" elevation="2">
              <v-row class="no-gutters">
                <div class="col pa-3 py-4 blue--text">
                  <h5 class="text-truncate text-uppercase">
                    Nombre total de docteur
                  </h5>
                  <h1>213</h1>
                </div>
              </v-row>
            </v-alert>
          </v-col>
          <v-col lg="4" cols="sm" class="pb-2">
            <v-alert border="left" colored-border color="success" elevation="2">
              <v-row class="no-gutters">
                <div class="col pa-3 py-4 success--text">
                  <h5 class="text-truncate text-uppercase">
                    Nombre total d'Hopitaux
                  </h5>
                  <h1>13</h1>
                </div>
              </v-row>
            </v-alert>
          </v-col>
          <v-col lg="4" cols="sm" class="pb-2">
            <v-alert
              border="left"
              colored-border
              color="deep-purple accent-4"
              elevation="2"
            >
              <v-row class="no-gutters">
                <div class="col pa-3 py-4 deep-purple--text">
                  <h5 class="text-truncate text-uppercase">
                    Nombre total de pharmacie
                  </h5>
                  <h1>21</h1>
                </div>
              </v-row>
            </v-alert>
          </v-col>
        </v-row>
        <v-row>
          <v-col lg="4" cols="sm" class="pb-2">
            <v-alert border="left" colored-border elevation="2">
              <v-row class="no-gutters">
                <div class="col pa-3 py-4 dark--text">
                  <h5 class="text-truncate text-uppercase">
                    Nombre total d'utilisateur
                  </h5>
                  <h1>2103</h1>
                </div>
              </v-row>
            </v-alert>
          </v-col>
          <v-col lg="4" cols="sm" class="pb-2">
            <v-alert border="left" colored-border color="red" elevation="2">
              <v-row class="no-gutters">
                <div class="col pa-3 py-4 blue--text">
                  <h5 class="text-truncate text-uppercase">
                    docteur bloque
                  </h5>
                  <h1>13</h1>
                </div>
              </v-row>
            </v-alert>
          </v-col>
          <v-col lg="4" cols="sm" class="pb-2">
            <v-alert
              border="left"
              colored-border
              color="blue accent-4"
              elevation="2"
            >
              <v-row class="no-gutters">
                <div class="col pa-3 py-4 green--text">
                  <h5 class="text-truncate text-uppercase">
                    pharmacie bloquee
                  </h5>
                  <h1>21</h1>
                </div>
              </v-row>
            </v-alert>
          </v-col>
        </v-row>
      </div>
    </v-container>
  </v-main>
</template>
<script>
export default {
  data() {
    return {};
  }
};
</script>
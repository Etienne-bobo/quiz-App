<template>
  <v-app>
    <AppLayout />
    <v-main>
      <v-container class="mt-6">
        <div v-if="totalNumberOfQuiz.length != 0">
          <v-row no-gutters>
            <v-col cols="12" sm="4">            
                <v-alert
                  border="left"
                  class="mx-2 py-6 text-center font-semibold"
                  colored-border
                  color="success"
                  elevation="2"
                >
                  <v-icon>mdi-quora</v-icon> Number of Quiz <br>
                  <v-btn class="my-6 py-4" color="success">{{ totalNumberOfQuiz }}</v-btn>
                </v-alert>                
            
            </v-col>
            <v-col cols="12" sm="4">
              <v-alert
                  border="left"
                  class="mx-2 py-6 text-center font-semibold"
                  colored-border
                  color="primary"
                  elevation="2"
                >
                  <v-icon>mdi-head-question-outline</v-icon> Number of Questions <br>
                  <v-btn class="my-6 py-4" color="primary">{{ totalNumberOfQuestions }}</v-btn>
                </v-alert>    
            </v-col>
            <v-col cols="12" sm="4">
              <v-alert
                  border="left"
                  class="mx-2 py-6 text-center font-semibold"
                  colored-border
                  color="orange"
                  elevation="2"
                >
                  <v-icon>mdi-account</v-icon> Number of Users <br>
                  <v-btn class="my-6 py-4" color="orange">{{ totalNumberOfUsers }}</v-btn>
                </v-alert>    
            </v-col>
          </v-row>
        </div>
        <div class="text-center mx-auto" v-else>
          <div align="center" class="mx-2">
            <v-alert border="right" colored-border type="error" elevation="2">
              No Statistics Available.
            </v-alert>
            <v-skeleton-loader
              v-bind="attrs"
              type="date-picker"
            ></v-skeleton-loader>
          </div>
        </div>
      </v-container>
    </v-main>
  </v-app>
</template>
<script>
import AppLayout from "../Layouts/AppLayout";
export default {
  name: "index",
  props: ["totalNumberOfQuestions", "totalNumberOfQuiz", "totalNumberOfUsers"],
  data() {
    return {
      confirmationDialog: false,
      multiLine: true,
      snackbar: true,
      attrs: {
        class: "mb-6",
        boilerplate: false,
        elevation: 2,
      },
    };
  },
  components: {
    AppLayout,
  },
  methods: {
    edit: function (data) {
      this.form = Object.assign({}, data);
    },
    destroy(quiz_id, user_id) {
      this.$inertia.post("/exam/remove", quiz_id, user_id);
      this.confirmationDialog = false;
    },
  },
};
</script>
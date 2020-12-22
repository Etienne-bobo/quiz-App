<template>
  <v-app>
    <AppLayout />
    <div v-if="$page.flash.message" class="text-center">
      <v-snackbar v-model="snackbar" :multi-line="multiLine" top>
        <p class="text-sm">{{ $page.flash.message }}</p>

        <template v-slot:action="{ attrs }">
          <v-btn color="red" text v-bind="attrs" @click="snackbar = false">
            Close
          </v-btn>
        </template>
      </v-snackbar>
    </div>
    <v-main>
      <v-container class="mt-6">
        <div align="right" class="mb-8">
          <inertia-link :href="route('exam.create')">
            <v-btn color="primary px-6 py-6">
              <v-icon>mdi-plus</v-icon>
              Assign new User
            </v-btn>
          </inertia-link>
        </div>
        <v-alert
          border="top"
          class="mx-2 py-6 text-center font-bold"
          colored-border
          type="info"
          elevation="2"
        >
          User assigned Quiz
        </v-alert>
        <div v-if="quizzes.length != 0">
          <v-row no-gutters v-for="(quiz, id) in quizzes" :key="id">
            <v-col v-for="(user, id) in quiz.users" :key="id" cols="12" sm="4">
              <v-card class="mx-auto mb-6" max-width="344">
                <v-card-text>
                  <p class="text-md text--primary">
                    Quiz: <span class="text-md"> {{ quiz.name }}</span>
                  </p>
                  <p class="text-md text--primary">
                    User: <span class="text-md">{{ user.name }}</span>
                  </p>
                </v-card-text>
                <v-card-actions>
                  <v-form>
                    <input type="hidden" :v-model="(quiz_id = quiz.id)" />
                    <input type="hidden" :v-model="(user_id = user.id)" />
                    <v-btn
                      color="red lighten-1"
                      class="white--text"
                      @click="destroy({ quiz_id: quiz_id, user_id: user.id })"
                      >Remove</v-btn
                    >
                  </v-form>
                </v-card-actions>
              </v-card>
            </v-col>
          </v-row>
        </div>
        <div class="text-center mx-auto" v-else>
          <div align="center" class="mx-2">
            <v-alert border="right" colored-border type="error" elevation="2">
              Quiz isn't yet assigned to any user.<br />
              Click add button to add one .
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
import AppLayout from "../../Layouts/AppLayout";
export default {
  name: "index",
  props: ["quizzes"],
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
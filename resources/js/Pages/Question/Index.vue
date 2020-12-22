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
          <inertia-link :href="route('question.create')">
            <v-btn color="primary px-6 py-6">
              <v-icon>mdi-plus</v-icon>
              Add new question
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
          List of All Questions
        </v-alert>
            <v-row no-gutters v-if="questions.length != 0">
              <v-col v-for="(question, id) in questions" :key="id" cols="12" sm="4">
                <v-card class="mx-auto mb-6" max-width="344">
                  <v-card-text>
                    <p class="text-md font-semibold text--primary">
                      {{ question.question }}
                    </p>
                    <p v-if="question.quiz" class="text--primary">
                      Quiz:{{ question.quiz.name }}
                    </p>
                  </v-card-text>
                  <v-card-actions>
                    <inertia-link :href="route('question.edit', question.id)">
                      <v-btn @click="edit(quiz)" text color="teal white--text">
                      View
                      </v-btn>
                    </inertia-link>
                  </v-card-actions>
                </v-card>
              </v-col>
            </v-row>
        <v-row class="text-center mx-auto" v-else>
          <div align="center" class="mx-2">
            <v-alert border="right" colored-border type="error" elevation="2">
              Question list is empty.<br />
              Click add button to add one .
            </v-alert>
            <v-skeleton-loader
              v-bind="attrs"
              type="date-picker"
            ></v-skeleton-loader>
          </div>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>
<script>
import AppLayout from "../../Layouts/AppLayout";
export default {
  name: "index",
  props: ["questions", "quizzes"],
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
  },
};
</script>
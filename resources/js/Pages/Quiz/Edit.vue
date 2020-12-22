<template>
  <v-app>
    <AppLayout />
    <v-main>
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
      <v-container>
        <div align="right">
          <v-btn @click="confirmationDialog = true" color="red white--text">
            Delete
          </v-btn>
        </div>

        <v-flex xs12 sm12 md12 lg9 class="mt-6">
          <div class="mt-6 mr-lg-12">
            <p class="text-2xl font-weight-bold">
              {{ quiz.name
              }}<span
                ><v-icon
                  class="ml-6"
                  @click="dialog = true"
                  color="primary_dark"
                  >mdi-pencil</v-icon
                ></span
              >
            </p>
            <p class="text--mini">
              <span>Description:</span> {{ quiz.description }}
            </p>
            <p class="text--mini"><span>Duration:</span> {{ quiz.minutes }} min</p>
          </div>
        </v-flex>
        <v-row justify="center">
          <v-dialog v-model="dialog" persistent max-width="600px">
            <v-card>
              <v-card-title>Quiz </v-card-title>
              <v-card-text>
                <v-container>
                  <v-form
                    ref="form"
                    class="mt-6"
                    v-model="valid"
                    lazy-validation
                  >
                    <v-text-field
                      v-model="form.name"
                      :rules="nameRules"
                      label="Name"
                      required
                      filled
                    ></v-text-field>
                    <v-textarea
                      v-model="form.description"
                      :rules="descriptionRules"
                      auto-grow
                      filled
                      color="deep-purple"
                      label="Description"
                      rows="1"
                    ></v-textarea>
                    <v-text-field
                      v-model="form.minutes"
                      :rules="minutesRules"
                      label="Duration of the quiz (in minutes)"
                      required
                      filled
                    ></v-text-field>
                  </v-form>
                </v-container>
                <small>*indicates required field</small>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="dialog = false">
                  Close
                </v-btn>
                <v-btn color="blue darken-1" text @click="update">
                  Update
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-row>
        <v-row justify="center">
          <v-dialog v-model="confirmationDialog" persistent max-width="600px">
            <v-card>
              <v-card-title> Delete this Quiz </v-card-title>
              <v-card-text>
                <p>
                  This action will remove definitively
                  <b>{{ quiz.name }}</b> quiz
                </p>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="blue darken-1"
                  text
                  @click="confirmationDialog = false"
                >
                  Close
                </v-btn>
                <v-btn color="red" class="white--text" @click="destroy(quiz)">
                  Delete
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-row>
        <div align="right">
          <inertia-link :href="route('question.create')">
            <v-btn right color="primary" class="py-6">
              <v-icon>mdi-plus</v-icon>
              Add new Question
            </v-btn>
          </inertia-link>
        </div>

        <v-alert
          border="top"
          class="mt-6 py-6"
          colored-border
          type="info"
          elevation="2"
        >
          List of Questions
        </v-alert>
        <v-row no-gutters v-if="quiz.questions.length != 0">
          <v-col
            v-for="(question, id) in quiz.questions"
            :key="id"
            cols="12"
            sm="4"
          >
            <v-card class="mx-auto mb-6" max-width="344">
              <v-card-text>
                <p class="text-md text--primary">
                  {{ question.question }}
                </p>
              </v-card-text>
              <v-card-actions>
                <inertia-link :href="route('question.edit', question.id)">
                  <v-btn text color="teal white--text"> View </v-btn>
                </inertia-link>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
        <div class="text-center mx-auto" v-else>
          <v-alert border="right" colored-border type="error" elevation="2">
            Question list is empty.<br />
            Click add button to add one .
          </v-alert>
          <div align="center" class="mx-2">
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
  name: "edit",
  components: {
    AppLayout,
  },
  props: ["quiz"],
  remember: "form",
  data() {
    return {
      dialog: false,
      confirmationDialog: false,
      valid: true,
      sending: false,
      multiLine: true,
      snackbar: true,
      form: {
        name: this.quiz.name,
        description: this.quiz.description,
        minutes: this.quiz.minutes,
      },
      nameRules: [(v) => !!v || "Name is required"],
      minutesRules: [(v) => !!v || "Duration of the quiz is required"],
      descriptionRules: [(v) => !!v || "Description is required"],
    };
  },
  methods: {
    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
    update: function () {
      if (this.$refs.form.validate()) {
        this.$inertia.put(this.route("quiz.update", this.quiz.id), this.form, {
          onStart: () => (this.sending = true),
          onFinish: () => (this.sending = false),
        });
      }
      this.dialog = false;
    },
    destroy(quiz) {
      quiz._method = "DELETE";
      this.$inertia.post("/quiz/" + quiz.id, quiz);
      this.confirmationDialog = false;
    },
  },
};
</script>

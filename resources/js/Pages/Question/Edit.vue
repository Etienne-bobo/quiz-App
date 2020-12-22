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
        <v-btn
          @click="confirmationDialog = true"
          color="red white--text"
          class="float-right"
        >
          Delete
        </v-btn>
        <v-flex xs12 sm12 md12 lg9 class="mt-6">
          <div class="mt-6 mr-lg-12">
            <p class="text-md font-weight-bold">
              {{ question.question
              }}<span
                ><v-icon
                  class="ml-6"
                  @click="dialog = true"
                  color="primary_dark"
                  >mdi-pencil</v-icon
                ></span
              >
            </p>
          </div>
        </v-flex>
        <v-row justify="center">
          <v-dialog v-model="dialog" persistent max-width="600px">
            <v-card>
              <v-card-title>Question </v-card-title>
              <v-card-text>
                <v-container>
                  <v-form
                    ref="form"
                    class="mt-6"
                    v-model="valid"
                    lazy-validation
                  >
                    <v-text-field
                      v-model="form.question"
                      :rules="questionRules"
                      label="Question"
                      required
                      filled
                    ></v-text-field>
                      <v-text-field
                      v-for="(answer, id) in form.options" :key="id"
                        v-model="answer.answer"
                        solo
                        label="Enter option"
                        clearable
                        :rules="optionRules"
                      >
                        <template v-slot:append-outer>
                          <v-switch
                            v-model="answer.is_correct"
                            inset
                            value
                            :input-value="id+1"
                          ></v-switch>
                        </template>
                      </v-text-field>
                  </v-form>
                </v-container>
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
              <v-card-title> Delete this Question </v-card-title>
              <v-card-text>
                <p>
                  This action will remove definitively
                  <b>{{ question.question }}</b> question
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
                <v-btn color="red" class="white--text" @click="destroy(question)">
                  Delete
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-row>
        <v-alert
          border="top"
          class="mt-6 py-6"
          colored-border
          type="info"
          elevation="2"
        >
          List of All Choices
        </v-alert>
        <v-row no-gutters>
          <v-col
            v-for="(answer, id) in question.answers"
            :key="id"
            cols="12"
            sm="4"
          >
            <v-card class="mx-auto mb-6" max-width="344">
              <v-card-text>
                <p class="text-md text--primary">
                  {{ id + 1 }} - {{ answer.answer }}
                </p>
              </v-card-text>
              <v-card-actions>
                <v-btn
                  v-if="answer.is_correct == 1"
                  color="success"
                  class="ml-2"
                >
                  Correct
                </v-btn>
                <v-btn
                  v-if="answer.is_correct == 0"
                  color="red lighten-1"
                  class="ml-2 white--text"
                >
                  Not correct
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
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
  props: ["question"],
  remember: "form",
  data() {
    return {
      dialog: false,
      confirmationDialog: false,
      valid: true,
      sending: false,
      multiLine: true,
      snackbar: true,
      attrs: {
        class: "mb-6",
        boilerplate: false,
        elevation: 2,
      },
      form: {
        question: this.question.question,
        options: this.question.answers,
        correct_answer: 1,
      },
      questionRules: [(v) => !!v || "Question is required"],
      optionRules: [(v) => !!v || "Option is required"],
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
        this.$inertia.put(
          this.route("question.update", this.question.id),
          this.form,
          {
            onStart: () => (this.sending = true),
            onFinish: () => (this.sending = false),
          }
        );
      }
      this.dialog = false;
    },
    destroy(question) {
      question._method = "DELETE";
      this.$inertia.post("/question/" + question.id, question);
      this.confirmationDialog = false;
    },
  },
};
</script>

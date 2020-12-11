<template>
  <v-app>
    <AppLayout />
    <v-row justify="center">
      <v-dialog v-model="dialog" persistent max-width="600px">
        <v-card>
          <v-card-title> </v-card-title>
          <v-card-text>
            <v-container>
              <v-form ref="form" class="mt-6" v-model="valid" lazy-validation>
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
            <inertia-link :href="route('quiz.index')">
              <v-btn color="blue darken-1" text @click="dialog = false">
                Close
              </v-btn>
            </inertia-link>
                        <v-btn color="blue darken-1" text @click="update"> Update </v-btn>

          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
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
      dialog: true,
      valid: true,
      sending: false,
      form: {
        name: this.quiz.name,
        description: this.quiz.description,
        minutes: this.quiz.minutes,
      },
      multiLine: true,
      snackbar: false,
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
         this.$inertia.put(this.route('quiz.update', this.quiz.id), this.form, {
        onStart: () => this.sending = true,
        onFinish: () => this.sending = false,
      })

      }
    },
  },
};
</script>
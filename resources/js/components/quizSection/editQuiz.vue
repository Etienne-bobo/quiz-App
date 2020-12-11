<template>
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
              <v-btn
                :disabled="!valid"
                color="primary"
                class="mr-4 px-16 py-6"
                @click="store(form)"
              >
                Create
              </v-btn>
            </v-form>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialog = false">
            Close
          </v-btn>
          <v-btn color="blue darken-1" text @click="dialog = false">
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
{{quiz}}
    </v-dialog>
  </v-row>
</template>
<script>
export default {
  props: {
      quiz: Object
  },
  data() {
    return {
      dialog: true,
      valid: true,
      form: {
        name: this.quiz.name,
        description: "",
        minutes: "",
      },
      multiLine: true,
      snackbar: false,
      nameRules: [(v) => !!v || "Name is required"],
      minutesRules: [(v) => !!v || "Duration of the quiz is required"],
      descriptionRules: [(v) => !!v || "Description is required"],
    };
  },
  methods: {
    validate() {
      this.$refs.form.validate();
    },
    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
    update: function (data) {
      if (this.$refs.form.validate()) {
        this.$inertia.post("/quiz", data);
        this.snackbar = true;
      }
    },
  },
};
</script>
<template>
  <v-main>
    <div align="center">
      <v-container>
        <v-alert border="top" colored-border type="info" elevation="2">
          Create Quiz
        </v-alert>
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
            type="number"
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
    </div>
  </v-main>
</template>
<script>
export default {
  data: () => ({
    valid: true,
    form: {
      name: "",
      description: "",
      minutes: "",
    },
    nameRules: [(v) => !!v || "Name is required"],
    minutesRules: [(v) => !!v || "Duration of the quiz is required"],
    descriptionRules: [(v) => !!v || "Description is required"],
  }),

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
    store: function (data) {
      if (this.$refs.form.validate()) {
        this.$inertia.post("/quiz", data);
        this.snackbar = true;
      }
    },
  },
};
</script>
<style scoped>
div {
  max-width: 650px;
  margin: auto;
  margin-top: 20px;
}
</style>
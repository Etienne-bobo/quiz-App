<template>
  <v-app>
    <AppLayout />
    <v-main>
      <v-container>
        <div class="mainSize" align="center">
          <v-alert border="top" colored-border type="info" elevation="2">
            Add a User
          </v-alert>
          <v-form ref="form" class="mt-6" v-model="valid" lazy-validation>
            <v-text-field
              v-model="form.name"
              :rules="nameRules"
              label="Enter name"
              required
              filled
            ></v-text-field>
            <v-text-field
              v-model="form.email"
              :rules="nameRules"
              label="Enter Email"
              required
              filled
            ></v-text-field>
            <v-text-field
              v-model="form.password"
              :rules="nameRules"
              label="Enter password"
              required
              filled
            ></v-text-field>
            <v-text-field
              v-model="form.occupation"
              :rules="nameRules"
              label="Enter Occupation"
              required
              filled
            ></v-text-field>
            <v-text-field
              v-model="form.address"
              :rules="nameRules"
              label="Enter Address"
              required
              filled
            ></v-text-field>
            <v-text-field
              v-model="form.phone"
              :rules="nameRules"
              label="Enter Phone"
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
        </div>
      </v-container>
    </v-main>
  </v-app>
</template>
<script>
import AppLayout from "../../Layouts/AppLayout";
export default {
  data() {
    return {
      valid: true,

      form: {
        name: "",
        email: "",
        password: "",
        occupation: "",
        address: "",
        phone: "",
      },
      nameRules: [(v) => !!v || "Name is required"],
      minutesRules: [(v) => !!v || "Duration of the quiz is required"],
      descriptionRules: [(v) => !!v || "Description is required"],
    };
  },
  components: {
    AppLayout,
  },
  props: ["quizzes"],
  methods: {
    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
    store: function (data) {
      if (this.$refs.form.validate()) {
        this.$inertia.post("/user", data);
        this.snackbar = true;
      }
    },
  },
};
</script>
<style scoped>
.mainSize {
  max-width: 650px;
  margin: auto;
  margin-top: 20px;
}
</style>
<template>
  <v-app>
    <AppLayout />
    <v-main>
      <v-container>
        <div class="mainSize" align="center">
          <v-alert border="top" colored-border type="info" elevation="2">
            Assign Quiz
          </v-alert>
          <v-form ref="form" class="mt-6" v-model="valid" lazy-validation>
            <v-select
              :items="quizzes"
              v-model="form.quiz_id"
              name="quiz"
              :rules="quizRules"
              item-value="id"
              item-text="name"
              label="Select a quiz"
            />
            <v-select
              :items="users"
              v-model="form.user_id"
              name="quiz"
              :rules="quizRules"
              item-value="id"
              item-text="name"
              label="Select a user"
            />
            <v-btn
              :disabled="!valid"
              color="primary"
              class="mr-4 px-16 py-6"
              @click="store(form)"
            >
              Assign
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
        user_id: "",
        quiz_id: "",
      },
      quizRules: [(v) => !!v || "Quiz is required"],
      questionRules: [(v) => !!v || "Question is required"],
      optionRules: [(v) => !!v || "Option is required"],
    };
  },
  components: {
    AppLayout,
  },
  props: ["quizzes", "users"],
  methods: {
    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
    store: function (data) {
      if (this.$refs.form.validate()) {
        this.$inertia.post("/exam/assign", data);
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
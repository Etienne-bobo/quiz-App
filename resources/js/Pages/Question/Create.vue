<template>
  <v-app>
    <AppLayout />
    <v-main>
      <div align="center">
        <v-container>
          <v-alert border="top" colored-border type="info" elevation="2">
            Add a Question
          </v-alert>
          <v-form ref="form" class="mt-6" v-model="valid" lazy-validation>
            <v-select
              :items="quizzes"
              v-model="quiz"
              name="quiz"
              item-text="name"
              label="Select a quiz"
            />
            <v-text-field
              v-model="form.question"
              :rules="nameRules"
              label="Enter Question"
              required
              filled
            ></v-text-field>

            <div v-for="n in 4" :key="n">
              <v-text-field v-model="options" solo label="Enter option" clearable>
                <template v-slot:append-outer>
                  <v-radio-group v-model="radioGroup">
                    <v-radio v-model="correct_answer" label="Correct option" :value="n"></v-radio>
                  </v-radio-group>
                </template>
              </v-text-field>
            </div>
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
  </v-app>
</template>
<script>
import AppLayout from "../../Layouts/AppLayout";
export default {
  data() {
    return {
      valid: true,
      radioGroup: 1,
      quiz: '',
      options: [],
      correct_answer:'',
      form: {
        question: "",
        description: "",
        minutes: "",
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
  max-width: 900px;
  margin: auto;
  margin-top: 20px;
}
</style>
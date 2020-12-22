<template>
  <v-app>
    <navBar />
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
      <v-container>
        <v-row v-if="isExamAssigned" class="mt-6" no-gutters>
          <v-col v-for="(quiz, id) in quizzes" :key="id" cols="12" sm="4">
            <v-card class="mx-auto mb-6" max-width="344">
              <v-card-text>
                <p class="text-md text--primary font-semibold uppercase">
                  {{ quiz.name }}
                </p>
                <p class="text-md text--primary">
                  Quiz is about: {{ quiz.description }}
                </p>
                <p class="text-md text--primary">
                  Duration:
                  <v-btn color="primary  lighten-2">
                    {{ quiz.minutes }} min
                  </v-btn>
                </p>
                <span> Total number of questions: </span>
                <span
                  v-for="q in questions"
                  :key="q"
                  class="text-md text--primary"
                >
                  <v-btn v-if="quiz.id == q.id" color="orange  lighten-1">
                    {{ q.questions.length }}
                  </v-btn>
                </span>
              </v-card-text>
              <v-card-actions>
                <inertia-link
                  v-if="!wasQuizCompleted.includes(quiz.id)"
                  :href="route('getQuizQuestions', quiz.id)"
                >
                  <v-btn color="success" class="ml-2"> Start Quiz </v-btn>
                </inertia-link>

                <inertia-link href="#" v-else>
                  <inertia-link
                    :href="
                      route('viewResult', { userId: authUser, quizId: quiz.id })
                    "
                  >
                    <v-btn color="success"> View Result </v-btn>
                  </inertia-link>
                  <v-btn color="red lighten-2" class="ml-2 white--text">
                    Completed
                  </v-btn>
                </inertia-link>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
        <v-row class="text-center mx-auto mt-6" v-else>
          <v-alert border="right" colored-border type="error" elevation="2">
            No quiz is assigned to you ..
          </v-alert>
          <div align="center" class="mx-2">
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
import navBar from "./Navbar";
export default {
  props: [
    "quizzes",
    "wasQuizCompleted",
    "isExamAssigned",
    "questions",
    "authUser",
  ],
  components: {
    navBar,
  },
  data() {
    return {
      multiLine: true,
      snackbar: true,
      attrs: {
        class: "mb-6",
        boilerplate: false,
        elevation: 2,
      },
    };
  },
};
</script>
<style scoped>
</style>
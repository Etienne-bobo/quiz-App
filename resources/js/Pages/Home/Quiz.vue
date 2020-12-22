<template>
  <v-app>
    <navBar />
    <v-main>
      <v-card class="mx-auto mb-6 mt-6" max-width="600">
        <v-card-title class="uppercase">{{ quiz.name }}</v-card-title>
        <div class="pt-4 pb-16 px-6">
          <div class="font-semibold text-lg text-center mb-4">
            Online Examination
          </div>
          <div class="blue--text">
            Question attempted:{{ questionIndex }}/{{ quizQuestions.length }}
          </div>
          <br />
          <div class="float-right red--text">{{ time }}</div>
        </div>
        <v-divider></v-divider>
        <v-card-text class="px-8">
          <span v-for="(question, id) in quizQuestions" :key="id">
            <span v-if="id === questionIndex">
              <p class="text-md mb-8 text--primary">
                {{ id + 1 }} : {{ question.question }}
              </p>
              <v-text-field
                v-for="choice in question.answers"
                :key="choice"
                v-model="choice.answer"
                label="Solo"
                height="50"
                solo
                readonly
                rounded
              >
                <template v-slot:prepend-inner>
                  <v-radio-group v-model="userResponses[id]">
                    <v-radio
                       
                      :value="choice.is_correct == true ? true : choice.answer"
                      name="id"
                      @click="choices(question.id, choice.id)"
                    ></v-radio>
                  </v-radio-group>
                </template>
              </v-text-field>
            </span>
          </span>
        </v-card-text>
        <div class="mb-16 px-6" v-if="questionIndex != quizQuestions.length">
          <v-btn
            v-if="questionIndex > 0"
            text
            color="secondary"
            class="ml-2 float-left"
            @click="prev"
          >
            <v-icon>mdi-rewind</v-icon>
            previous
          </v-btn>
          <v-btn
            text
            color="primary"
            class="ml-2 white--text float-right"
            @click="postUserChoices"
          >
            Next
            <v-icon>mdi-fast-forward</v-icon>
          </v-btn>
        </div>
        <div
          class="text-center py-6"
          v-if="questionIndex === quizQuestions.length"
        >
          <v-alert dense text type="success">
            You have successfully Completed this <strong>quiz</strong>
          </v-alert>
          <p>
            Your Score is : <b>{{ score() }}/{{ quizQuestions.length }}</b>
          </p>
          <inertia-link :href="route('home')">
            <v-btn class="my-6" color="primary"> Go home </v-btn>
          </inertia-link>
        </div>
      </v-card>
    </v-main>
  </v-app>
</template>

<script>
import navBar from "./Navbar";
import moment from "moment";
export default {
  name: "attemptQuiz",
  components: { navBar },
  props: ["quizQuestions", "quiz", "times", "authUserHasPlayedQuiz"],
  data() {
    return {
      radioGroup: 0,
      questionIndex: 0,
      userResponses: Array(this.quizQuestions.length).fill(false),
      currentQuestion: 0,
      currentAnswer: 0,
      clock: moment(this.times * 60 * 1000 - 1800000),
    };
  },
  mounted() {
    setInterval(() => {
      this.clock = moment(this.clock.subtract(1, "seconds"));
    }, 1000);
  },
  computed: {
    time() {
      var minsec = this.clock.format("mm:ss");
      if (minsec == "00:00") {
        alert("Timeout !!!");
        window.location.reload();
      }
      return minsec;
    },
  },
  methods: {
    prev() {
      this.questionIndex--;
    },
    choices(question, answer) {
      (this.currentAnswer = answer), (this.currentQuestion = question);
    },
    score() {
      return this.userResponses.filter((val) => {
        return val === true;
      }).length;
    },
    postUserChoices() {
      this.questionIndex++;
      axios.post("/quiz/test", {
        answerId: this.currentAnswer,
        questionId: this.currentQuestion,
        quizId: this.quiz.id,
      });
    },
  },
};
</script>
<style scoped>
</style>
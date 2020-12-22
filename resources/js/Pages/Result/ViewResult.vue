<template>
  <v-app>
    <AppLayout />
    <v-main>
      <v-card class="mx-auto mb-6 mt-6" max-width="600">
        <div class="pt-4 pb-16">
          <v-card-title v-if="attemptQuestion == 0" class="uppercase red--text">User didn't play this Quiz </v-card-title>
          <div class="font-semibold text-lg text-center">User Result</div>
          <div class="font-semibold mx-6 text-lg">
              
              Score: {{userCorrectedAnswer}}/{{totalQuestions}}</div>
        </div>
        <v-divider></v-divider>
        <v-card-text
          class="px-8 mb-8 float-left"
          v-for="(q, id) in quiz"
          :key="id"
        >
          <div class="text-md mb-6">
            Quiz: <b> {{ q.name }} </b>
          </div>
          <div class="text-md mb-6">
            Total Question: <v-btn class="float-right" color="primary"> {{ totalQuestions }} </v-btn>
          </div>
          <div class="text-md mb-6">
             Attempt Question: <v-btn class="float-right" color="orange"> {{ attemptQuestion }} </v-btn>
          </div>
          <div class="text-md mb-6">
              Correct answer: <v-btn class="float-right" color="success"> {{ userCorrectedAnswer }}  </v-btn>
          </div>
          <div class="text-md mb-6">
              Wrong answer: <v-btn color="red" class="float-right white--text">{{ userWrongAnswer }} </v-btn> 
          </div>
          <div v-if="attemptQuestion" class="text-md mb-6">
            Percentage: <b> {{ percentage.toFixed(2) }} % </b>
          </div>
          <div v-else>
              Percentage: 0 %
          </div>
          
        </v-card-text>
        <v-card-text
          class="px-8 mb-8"
          v-for="(result, id) in results"
          :key="id"
        >
          <div class="text-md mb-6">
            {{ id + 1 }} - {{ result.question.question }}
          </div>
          <div v-for="ans in answers" :key="ans">
            <v-text-field
              v-if="ans.question_id == result.question_id"
              v-model="ans.answer"
              label="Solo"
              class="text-sm"
              height="50"
              solo
              readonly
              rounded
            >
              <template v-slot:prepend-inner>
                <v-icon v-if="ans.is_correct == 1" dark color="success"> mdi-check-circle </v-icon>
              </template>
            </v-text-field>
            
         
          </div>
           <div class="float-left">
            <span class="font-semibold text-md"> User answer:</span>
            <v-btn color="orange lighten-1" class="ml-2" text>
              {{ result.answer.answer }}</v-btn
            >
          </div>
          <div v-for="ans in answers" :key="ans">
              <div v-if="result.answer_id == ans.id && ans.is_correct == 1">
              <v-btn color="success lighten-2">
                  correct
              </v-btn>
          </div>
          </div>
          
        </v-card-text>
      </v-card>
    </v-main>
  </v-app>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
export default {
  name: "viewResult",
  components: { AppLayout },
  props: [
    "results",
    "quiz",
    "totalQuestions",
    "attemptQuestion",
    "userCorrectedAnswer",
    "userWrongAnswer",
    "percentage",
    "answers"
  ],

  data() {
    return {};
  },

  methods: {},
};
</script>
<style scoped>
</style>
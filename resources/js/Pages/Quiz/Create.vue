<template>
    <v-app>
        <createQuiz />
        <AppLayout />
    </v-app>
</template>
<script>
import createQuiz from "../../components/quizSection/createQuiz"
import AppLayout from "../../Layouts/AppLayout";
export default {
    name: "create",
    components: {
        createQuiz,
        AppLayout
    }
}
</script>
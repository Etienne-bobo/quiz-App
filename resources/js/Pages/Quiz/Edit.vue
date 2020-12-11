<template>
    <v-app>
        <editQuiz />
        <AppLayout />
    </v-app>
</template>
<script>
import editQuiz from "../../components/quizSection/editQuiz"
import AppLayout from "../../Layouts/AppLayout";
export default {
    name: "edit",
    components: {
        editQuiz,
        AppLayout
    }
}
</script>
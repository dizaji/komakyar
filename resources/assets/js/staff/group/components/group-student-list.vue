<template>
    <div>
        <student-card></student-card>
    </div>
</template>
<script>
    import StudentCard from '../../student/components/student-card.vue'

    export default {
        components: {
            'student-card': StudentCard
        }
    }
</script>
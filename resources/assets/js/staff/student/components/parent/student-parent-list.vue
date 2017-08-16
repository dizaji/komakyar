<template>
    <div>
        <student-parent-create :student="student" :on-create="parentCreated"></student-parent-create>
        <student-parent-card></student-parent-card>
    </div>
</template>
<script>
    import StudentParentCreate from './student-parent-create.vue';
    import StudentParentCard from './student-parent-card.vue';

    export default {
        props: ['student'],
        data: function () {
            return {
                mode: 'show'
            }
        },
        components: {
            'student-parent-card': StudentParentCard,
            'student-parent-create': StudentParentCreate,
        },
        methods: {
            parentCreated(response){
                console.log(response);
            }
        }
    }
</script>

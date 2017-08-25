<template>
    <div>
        <div class="row">
            <div class="col-xs-12 text-left">
                <add-student :group="group"></add-student>
            </div>
        </div>
        <!--<student-card></student-card>-->
    </div>
</template>
<script>
    import StudentCard from '../../student/components/student-card.vue'
    import AddStudent from './group-add-student.vue'
    export default {
        props: ['group'],
        data: function () {
            return {};
        },
        components: {
            'student-card': StudentCard,
            'add-student': AddStudent,
        }
    }
</script>
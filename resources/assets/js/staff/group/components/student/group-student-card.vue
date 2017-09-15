<template>
    <student-card :student="student">
        <template slot="buttons">
            <button class="btn btn-sm btn-danger" v-on:click="$refs.confirm_delete_modal.show()">
                <span class="glyphicon glyphicon-trash"></span>
            </button>
            <confirm-delete-modal ref="confirm_delete_modal"
                                  v-on:confirm="detach(student)">
                <span>آیا برای حذف دانش آموز از گروه مطمئن هستید؟</span>
            </confirm-delete-modal>
        </template>
    </student-card>
</template>
<script>
    import StudentCard from '../../../student/components/student-card'

    export default {
        props: ['student', 'group'],
        components: {
            'student-card': StudentCard,
        },
        methods: {
            detach: function (student) {
                this.$Progress.start();
                axios.delete(route('staff.group.student.destroy', {group: this.group.id, student: student.id}))
                    .then(response => this.onDetachSuccess(response, student))
                    .catch(this.onError)
            },
            onDetachSuccess(response, student) {
                this.$emit('detached', student);
                this.$Progress.finish();
            },
            onError(error) {
                this.$Progress.fail();
                alert("Oops, Something went wrong!!!");
                console.log(error.response);
            }
        }
    }
</script>
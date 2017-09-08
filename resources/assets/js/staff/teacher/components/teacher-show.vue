<template>
    <div class="container" v-if="teacher">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12">{{ teacher.user.first_name }} {{ teacher.user.surname }}</div>
                </div>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#general" aria-controls="general" role="tab" data-toggle="tab">اطلاعات کلی</a>
                    </li>

                    <li role="presentation">
                        <a href="#password" aria-controls="password" role="tab" data-toggle="tab">گذر واژه</a>
                    </li>

                    <li role="presentation">
                        <a href="#accesslevel" aria-controls="accesslevel" role="tab" data-toggle="tab">سطح دسترسی</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="general">
                        <teacher-general-info :teacher="teacher"></teacher-general-info>
                    </div>


                    <div role="tabpanel" class="tab-pane fade" id="password">
                        <teacher-change-password :teacher="teacher"></teacher-change-password>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="accesslevel">
                        ......
                    </div>
                </div>
            </div>
        </div>
        <vue-progress-bar></vue-progress-bar>
    </div>
</template>
<script>
    import TeacherGeneralInfo from './teacher-general-info.vue'
    import TeacherChangePassword from './teacher-change-password.vue'
//    import StudentParentList from './parent/student-parent-list.vue'

    export default {

        props: ['id'],

        data: function () {
            return {
                teacher: null
            }
        },

        components: {
            'teacher-general-info': TeacherGeneralInfo,
            'teacher-change-password': TeacherChangePassword,
//            'student-parent-list': StudentParentList,
        },

        mounted() {
            this.load();
        },

        methods: {
            load() {
                this.$Progress.start();
                axios.get(route('staff.teacher.show', {teacher: this.id}))
                    .then(this.onLoadSuccess)
                    .catch(this.onLoadError);
            },

            onLoadSuccess: function (response) {
                this.teacher = response.data;
                this.$Progress.finish();
            },

            onLoadError: function (error) {
                this.$Progress.fail();
                alert("Oops, Something went wrong!!!");
                console.log(error.response);
            },
        }
    }

</script>

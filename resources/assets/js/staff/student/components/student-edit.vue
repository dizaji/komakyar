<template>
    <div class="container" v-if="student">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12">{{ student.user.first_name }} {{ student.user.surname }}</div>
                </div>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#general" aria-controls="general" role="tab" data-toggle="tab">اطلاعات کلی</a>
                    </li>
                    <li role="presentation">
                        <a href="#parents" aria-controls="parents" role="tab" data-toggle="tab" v-on:click="$refs.parent_list.loadData()">والدین</a>
                    </li>
                    <li role="presentation">
                        <a href="#groups" aria-controls="groups" role="tab" data-toggle="tab">گروه ها</a>
                    </li>
                    <li role="presentation">
                        <a href="#password" aria-controls="password" role="tab" data-toggle="tab">گذر واژه</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="general">
                        <student-general-info :student="student"></student-general-info>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="parents">
                        <student-parent-list :student="student" ref="parent_list"></student-parent-list>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="groups">...</div>
                    <div role="tabpanel" class="tab-pane fade" id="password">
                        <student-change-password :student="student"></student-change-password>
                    </div>
                </div>
            </div>
        </div>
        <vue-progress-bar></vue-progress-bar>
    </div>
</template>
<script>
    import StudentGeneralInfo from './student-general-info.vue'
    import StudentChangePassword from './student-change-password.vue'
    import StudentParentList from './parent/student-parent-list.vue'

    export default {

        props: {
            id: {}
        },

        data: function () {
            return {
                student: null
            }
        },

        components: {
            'student-general-info': StudentGeneralInfo,
            'student-change-password': StudentChangePassword,
            'student-parent-list': StudentParentList,
        },

        mounted() {
            this.load();
        },

        methods: {
            load() {
                this.$Progress.start();
                axios.get(route('staff.student.edit', {student: this.id}))
                    .then(this.onLoadSuccess)
                    .catch(this.onError);
            },

            onLoadSuccess: function (response) {
                this.student = response.data;
                this.$Progress.finish();
            },

            onError: function (error) {
                this.$Progress.fail();
                alert("Oops, Something went wrong!!!");
                console.log(error.response);
            },
        }
    }

</script>

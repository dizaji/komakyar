<template>
    <div class="container" v-if="group">
        <div class="row">
            <div class="col-md-12 float-none">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">گروه شماره 101</div>
                            <div class="col-xs-6 text-left">
                                <a class="btn btn-sm btn-primary"
                                   data-toggle="tooltip"
                                   data-placement="bottom"
                                   title="ویرایش">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="panel-body">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#general"
                                       aria-controls="general"
                                       role="tab"
                                       data-toggle="tab">اطلاعات کلی</a>
                                </li>
                                <li role="presentation">
                                    <a href="#parents"
                                       aria-controls="parents"
                                       role="tab"
                                       data-toggle="tab">
                                       <!--v-on:click="$refs.students_list.loadData()">-->دانش آموزان</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="general">
                                    <group-general-info :group="group"></group-general-info>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="parents">
                                    <!--<group-student-list :group="group" ref="students_list"></group-student-list>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <vue-progress-bar></vue-progress-bar>
    </div>
</template>
<script>
    import GeneralInfo from './group-general-info.vue'
    import StudentList from './group-student-list.vue'

    export default {

        props: ['id'],

        data() {
            return {
                group: null
            }
        },
        components: {
            'group-general-info': GeneralInfo,
            'group-student-list': StudentList,
        },
        mounted() {
            this.load();
        },
        methods: {
            load() {
                this.$Progress.start();
                axios.get(route('staff.group.show', {group: this.id}))
                    .then(this.onLoadSuccess)
                    .catch(this.onError);
            },
            onLoadSuccess: function (response) {
                this.group = response.data;
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

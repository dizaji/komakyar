<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 float-none">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6"> لیست دبیران</div>
                            <div class="col-xs-6 text-left">
                                <teacher-create></teacher-create>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <!--<teacher-search-panel v-on:search="doSearch"></teacher-search-panel>-->
                        <template v-if="teachers">

                            <template v-for="teacher in teachers.data">

                                <teacher-card :teacher="teacher"></teacher-card>

                            </template>
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <pagination :data="teachers" v-on:pagination-change-page="loadData"></pagination>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <vue-progress-bar></vue-progress-bar>
    </div>
</template>
<script>
    import TeacherCard from './teacher-card.vue'
    import TeacherCreate from './teacher-create.vue'
//    import TeacherSearchPanel from './teacher-search-panel.vue'

    export default {
        data() {
            return {
                teachers: null,
                current_page: 1,
                search: {}
            }
        },
        components: {
            'teacher-card': TeacherCard,
            'teacher-create': TeacherCreate,
//            'teacher-search-panel': TeacherSearchPanel,
        },
        created: function () {
            this.loadData();
        },
        methods: {
            loadData: function (page) {
                this.$Progress.start();
//                this.parents = null;
                console.log(page);
                if (typeof page === 'undefined') {
                    page = this.current_page;
                } else {
                    this.current_page = page;
                }

                // Using vue-resource as an example
                axios.get(route('staff.teacher.index'), {
                    params: Object.assign(this.search, {page: page})
                })
                    .then(this.onLoadSuccess)
                    .catch(this.onLoadError);

            },
            onLoadSuccess(response) {
                this.teachers = response.data;
                this.$Progress.finish();
                console.log("response =",response.data);
            },
            onLoadError: function (error) {
                this.$Progress.fail();
                alert("Oops, Something went wrong in teacher list!!!");
                console.log(error.response);
            },
            doSearch: function (search) {
                this.search = search;
                this.loadData(1)
            }
        }
    }

</script>

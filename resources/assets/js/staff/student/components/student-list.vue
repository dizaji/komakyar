<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 float-none">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6"> لیست دانش آموزان</div>
                            <div class="col-xs-6 text-left">
                                <student-create></student-create>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <student-search-panel v-on:search="doSearch"></student-search-panel>
                        <template v-if="students">
                            <template v-for="student in students.data">
                                <student-card :student="student"></student-card>
                            </template>
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <pagination :data="students" v-on:pagination-change-page="loadData"></pagination>
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
    import StudentCard from './student-card.vue'
    import StudentCreate from './student-create.vue'
    import StudentSearchPanel from './student-search-panel.vue'

    export default {
        data() {
            return {
                students: null,
                current_page: 1,
                search: {}
            }
        },
        components: {
            'student-card': StudentCard,
            'student-create': StudentCreate,
            'student-search-panel': StudentSearchPanel,
        },
        created: function () {
            this.loadData();
        },
        methods: {
            loadData: function (page) {
                this.$Progress.start();
                this.parents = null;

                if (typeof page === 'undefined') {
                    page = this.current_page;
                } else {
                    this.current_page = page;
                }

                // Using vue-resource as an example
                axios.get(route('staff.student.index'), {
                    params: Object.assign(this.search, {page: page})
                })
                    .then(this.onLoadSuccess)
                    .catch(this.onLoadError);
            },
            onLoadSuccess(response) {
                this.students = response.data;
                this.$Progress.finish();
            },
            onLoadError: function (error) {
                this.$Progress.fail();
                alert("Oops, Something went wrong!!!");
                console.log(error.response);
            },
            doSearch: function (search) {
                this.search = search;
                this.loadData(1)
            }
        }
    }

</script>

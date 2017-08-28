<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 float-none">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">گروه ها</div>
                            <div class="col-xs-6 text-left">
                                <course-source-create v-on:created="courseSourceCreated"></course-source-create>
                            </div>
                        </div>
                    </div>
                    <div>

                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>نام منبع</th>
                                <th>کد منبع</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input class="form-control input-sm"
                                           placeholder="احمد"
                                           v-model="search.reference_name"/>
                                </td>
                                <td>
                                    <input class="form-control input-sm"
                                           placeholder="حسنی"
                                           v-model="search.reference_code"/>
                                </td>
                                <td></td>
                            </tr>
                            <template v-if="course_sources">
                                <template v-for="course_source in course_sources.data">
                                    <course-source-row :course_source="course_source" v-on:deleted="loadData"></course-source-row>
                                </template>
                            </template>
                            </tbody>
                        </table>
                        <template  v-if="course_sources">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <pagination :data="course_sources" v-on:pagination-change-page="loadData"></pagination>
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
    import CourseSourceRow from './course-source-row.vue'
    import CourseSourceCreate from './course-source-create.vue'

    export default{
        data(){
            return{
                course_sources: {
                    data: []
                },
                search: {
                    reference_code: '',
                    reference_name: '',
                },
                current_page: 1,
            }
        },
        components:{
            'course-source-row': CourseSourceRow,
            'course-source-create': CourseSourceCreate,
        },
        watch: {
            search: {
                handler: function (newSearch) {
                    this.searchChanged();
                },
                deep: true
            }
        },
        created: function(){
            this.loadData();
        },
        methods: {
            searchChanged: _.debounce(
                function(){
                    this.loadData();
                },
                500
            ),
            loadData: function(page){
                this.$Progress.start();

                if (typeof page === 'undefined') {
                    page = this.current_page;
                } else {
                    this.current_page = page;
                }

                // Using vue-resource as an example
                axios.get(route('staff.lookup.course.source.index'), {
                    params: Object.assign(this.search, {page: page})
                })
                    .then(this.onLoadSuccess)
                    .catch(this.onLoadError);
            },

            onLoadSuccess: function(response){
                console.log(response.data);
                this.course_sources = response.data;
                this.$Progress.finish();
            },

            onLoadError: function(error){
                alert('Oops! Some thing went wrong. :(');
                this.$Progress.fail();
                console.log(error);

            },

            courseSourceCreated: function (course_source) {
                this.course_sources.data.unshift(course_source);
            }
        }
    }

</script>

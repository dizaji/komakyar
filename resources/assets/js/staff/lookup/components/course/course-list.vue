<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 float-none">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">گروه ها</div>
                            <div class="col-xs-6 text-left">
                                <course-create v-on:created="courseCreated"></course-create>
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
                                           placeholder="فیزیک 1"
                                           v-model="search.title"/>
                                </td>
                                <td>
                                    <input class="form-control input-sm"
                                           placeholder="3"
                                           v-model="search.multiplier"/>
                                </td>
                                <td>
                                    <input class="form-control input-sm"
                                           placeholder="فیزیک 1 و آزمایشگاه"
                                           v-model="search.reference_name"/>
                                </td>
                                <td>
                                    <input class="form-control input-sm"
                                           placeholder="135/25"
                                           v-model="search.reference_code"/>
                                </td>
                                <td></td>
                            </tr>
                            <template v-if="courses">
                                <template v-for="course in courses.data">
                                    <course-row :course="course" v-on:deleted="loadData"></course-row>
                                </template>
                            </template>
                            </tbody>
                        </table>
                        <template  v-if="courses">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <pagination :data="courses" v-on:pagination-change-page="loadData"></pagination>
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
    import CourseRow from './course-row.vue'
    import CourseCreate from './course-create.vue'

    export default{
        data(){
            return{
                courses: {
                    data: []
                },
                search: {
                    title: '',
                    multiplier: '',
                    reference_code: '',
                    reference_name: '',
                },
                current_page: 1,
            }
        },
        components:{
            'course-row': CourseRow,
            'course-create': CourseCreate,
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
                axios.get(route('staff.lookup.course.index'), {
                    params: Object.assign(this.search, {page: page})
                })
                    .then(this.onLoadSuccess)
                    .catch(this.onLoadError);
            },

            onLoadSuccess: function(response){
                this.courses = response.data;
                this.$Progress.finish();
            },

            onLoadError: function(error){
                alert('Oops! Some thing went wrong. :(');
                this.$Progress.fail();
                console.log(error);

            },

            courseCreated: function (course) {
                this.courses.data.unshift(course);
            }
        }
    }

</script>

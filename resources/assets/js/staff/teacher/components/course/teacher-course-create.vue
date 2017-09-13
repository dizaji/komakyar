<template>
    <div class="margin-10">
        <button class="btn btn-sm btn-success"
                data-toggle="tooltip"
                data-placement="bottom"
                title="ارائه درس"
                v-on:click="showModal">
            <span class="glyphicon glyphicon-plus"></span> ارائه درس
        </button>
        <div class="modal fade"
             ref="create_presentation_modal"
             tabindex="-1"
             role="dialog"
             aria-labelledby="add-new-presentation-title">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="add-new-presentation-title">افزودن درس</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>نام درس</th>
                                <th>ضریب</th>
                                <th>منبع</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input class="form-control input-sm"
                                           placeholder="فیزیک یک"
                                           v-model="search.title"/>
                                </td>
                                <td>
                                    <input class="form-control input-sm"
                                           placeholder="1"
                                           type="number"
                                           v-model="search.multiplier"/>
                                </td>
                                <td>
                                    <input class="form-control input-sm"
                                           placeholder="فیزیک و آزمایشگاه"
                                           v-model="search.reference_name"/>
                                </td>
                                <td></td>
                            </tr>
                            <template v-if="courses">
                                <tr v-for="course in courses.data">
                                    <td>{{ course.title }}</td>
                                    <td>{{ course.multiplier }}</td>
                                    <td>{{ course.reference_name }}</td>
                                    <td>
                                        <button class="btn btn-xs btn-success"
                                                v-if="course.presentations.length === 0"
                                                v-on:click="attach(course)">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                        <button class="btn btn-xs btn-danger"
                                                v-else=""
                                                v-on:click="detach(course.presentations[0])">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                            </tbody>
                        </table>
                        <div class="row" v-if="courses">
                            <div class="col-xs-12 text-center">
                                <pagination :data="courses" v-on:pagination-change-page="loadCourses"></pagination>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['teacher'],
        data() {
            return {
                search: {
                    reference_name: '',
                    multiplier: '',
                    title: '',
                    teacher_id: this.teacher.id,
                },
                courses: null,
                errors: {},
            }
        },
        watch: {
            search: {
                handler: function (newSearch) {
                    this.searchChanged();
                },
                deep: true
            }
        },
        methods: {
            searchChanged: _.debounce(
                function () {
                    this.loadData();
                },
                500
            ),
            loadCourses: function (page) {
                this.$Progress.start();
                this.errors = {};

                if (typeof page === 'undefined') {
                    page = this.current_page;
                } else {
                    this.current_page = page;
                }


                axios.get(route('staff.lookup.course.index'), {
                    params: Object.assign(this.search, {page: page})
                })
                    .then(this.onLoadCoursesSuccess)
                    .catch(this.onError);
            },
            onLoadCoursesSuccess: function (response) {
                this.courses = response.data;
                this.$Progress.finish();
            },
            attach(course) {
                this.$Progress.start();
                this.errors = [];

                axios.post(route('staff.teacher.presentation.store', {teacher: this.teacher.id}), {
                    course_id: course.id,
                })
                    .then(this.onAttachSuccess)
                    .catch(this.onError)
            },
            onAttachSuccess(response) {
                this.$Progress.finish();
                this.$emit('attached', response);
                this.loadCourses();
            },
            detach(presentation) {
                this.$Progress.start();
                this.errors = [];

                axios.delete(route('staff.teacher.presentation.destroy', {
                    teacher: this.teacher.id, presentation: presentation.id
                }))
                    .then(this.onDetachSuccess)
                    .catch(this.onError)
            },
            onDetachSuccess(response) {
                this.$Progress.finish();
                this.$emit('detached', response);
                this.loadCourses();
            },
            onError(error) {
                console.log(error);
                this.$Progress.fail();
                if (error.response.status === 422) {
                    this.errors = error.response.data;
                } else {
                    alert("Oops, Something went wrong!!!");
                }
                console.log(error.response);
            },
            showModal: function () {
                this.loadCourses();
                $(this.$refs.create_presentation_modal).modal('show');
            },
            hideModal: function () {
                $(this.$refs.create_presentation_modal).modal('hide');
            },
        }
    }
</script>

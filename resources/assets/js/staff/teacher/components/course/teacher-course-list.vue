<template>
    <div>
        <teacher-course-create :teacher="teacher" v-on:created="onParentCreated"></teacher-course-create>

        <template v-if="presentations">
            <template v-for="presentation in presentations.data">
                <teacher-course-card :teacher="teacher" :course="presentation" v-on:delete="loadData"></teacher-course-card>
            </template>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <pagination :data="presentations" v-on:pagination-change-page="loadData"></pagination>
                </div>
            </div>
        </template>
    </div>
</template>
<script>
    import TeacherCourseCreate from './teacher-course-create.vue';
    import TeacherCourseCard from './teacher-course-card.vue';

    export default {
        props: ['teacher'],
        data: function () {
            return {
                mode: 'show',
                presentations: null,
                current_page: 1,
            }
        },
        components: {
            'teacher-course-card': TeacherCourseCard,
            'teacher-course-create': TeacherCourseCreate,
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
                axios.get(route('staff.teacher.course.index', {teacher: this.teacher.id}), {
                    params: {
                        page: page
                    }
                })
                    .then(this.onLoadSuccess)
                    .catch(this.onError);
            },

            onLoadSuccess(response) {
                this.parents = response.data;
                this.$Progress.finish();
            },

            onError: function (error) {
                this.$Progress.fail();
                alert("Oops, Something went wrong!!!");
                console.log(error.response);
            },

            onParentCreated(response) {
                this.loadData(this.current_page = 1);
            }
        }
    }
</script>

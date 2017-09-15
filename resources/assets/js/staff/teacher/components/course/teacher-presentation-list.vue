<template>
    <div>
        <teacher-presentation-create :teacher="teacher" v-on:attached="loadData()" v-on:detached="loadData()"></teacher-presentation-create>

        <template v-if="presentations">
            <template v-for="presentation in presentations.data">
                <teacher-presentation-card :teacher="teacher" :presentation="presentation" v-on:delete="loadData"></teacher-presentation-card>
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
    import TeacherPresentationCreate from './teacher-presentation-create.vue';
    import TeacherPresentationCard from './teacher-presentation-card.vue';

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
            'teacher-presentation-card': TeacherPresentationCard,
            'teacher-presentation-create': TeacherPresentationCreate,
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
                axios.get(route('staff.teacher.presentation.index', {teacher: this.teacher.id}), {
                    params: {
                        page: page
                    }
                })
                    .then(this.onLoadSuccess)
                    .catch(this.onError);
            },

            onLoadSuccess(response) {
                this.presentations = response.data;
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

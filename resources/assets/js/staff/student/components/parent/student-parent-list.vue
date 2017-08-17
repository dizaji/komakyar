<template>
    <div>
        <student-parent-create :student="student" v-on:created="onParentCreated"></student-parent-create>

        <template v-if="parents">
            <template v-for="parent in parents.data">
                <student-parent-card :student="student" :parent="parent" v-on:delete="loadData"></student-parent-card>
            </template>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <pagination :data="parents" v-on:pagination-change-page="loadData"></pagination>
                </div>
            </div>
        </template>
    </div>
</template>
<script>
    import StudentParentCreate from './student-parent-create.vue';
    import StudentParentCard from './student-parent-card.vue';

    export default {
        props: ['student'],
        data: function () {
            return {
                mode: 'show',
                parents: null,
                current_page: 1,
            }
        },
        components: {
            'student-parent-card': StudentParentCard,
            'student-parent-create': StudentParentCreate,
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
                axios.get(route('staff.student.parent.index', {student: this.student.id}), {
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

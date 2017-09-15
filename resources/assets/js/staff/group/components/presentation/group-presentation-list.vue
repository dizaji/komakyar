<template>
    <div>
        <div class="row">
            <div class="col-xs-12 text-left">
                <group-presentation-add :group="group" v-on:attached="loadData()" v-on:detached="loadData()"></group-presentation-add>
            </div>
        </div>
        <div class="row margin-10">
            <group-student-search-panel v-on:search="doSearch"></group-student-search-panel>
            <template v-if="students">
                <template v-for="student in students.data">
                    <group-student-card :student="student" :group="group" v-on:detached="loadData()"></group-student-card>
                </template>
                <div class="col-xs-12 text-center">
                    <pagination :data="students" v-on:pagination-change-page="loadData"></pagination>
                </div>
            </template>
        </div>
    </div>
</template>
<script>
    import GroupStudentCard from './group-presentation-card.vue'
    import GroupStudentSearchPanel from './group-presentation-search-panel.vue'
    import GroupPresentationAdd from './group-presentation-add.vue'

    export default {
        props: ['group'],
        data: function () {
            return {
                students: null,
                search: {},
            };
        },
        components: {
            'group-student-card': GroupStudentCard,
            'group-student-search-panel': GroupStudentSearchPanel,
            'group-presentation-add': GroupPresentationAdd,
        },
        methods: {
            loadData: function (page) {
                this.$Progress.start();
                this.errors = {};

                if (typeof page === 'undefined') {
                    page = this.current_page;
                } else {
                    this.current_page = page;
                }

                axios.get(route('staff.group.student.index', {group: this.group.id}), {
                    params: Object.assign(this.search, {page: page})
                })
                    .then(this.onLoadSuccess)
                    .catch(this.onLoadError);
            },
            onLoadSuccess: function (response) {
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
                this.loadData(1);
            }
        }
    }
</script>
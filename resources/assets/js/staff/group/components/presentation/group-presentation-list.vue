<template>
    <div>
        <div class="row">
            <div class="col-xs-12 text-left">
                <group-presentation-add :group="group" v-on:attached="loadData()" v-on:detached="loadData()"></group-presentation-add>
            </div>
        </div>
        <div class="row margin-10">
            <group-presentation-search-panel v-on:search="doSearch"></group-presentation-search-panel>
            <template v-if="groupPresentedCourses">
                <template v-for="groupPresentedCourse in groupPresentedCourses.data">
                    <group-presentation-card :group-presented-course="groupPresentedCourse" :group="group" v-on:deleted="loadData()"></group-presentation-card>
                </template>
                <div class="col-xs-12 text-center">
                    <pagination :data="groupPresentedCourses" v-on:pagination-change-page="loadData"></pagination>
                </div>
            </template>
        </div>
    </div>
</template>
<script>
    import GroupPresentationCard from './group-presentation-card.vue'
    import GroupPresentationSearchPanel from './group-presentation-search-panel.vue'
    import GroupPresentationAdd from './group-presentation-add.vue'

    export default {
        props: ['group'],
        data: function () {
            return {
                groupPresentedCourses: null,
                search: {},
            };
        },
        components: {
            'group-presentation-card': GroupPresentationCard,
            'group-presentation-search-panel': GroupPresentationSearchPanel,
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

                axios.get(route('staff.group.groupPresentedCourse.index', {group: this.group.id}), {
                    params: Object.assign(this.search, {page: page})
                })
                    .then(this.onLoadSuccess)
                    .catch(this.onLoadError);
            },
            onLoadSuccess: function (response) {
                this.groupPresentedCourses = response.data;
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
<template>
    <div>
        <button class="btn btn-sm btn-success"
                data-toggle="tooltip"
                data-placement="bottom"
                title="افزودن دانش آموز"
                v-on:click="showModal">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
        <div class="modal fade"
             ref="create_group_presentation_modal"
             tabindex="-1"
             role="dialog"
             aria-labelledby="create-presentation-title">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-right" id="create-presentation-title">افزودن دانش آموز به گروه</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>دبیر</th>
                                <th>درس</th>
                                <th>ضریب</th>
                                <th>منبع</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody class="text-right">
                            <tr>
                                <td>
                                    <input class="form-control input-sm"
                                           placeholder="حسینی"
                                           v-model="search.surname"/>
                                </td>
                                <td>
                                    <input class="form-control input-sm"
                                           placeholder="فیزیک 1"
                                           v-model="search.title"/>
                                </td>
                                <td>
                                    <input class="form-control input-sm"
                                           placeholder="2"
                                           type="number"
                                           v-model="search.multiplier"/>
                                </td>
                                <td>
                                    <input class="form-control input-sm"
                                           placeholder="فیزیک و آزمایشگاه"
                                           v-model="search.reference_name"/>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <!--<template v-if="presentations">-->
                                <tr v-for="presentation in presentations.data">
                                    <td>{{ presentation.teacher.user.surname }}</td>
                                    <td>{{ presentation.course.title }}</td>
                                    <td>{{ presentation.course.multiplier }}</td>
                                    <td>{{ presentation.course.reference_name }}</td>
                                    <td>
                                        <button class="btn btn-xs btn-success"
                                                v-if="presentation.group_presented_courses.length === 0"
                                                v-on:click="attach(presentation)">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                        <button class="btn btn-xs btn-danger"
                                                v-else=""
                                                v-on:click="detach(presentation.group_presented_courses[0])">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    </td>
                                </tr>
                            <!--</template>-->
                            </tbody>
                        </table>
                        <div class="row" v-if="presentations">
                            <div class="col-xs-12 text-center">
                                <pagination :data="presentations" v-on:pagination-change-page="loadData"></pagination>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal">انصراف</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['group'],
        data: function () {
            return {
                errors: {},
                search: {
                    surname: '',
                    title: '',
                    multiplier: '',
                    reference_name: '',
                    group_id: this.group.id,
                },
                presentations: {
                    data: []
                },
                current_page: 1,
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
            loadData: function (page) {
                this.$Progress.start();
                this.errors = {};

                if (typeof page === 'undefined') {
                    page = this.current_page;
                } else {
                    this.current_page = page;
                }

                axios.get(route('staff.lookup.course.presentation.index'), {
                    params: Object.assign(this.search, {page: page})
                })
                    .then(this.onLoadSuccess)
                    .catch(this.onLoadError);
            },
            onLoadSuccess: function (response) {
                this.presentations = response.data;
                this.$Progress.finish();
            },
            onLoadError: function (error) {
                this.$Progress.fail();
                if (error.response.status === 422) {
                    this.errors = error.response.data;
                } else {
                    alert("Oops, Something went wrong!!!");
                }
                console.log(error.response);
            },
            showModal: function () {
                this.loadData();
                $(this.$refs.create_group_presentation_modal).modal('show');
            },
            hideModal: function () {
                $(this.$refs.create_group_presentation_modal).modal('hide');
            },
            attach: function (presentation) {
                this.$Progress.start();
                console.log("here");
                axios.post(route('staff.group.groupPresentedCourse.store', {group: this.group.id}), {
                    presentation_id: presentation.id
                })
                    .then(response => this.onAttachSuccess(response, presentation))
                    .catch(this.onError)
            },
            onAttachSuccess(response, presentation) {
                this.$Progress.finish();
                this.loadData();
                this.$emit('attached', presentation);
            },
            detach: function (presentation) {
                this.$Progress.start();
                axios.delete(route('staff.group.groupPresentedCourse.destroy', {group: this.group.id, presentation: presentation.id}))
                    .then(response => this.onDetachSuccess(response, presentation))
                    .catch(this.onError)
            },
            onDetachSuccess(response, presentation) {
                this.$Progress.finish();
                this.loadData();
                this.$emit('detached', presentation);
            },
            onError(error) {
                this.$Progress.fail();
                alert("Oops, Something went wrong!!!");
                console.log(error.response);
            }
        }
    }
</script>
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
             ref="create_group_modal"
             tabindex="-1"
             role="dialog"
             aria-labelledby="create-student-title">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-right" id="create-student-title">افزودن دانش آموز به گروه</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>تصویر</th>
                                <th>نام</th>
                                <th>نام خانوادگی</th>
                                <th>کد ملی</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody class="text-right">
                            <tr>
                                <td></td>
                                <td>
                                    <input class="form-control input-sm"
                                           placeholder="احمد"
                                           v-model="search.first_name"/>
                                </td>
                                <td>
                                    <input class="form-control input-sm"
                                           placeholder="حسنی"
                                           v-model="search.surname"/>
                                </td>
                                <td>
                                    <input class="form-control input-sm"
                                           placeholder="00123198743"
                                           v-model="search.national_code"/>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <template v-if="students">
                                <tr v-for="student in students.data">
                                    <td><img width="40" height="40" class="img-circle"
                                             :src="profilePictureUrl(student.user.profile_picture)"></td>
                                    <td>{{ student.user.first_name }}</td>
                                    <td>{{ student.user.surname }}</td>
                                    <td>{{ student.user.national_code }}</td>
                                    <td>
                                        <button class="btn btn-xs btn-success"
                                                v-if="!student.current_group"
                                                v-on:click="attach(student)">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                        <button class="btn btn-xs btn-danger"
                                                v-else=""
                                                v-on:click="detach(student)">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                            </tbody>
                        </table>
                        <div class="row" v-if="students">
                            <div class="col-xs-12 text-center">
                                <pagination :data="students" v-on:pagination-change-page="loadData"></pagination>
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
                    first_name: '',
                    surname: '',
                    national_code: '',
                    all: true,
                },
                students: null,
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
                function(){
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
                if (error.response.status === 422) {
                    this.errors = error.response.data;
                } else {
                    alert("Oops, Something went wrong!!!");
                }
                console.log(error.response);
            },
            showModal: function () {
                this.loadData();
                $(this.$refs.create_group_modal).modal('show');
            },
            hideModal: function () {
                $(this.$refs.create_group_modal).modal('hide');
            },
            profilePictureUrl(profile_picture) {
                if (profile_picture) {
                    return window.default_values.storage_base_url + profile_picture;
                } else {
                    return window.default_values.defaults.dp;
                }
            },
            attach: function (student) {
                axios.get(route('staff.group.student.add', {group: this.group.id, student: student.id}))
                    .then(response => this.onAttachSuccess(response, student))
                    .catch(this.onError)
            },
            onAttachSuccess(response, student) {
                student.current_group = true;
            },
            detach: function (student) {
                axios.delete(route('staff.group.student.destroy', {group: this.group.id, student: student.id}))
                    .then(response => this.onDetachSuccess(response, student))
                    .catch(this.onError)
            },
            onDetachSuccess(response, student) {
                student.current_group = false;
            },
            onError(error) {
                this.$Progress.fail();
                alert("Oops, Something went wrong!!!");
                console.log(error.response);
            }
        }
    }
</script>
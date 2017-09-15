<template>
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    {{ groupPresentedCourse.presentation.course.title }} - {{ groupPresentedCourse.presentation.teacher.user.surname }}
                </div>
                <div class="col-xs-6 text-left">
                    <edit-update-delete-buttons v-model="mode"
                                                v-on:update="btnUpdateClicked"
                                                v-on:delete="btnDeleteClicked"></edit-update-delete-buttons>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <validation-errors-alert :errors="errors"></validation-errors-alert>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 col-md-3 control-label">درس و ضریب</label>
                        <div class="col-sm-8 col-md-9">
                            <p class="form-control-static">
                                {{ groupPresentedCourse.presentation.course.title }}
                                -
                                {{ groupPresentedCourse.presentation.course.multiplier }}
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 col-md-3 control-label">نام و کد منبع</label>
                        <div class="col-sm-8 col-md-9">
                            <p class="form-control-static">
                                {{ groupPresentedCourse.presentation.course.reference_name }}
                                -
                                {{ groupPresentedCourse.presentation.course.reference_code }}
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 col-md-3 control-label">نام دبیر</label>
                        <div class="col-sm-8 col-md-9">
                            <p class="form-control-static">
                                <a :href="teacher_show_url"
                                   class="btn btn-xs btn-link">
                                    {{ groupPresentedCourse.presentation.teacher.user.first_name }}
                                    {{ groupPresentedCourse.presentation.teacher.user.surname }}
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 col-md-3 control-label" for="input-description">توضیحات</label>
                        <div class="col-sm-8 col-md-9">
                            <input v-if="mode === 'edit'"
                                   class="form-control"
                                   id="input-description"
                                   placeholder="توضیحاتی در مورد این ارائه درس"
                                   v-model="editable_group_presented_course.description">
                            <p v-else="" class="form-control-static">{{ groupPresentedCourse.description }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['group', 'groupPresentedCourse'],
        data() {
            return {
                mode: 'show',
                errors: {},
                editable_group_presented_course: $.extend(true, {}, this.groupPresentedCourse),
                deleted: false,
            }
        },
        watch: {
            mode: function (newMode) {
                $.extend(true, this.editable_group_presented_course, this.groupPresentedCourse);
            }
        },
        computed: {
            teacher_show_url: function() {
                return route('staff.teacher.show', {teacher: this.groupPresentedCourse.presentation.teacher.id})
            }
        },
        methods: {
            toggleMode: function () {
                this.mode = (this.mode === 'show' ? 'edit' : 'show');
            },
            btnUpdateClicked: function () {
                this.$Progress.start();
                this.errors = {};

                axios.put(route('staff.group.groupPresentedCourse.update', {
                    group: this.group.id,
                    groupPresentedCourse: this.groupPresentedCourse.id
                }), window.removeNulls(this.editable_group_presented_course))
                    .then(this.onUpdateSuccess)
                    .catch(this.onUpdateError);
            },
            onUpdateSuccess: function (response) {
                $.extend(true, this.groupPresentedCourse, response.data);
                this.toggleMode();
                this.$Progress.finish();
            },
            onUpdateError: function (error) {
                this.$Progress.fail();
                if (error.response.status === 422) {
                    this.errors = error.response.data;
                } else {
                    alert("Oops, Something went wrong!!!");
                }
                console.log(error.response);
            },
            btnDeleteClicked() {
                this.$Progress.start();
                this.errors = {};

                axios.delete(route('staff.group.groupPresentedCourse.destroy', {group: this.group.id, groupPresentedCourse: this.groupPresentedCourse.id}))
                    .then(this.onDeleteSuccess)
                    .catch(this.onError);
            },
            onDeleteSuccess: function (response) {
                this.$Progress.finish();
                this.$emit('deleted');
            },
            onError(error) {
                this.$Progress.fail();
                alert("Oops, Something went wrong!!!");
                console.log(error.response);
            }
        }
    }
</script>
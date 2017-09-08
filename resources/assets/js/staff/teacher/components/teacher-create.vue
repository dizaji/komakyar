<template>
    <div>
        <button class="btn btn-sm btn-success"
                data-toggle="tooltip"
                data-placement="bottom"
                title="افزودن دبیر"
                v-on:click="showModal">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
        <div class="modal fade"
             ref="create_teacher_modal"
             tabindex="-1"
             role="dialog"
             aria-labelledby="create-teacher-title">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-right" id="create-teacher-title">افزودن دبیر</h4>
                    </div>
                    <div class="modal-body">
                        <validation-errors-alert :errors="errors"></validation-errors-alert>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="input-name" class="col-sm-4 col-md-4 control-label">نام</label>
                                <div class="col-sm-8 col-md-8">
                                    <input class="form-control"
                                           id="input-name"
                                           placeholder="محمد"
                                           v-model="teacher.user.first_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-surname" class="col-sm-4 col-md-4 control-label">نام خانوادگی</label>
                                <div class="col-sm-8 col-md-8">
                                    <input class="form-control"
                                           id="input-surname"
                                           placeholder="احمدی"
                                           v-model="teacher.user.surname">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-national-code" class="col-sm-4 col-md-4 control-label">کد ملی</label>
                                <div class="col-sm-8 col-md-8">
                                    <input type="number"
                                           class="form-control"
                                           id="input-national-code"
                                           placeholder="0012345678"
                                           v-model="teacher.user.national_code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-email" class="col-sm-4 col-md-4 control-label">ایمیل</label>
                                <div class="col-sm-8 col-md-8">
                                    <input type="email"
                                           class="form-control"
                                           id="input-email"
                                           placeholder="m.ahmadi@school.com"
                                           v-model="teacher.user.email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-password" class="col-sm-4 col-md-4 control-label">رمز عبور</label>
                                <div class="col-sm-8 col-md-8">
                                    <input type="password"
                                           class="form-control"
                                           id="input-password"
                                           placeholder="Password"
                                           v-model="teacher.user.password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-password-confirm"
                                       class="col-sm-4 col-md-4 control-label">تکرار رمز عبور</label>
                                <div class="col-sm-8 col-md-8">
                                    <input type="password"
                                           class="form-control"
                                           id="input-password-confirm"
                                           placeholder="Password"
                                           v-model="teacher.user.password_confirm">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-mobile"
                                       class="col-sm-4 col-md-4 control-label">موبایل</label>
                                <div class="col-sm-8 col-md-8">
                                    <input type="email"
                                           class="form-control"
                                           id="input-mobile"
                                           placeholder="0912xxxxxxx"
                                           v-model="teacher.mobile">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-field-of-study"
                                       class="col-sm-4 col-md-4 control-label">سطح تحصیلات</label>
                                <div class="col-sm-8 col-md-8">
                                    <degree-level-dropdownlist id="input-field-of-study" v-model="teacher.degree"></degree-level-dropdownlist>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-description" class="col-sm-4 control-label">توضیحات</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="input-description"
                                           placeholder="توضیحات تکمیلی"
                                           v-model="teacher.description">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" v-on:click="btnSaveClicked()">ذخیره</button>
                            <button class="btn btn-default" data-dismiss="modal">انصراف</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data: function() {
            return {
                teacher: {
                    user: {
                        first_name: null,
                        surname: null,
                        email: null,
                        national_code: null,
                        password: null,
                        password_confirm: null,
                        description: null,
                    },

                    degree: 4,
                    field_of_study: null,
                    description: null,
                    mobile: null,
                },
                errors: {},
            }
        },
        methods: {
            btnSaveClicked: function () {
                this.$Progress.start();
                this.errors = {};
                axios.post(route('staff.teacher.store'), removeNulls(this.teacher, true))
                    .then(this.onStoreSuccess)
                    .catch(this.onLoadError);
            },
            onStoreSuccess: function (response) {
                this.$Progress.finish();
                window.location.href = route('staff.teacher.show', {teacher: response.data.id});
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
                $(this.$refs.create_teacher_modal).modal('show');
            }
        }
    }
</script>
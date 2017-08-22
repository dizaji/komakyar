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
             ref="create_student_modal"
             tabindex="-1"
             role="dialog"
             aria-labelledby="create-student-title">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-right" id="create-student-title">افزودن دانش آموز</h4>
                    </div>
                    <div class="modal-body">
                        <validation-errors-alert :errors="errors"></validation-errors-alert>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="input-name" class="col-sm-2 col-md-4 control-label">نام</label>
                                <div class="col-sm-10 col-md-8">
                                    <input class="form-control" id="input-name" placeholder="محمد"
                                           v-model="student.user.first_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-surname" class="col-sm-2 col-md-4 control-label">نام خانوادگی</label>
                                <div class="col-sm-10 col-md-8">
                                    <input class="form-control" id="input-surname" placeholder="احمدی"
                                           v-model="student.user.surname">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-national-code" class="col-sm-2 col-md-4 control-label">کد ملی</label>
                                <div class="col-sm-10 col-md-8">
                                    <input type="number" class="form-control" id="input-national-code"
                                           placeholder="0012345678" v-model="student.user.national_code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-email" class="col-sm-2 col-md-4 control-label">ایمیل</label>
                                <div class="col-sm-10 col-md-8">
                                    <input type="email" class="form-control" id="input-email"
                                           placeholder="m.ahmadi@school.com" v-model="student.user.email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-password" class="col-sm-2 col-md-4 control-label">رمز عبور</label>
                                <div class="col-sm-10 col-md-8">
                                    <input type="password" class="form-control" id="input-password" placeholder="Password"
                                           v-model="student.user.password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-password-confirm"
                                       class="col-sm-2 col-md-4 control-label">تکرار رمز عبور</label>
                                <div class="col-sm-10 col-md-8">
                                    <input type="password" class="form-control" id="input-password-confirm"
                                           placeholder="Password" v-model="student.user.password_confirm">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-student-code"
                                       class="col-sm-2 col-md-4 control-label">کد دانش آموزی</label>
                                <div class="col-sm-10 col-md-8">
                                    <input type="number" class="form-control" id="input-student-code"
                                           placeholder="14567829734234" v-model="student.student_code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-md-4 control-label">تاریخ تولد</label>
                                <div class="col-sm-10 col-md-8">
                                    <persian-date-picker v-model="student.date_of_birth"></persian-date-picker>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-phone-number" class="col-sm-2 col-md-4 control-label">تلفن تماس</label>
                                <div class="col-sm-10 col-md-8">
                                    <input type="number" class="form-control" id="input-phone-number" placeholder="88229231"
                                           v-model="student.phone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-mobile" class="col-sm-2 col-md-4 control-label">موبایل دانش آموز</label>
                                <div class="col-sm-10 col-md-8">
                                    <input type="number" class="form-control" id="input-mobile" placeholder="09121234567"
                                           v-model="student.mobile">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-address" class="col-sm-2 control-label">آدرس</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="input-address" placeholder="تهران خیبان شریعتی ..."
                                           v-model="student.address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-description" class="col-sm-2 control-label">توضیحات</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="input-description"
                                           placeholder="توضیحات تکمیلی در مورد دانش آموز مثل اینکه ایشان در سال گذشته شاگرد ممتاز بوده اند"
                                           v-model="student.user.description">
                                </div>
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
</template>
<script>
    export default {

        data() {
            return {
                student: {
                    user: {
                        first_name: null,
                        surname: null,
                        email: null,
                        national_code: null,
                        password: null,
                        password_confirm: null,
                        description: null,
                    },

                    student_code: null,
                    date_of_birth: null,
                    date_of_birth_pr: null,
                    phone: null,
                    mobile: null,
                    address: null,
                },
                errors: {},
            }
        },
        methods: {
            btnSaveClicked: function () {
                this.$Progress.start();
                this.errors = {};
                axios.post(route('staff.student.store'), removeNulls(this.student, true))
                    .then(this.onStoreSuccess)
                    .catch(this.onError);
            },
            onStoreSuccess: function (response) {
                console.log('success');
                console.log(response);
                window.location.href = route('staff.student.show', {student: response.data.id});
                this.$Progress.finish();
            },
            onError: function(error) {
                this.$Progress.fail();
                if (error.response.status === 422) {
                    this.errors = error.response.data;
                } else {
                    alert("Oops, Something went wrong!!!");
                }
                console.log(error.response);
            },
            showModal: function () {
                $(this.$refs.create_student_modal).modal('show');
            }
        }
    }
</script>

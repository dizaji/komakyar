<template>
    <div class="margin-10">
        <button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#add-new-parent">
            <span class="glyphicon glyphicon-plus"></span> افزودن
        </button>
        <div class="modal fade"
             id="add-new-parent"
             tabindex="-1"
             role="dialog"
             aria-labelledby="add-new-parent-title">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="add-new-parent-title">افزودن ولی</h4>
                    </div>
                    <form class="form-horizontal">
                        <div class="modal-body">
                            <validation-errors-alert :errors="errors"></validation-errors-alert>
                            <div class="form-group">
                                <label for="input-first-name" class="col-sm-3 control-label">نام</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="input-first-name" placeholder="حسن" v-model="parent.user.first_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-surname" class="col-sm-3 control-label"> نام خانوادگی</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="input-surname" placeholder="شیرازی" v-model="parent.user.surname">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-email" class="col-sm-3 control-label">ایمیل</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="input-email" placeholder="email@domain.com" v-model="parent.user.email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-national-code" class="col-sm-3 control-label">کد ملی</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="input-national-code" placeholder="0011231239" v-model="parent.user.national_code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-password" class="col-sm-3 control-label">گذرواژه</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="input-password" placeholder="XXXXXX" v-model="parent.user.password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-password-confirm" class="col-sm-3 control-label">تکرار گذرواژه</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="input-password-confirm" placeholder="XXXXXX" v-model="parent.user.password_confirm">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-relative" class="col-sm-3 control-label">نسبت</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="input-relative" v-model="parent.relative">
                                        <option value="father">پدر</option>
                                        <option value="mother">مادر</option>
                                        <option value="other">سایر</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-mobile1" class="col-sm-3 control-label">موبایل1</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="input-mobile1" placeholder="09XXXXXXXXX" v-model="parent.mobile_1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-mobile2" class="col-sm-3 control-label">موبایل2</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="input-mobile2" placeholder="09XXXXXXXXX" v-model="parent.mobile_2">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
                            <button type="button" class="btn btn-success" v-on:click="btnSaveClicked()">ذخیره</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['student', 'onCreate'],
        data() {
            return {
                parent: {
                    user: {
                        first_name: null,
                        surname: null,
                        email: null,
                        national_code: null,
                        password: null,
                        password_confirm: null,
                    },

                    relative: null,
                    mobile_1: null,
                    mobile_2: null,
                },
                errors: {},
            }
        },
        methods: {
            btnSaveClicked(){
                this.$Progress.start();
                this.errors = [];

                axios.post(route('staff.student.parent.store', {student: this.student.id}), removeNulls(this.parent, true))
                    .then(this.onSaveSuccess)
                    .catch(this.onError)
            },
            onSaveSuccess: function (response) {
                this.$Progress.finish();
                this.onCreate(response);
                $('#add-new-parent').modal('hide');
            },
            onError(error){
                this.$Progress.fail();
                if(error.response.status === 422) {
                    this.errors = error.response.data;
                } else {
                    alert("Oops, Something went wrong!!!");
                }
                console.log(error.response);
            }
        }
    }
</script>

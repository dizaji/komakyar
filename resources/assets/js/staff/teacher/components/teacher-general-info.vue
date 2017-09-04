<template>
    <div class="form-horizontal">
        <div class="row">
            <div class="col-xs-12 col-sm-4 margin-10">
                <img :src="profile_picture" alt="..." width="140" height="140" class="img-circle">
            </div>
            <div class="col-xs-12  col-sm-8">
                <!--<dropzone-uploader :url="upload_display_picture_route" v-on:upload-success="profilePictureUploadSuccess"-->
                                   <!--v-on:upload-error="profilePictureUploadError"></dropzone-uploader>-->
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-12 text-left margin-10">
                <edit-update-delete-buttons v-model="mode"
                                            v-on:update="btnUpdateClicked"
                                            v-on:delete="btnDeleteClicked"></edit-update-delete-buttons>
            </div>
        </div>
        <validation-errors-alert :errors="errors"></validation-errors-alert>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">نام</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" class="form-control" id="input-name" placeholder="محمد"
                               v-model="editable_teacher.user.first_name">
                        <p v-else="" class="form-control-static">{{ teacher.user.first_name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">نام خانوادگی</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" class="form-control" id="input-surname" placeholder="احمدی"
                               v-model="editable_teacher.user.surname">
                        <p v-else="" class="form-control-static">{{ teacher.user.surname }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">کد ملی</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" type="number" class="form-control" id="input-national-code"
                               placeholder="0012345678" v-model="editable_teacher.user.national_code">
                        <p v-else="" class="form-control-static">{{ teacher.user.national_code }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">ایمیل</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" type="email" class="form-control" id="input-email"
                               placeholder="m.ahmadi@school.com" v-model="editable_teacher.user.email">
                        <p v-else="" class="form-control-static">{{ teacher.user.email }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">تاریخ تولد</label>
                    <div class="col-sm-10 col-md-8">
                        <!--<persian-date-picker v-model="editable_teacher.date_of_birth" v-if="moteacherde === 'edit'"></persian-date-picker>-->
                        <!--<p v-else="" class="form-control-static">{{ teacher.date_of_birth | persianDate }}</p>-->

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">مدرک</label>
                    <div class="col-sm-10 col-md-8">
                        <!--<input v-if="mode === 'edit'" type="email" class="form-control" id="input-degree"-->
                               <!--placeholder="" v-model="editable_teacher.degree">-->

                        <div v-if="mode === 'edit'">
                            <div class="form-group">


                                <select class="form-control" v-model="editable_teacher.degree"
                                        id="input-field-of-study">

                                    <option  :value= 0>
                                        <div>زیر دیپلم</div>
                                    </option>
                                    <option  :value= 1>
                                        <div>دیپلم</div>
                                    </option>
                                    <option  :value= 2>
                                        <div>فوق دیپلم</div>
                                    </option>
                                    <option  :value= 3>
                                        <div>کارشناسی</div>
                                    </option>
                                    <option  :value= 4>
                                        <div>کارشناسی ارشد</div>
                                    </option>
                                    <option  :value= 5>
                                        <div>دکتری</div>
                                    </option>
                                    <option  :value= 6>
                                        <div>موارد دیگر</div>
                                    </option>
                                </select>

                            </div>
                        </div>

                    <div v-else="">
                        <div v-if="teacher.degree == 'below diploma' " class="">
                            <p  class="form-control-static">زیر دیپلم</p>
                        </div>
                        <div v-if="teacher.degree == 0 " class="">
                            <p  class="form-control-static">زیر دیپلم</p>
                        </div>
                        <div v-if="teacher.degree == 'diploma' " class="">
                            <p  class="form-control-static">دیپلم</p>
                        </div>
                        <div v-if="teacher.degree == 1" class="">
                            <p  class="form-control-static">دیپلم</p>
                        </div>
                        <div v-if="teacher.degree == 'Ad'" class="">
                            <p  class="form-control-static">فوق دیپلم</p>
                        </div>
                        <div v-if="teacher.degree == 2 " class="">
                            <p  class="form-control-static">فوق دیپلم</p>
                        </div>
                        <div v-if="teacher.degree == 'BsC'" class="">
                            <p  class="form-control-static">کارشناسی</p>
                        </div>
                        <div v-if="teacher.degree == 3 " class="">
                            <p  class="form-control-static">کارشناسی</p>
                        </div>
                        <div v-if="teacher.degree == 'MsC'  " class="">
                            <p  class="form-control-static">کارشناسی ارشد</p>
                        </div>
                        <div v-if="teacher.degree == 4 " class="">
                            <p  class="form-control-static">کارشناسی ارشد</p>
                        </div>
                        <div v-if="teacher.degree == 5 " class="">
                            <p  class="form-control-static">دکتری</p>
                        </div>
                        <div v-if="teacher.degree == 'PhD'  " class="">
                            <p  class="form-control-static">دکتری</p>
                        </div>
                        <div v-if="teacher.degree == 'Other' " class="">
                            <p  class="form-control-static">موارد دیگر</p>
                        </div>
                        <div v-if="teacher.degree == 6 " class="">
                            <p  class="form-control-static">موارد دیگر</p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">موبایل</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" type="number" class="form-control" id="input-mobile"
                               placeholder="09121234567" v-model="editable_teacher.mobile">
                        <p v-else="" class="form-control-static">{{ teacher.mobile }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-2 control-label">توضیحات</label>
                    <div class="col-sm-10">
                        <input v-if="mode === 'edit'" class="form-control" id="input-description"
                               placeholder="توضیحات تکمیلی در مورد دانش آموز مثل اینکه ایشان در سال گذشته شاگرد ممتاز بوده اند"
                               v-model="editable_teacher.user.description">
                        <p v-else="" class="form-control-static">{{ teacher.user.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: {
            teacher: {
                default: null,
            },
        },
        computed: {
            profile_picture: function () {
                if (this.teacher && this.teacher.user.profile_picture) {
                    return window.default_values.storage_base_url + this.teacher.user.profile_picture;
                } else {
                    return window.default_values.defaults.dp;
                }
            }
        },
        data() {
            return {
                errors: {},
                mode: 'show',
//                upload_display_picture_route: route('staff.teacher.upload-display-picture', {teacher: this.teacher.id}),
                editable_teacher: $.extend(true, {}, this.teacher),
            }
        },
        watch: {
            mode: function (newMode) {
                $.extend(true, this.editable_teacher, this.teacher);
            }
        },
        methods: {
            btnUpdateClicked: function () {
                this.$Progress.start();
                axios.put(route('staff.teacher.update', {teacher: this.teacher.id}), this.editable_teacher)
                    .then(this.onUpdateSuccess)
                    .catch(this.onUpdateError)
            },
            onUpdateSuccess: function (response) {
                this.errors = {};
                this.mode = 'show';
                $.extend(true, this.teacher, response.data);
                this.$Progress.finish();
                console.log("r data info =",response.data)
            },
            onUpdateError(error) {
                this.$Progress.fail();
                if (error.response.status === 422) {
                    this.errors = error.response.data;
                } else {
                    alert("Oops, Something went wrong!!!");
                }
                console.log(error.response);
                console.log("r data info =",response.data)
            },

            btnDeleteClicked: function () {
                axios.delete(route('staff.teacher.delete', {teacher: this.teacher.id}))
                    .then(this.onDeleteSuccess)
                    .catch(this.onDeleteError);
            },
            onDeleteSuccess: function (response) {
                //
            },
            onDeleteError: function (error) {

            },

            profilePictureUploadSuccess: function (file, response) {
                this.teacher.user.profile_picture = response.url;
            },
            profilePictureUploadError: function (file) {
                alert('آپلود فایل با موفقیت انجام نشد!')
            },
        }
    }
</script>
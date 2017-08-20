<template>
    <div class="form-horizontal">
        <div class="row">
            <div class="col-xs-12 col-sm-4 margin-10">
                <img :src="profile_picture" alt="..." width="140" height="140" class="img-circle">
            </div>
            <div class="col-xs-12  col-sm-8">
                <dropzone-uploader :url="upload_display_picture_route" v-on:upload-success="profilePictureUploadSuccess"
                                   v-on:upload-error="profilePictureUploadError"></dropzone-uploader>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-12 text-left margin-10">
                <template v-if="mode === 'show'">
                    <button class="btn btn-sm btn-primary" v-on:click="toggleMode">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button class="btn btn-sm btn-danger" v-on:click="$refs.confirm_delete_modal.show()">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                    <confirm-delete-modal ref="confirm_delete_modal"
                                          v-on:confirm="btnDeleteClicked">
                    </confirm-delete-modal>
                </template>
                <template v-else="">
                    <button class="btn btn-sm btn-success" v-on:click="btnUpdateClicked">
                        <span class="glyphicon glyphicon-ok"></span>
                    </button>
                    <button class="btn btn-sm btn-default" v-on:click="toggleMode">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </template>
            </div>
        </div>
        <validation-errors-alert :errors="errors"></validation-errors-alert>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">نام</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" class="form-control" id="input-name" placeholder="محمد"
                               v-model="editable_student.user.first_name">
                        <p v-else="" class="form-control-static">{{ student.user.first_name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">نام خانوادگی</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" class="form-control" id="input-surname" placeholder="احمدی"
                               v-model="editable_student.user.surname">
                        <p v-else="" class="form-control-static">{{ student.user.surname }}</p>
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
                               placeholder="0012345678" v-model="editable_student.user.national_code">
                        <p v-else="" class="form-control-static">{{ student.user.national_code }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">ایمیل</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" type="email" class="form-control" id="input-email"
                               placeholder="m.ahmadi@school.com" v-model="editable_student.user.email">
                        <p v-else="" class="form-control-static">{{ student.user.email }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">کد دانش آموزی</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" type="number" class="form-control" id="input-student-code"
                               placeholder="14567829734234" v-model="editable_student.student_code">
                        <p v-else="" class="form-control-static">{{ student.student_code }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">تاریخ تولد</label>
                    <div class="col-sm-10 col-md-8">
                        <persian-date-picker v-model="editable_student.date_of_birth" v-if="mode === 'edit'"></persian-date-picker>
                        <p v-else="" class="form-control-static">{{ student.date_of_birth | persianDate }}</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">تلفن تماس</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" type="number" class="form-control" id="input-phone-number"
                               placeholder="88229231" v-model="editable_student.phone">
                        <p v-else="" class="form-control-static">{{ student.phone }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">موبایل دانش آموز</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" type="number" class="form-control" id="input-mobile"
                               placeholder="09121234567" v-model="editable_student.mobile">
                        <p v-else="" class="form-control-static">{{ student.mobile }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-2 control-label">آدرس</label>
                    <div class="col-sm-10">
                        <input v-if="mode === 'edit'" class="form-control" id="input-address"
                               placeholder="تهران خیبان شریعتی ..." v-model="editable_student.address">
                        <p v-else="" class="form-control-static">{{ student.address }}</p>
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
                               v-model="editable_student.user.description">
                        <p v-else="" class="form-control-static">{{ student.user.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: {
            student: {
                default: null,
            },
        },
        computed: {
            profile_picture: function () {
                if (this.student && this.student.user.profile_picture) {
                    return this.student.user.profile_picture;
                } else {
                    return window.default_values.defaults.dp;
                }
            }
        },
        data() {
            return {
                errors: {},
                mode: 'show',
                upload_display_picture_route: route('staff.student.upload-display-picture', {student: this.student.id}),
                editable_student: $.extend(true, {}, this.student),
            }
        },
        watch: {
            mode: function (newMode) {
                $.extend(true, this.editable_student, this.student);
            }
        },
        methods: {
            btnUpdateClicked: function () {
                axios.put(route('staff.student.update', {student: this.student.id}), this.editable_student)
                    .then(this.onUpdateSuccess)
                    .catch(this.onUpdateError)
            },
            onUpdateSuccess: function (response) {
                this.errors = {};
                this.mode = 'show';

                $.extend(true, this.student, response.data);
                this.$Progress.finish();
            },
            onUpdateError(error) {
                this.$Progress.fail();
                if (error.response.status === 422) {
                    this.errors = error.response.data;
                } else {
                    alert("Oops, Something went wrong!!!");
                }
                console.log(error.response);
            },

            btnDeleteClicked: function () {
                axios.delete(route('staff.student.delete', {student: this.student.id}))
                    .then(this.onDeleteSuccess)
                    .catch(this.onDeleteError);
            },
            onDeleteSuccess: function (response) {
                //
            },
            onDeleteError: function (error) {

            },

            profilePictureUploadSuccess: function (file, response) {
                this.student.user.profile_picture = response.url;
            },
            profilePictureUploadError: function (file) {
                alert('آپلود فایل با موفقیت انجام نشد!')
            },

            toggleMode: function () {
                this.mode = (this.mode === 'show' ? 'edit' : 'show');
            }
        }
    }
</script>
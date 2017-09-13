<template>
    <div class="form-horizontal">
        <div class="row">
            <div class="col-xs-12 col-sm-4 margin-10">
                <img :src="profile_picture" alt="..." width="140" height="140" class="img-circle">
            </div>
            <div class="col-xs-12  col-sm-8">
                <dropzone-uploader :url="upload_display_picture_route"
                                   v-on:upload-success="profilePictureUploadSuccess"
                                   v-on:upload-error="profilePictureUploadError"></dropzone-uploader>
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
                    <label class="col-sm-2 col-md-4 control-label">موبایل</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" type="number" class="form-control" id="input-mobile"
                               placeholder="09121234567" v-model="editable_teacher.mobile">
                        <p v-else="" class="form-control-static">{{ teacher.mobile }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">سطح تحصیلات</label>
                    <div class="col-sm-10 col-md-8">
                        <template v-if="mode === 'edit'">
                            <degree-level-dropdownlist
                                    v-model="editable_teacher.degree"
                                    id="input-field-of-study">
                            </degree-level-dropdownlist>
                        </template>
                        <template v-else="">
                            <degree-level-paragraph v-model="teacher.degree"></degree-level-paragraph>
                        </template>
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
                               placeholder="توضیحات تکمیلی"
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
                    if(window.isValidURL(this.teacher.user.profile_picture)) {
                        return this.teacher.user.profile_picture;
                    } else {
                        return window.default_values.storage_base_url + this.teacher.user.profile_picture;
                    }
                } else {
                    return window.default_values.defaults.dp;
                }
            }
        },
        data() {
            return {
                errors: {},
                mode: 'show',
                upload_display_picture_route: route('staff.teacher.upload-display-picture', {teacher: this.teacher.id}),
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
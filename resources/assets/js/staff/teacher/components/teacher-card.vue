<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-custom">
                <div class="row">
                    <div class="col-xs-6">
                        {{ teacher.user.first_name}} {{ teacher.user.surname }}
                    </div>
                    <div class="col-xs-6 text-left">
                        <a class="btn btn-sm btn-primary" :href="url.show">
                            <span class="glyphicon glyphicon-eye-open"></span>

                        </a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-sm-3 col-xs-4 text-center">

                    <img width="140" height="140"
                         :src="profile_picture"
                         class="img-circle">
                </div>
                <div class="form-horizontal col-sm-9 col-xs-6">
                    <div class="form-group col-md-6">
                        <label class="col-md-4 col-sm-3 col-xs-4 control-label">ایمیل</label>
                        <div class="col-md-8 col-sm-9 col-xs-8">
                            <p class="form-control-static">{{ teacher.user.email }}</p>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="col-md-4 col-sm-3 col-xs-4 control-label">کد ملی</label>
                        <div class="col-md-8 col-sm-9 col-xs-8">
                            <p class="form-control-static">{{ teacher.user.national_code }}</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4 col-sm-3 col-xs-4 control-label">موبایل</label>
                        <div class="col-md-8 col-sm-9 col-xs-8">
                            <p class="form-control-static">{{ teacher.mobile }}</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4 col-sm-3 col-xs-4 control-label">مدرک</label>
                        <div class="col-md-8 col-sm-9 col-xs-8">
                            <!--<p class="form-control-static">{{ teacher.degree }}</p>-->
                            <div v-if="teacher.degree == 'below diploma' " class="">
                                <p class="form-control-static">زیر دیپلم</p>
                            </div>
                            <div v-if="teacher.degree == 0 " class="">
                                <p class="form-control-static">زیر دیپلم</p>
                            </div>
                            <div v-if="teacher.degree == 'diploma' " class="">
                                <p class="form-control-static">دیپلم</p>
                            </div>
                            <div v-if="teacher.degree == 1" class="">
                                <p class="form-control-static">دیپلم</p>
                            </div>
                            <div v-if="teacher.degree == 'Ad'" class="">
                                <p class="form-control-static">فوق دیپلم</p>
                            </div>
                            <div v-if="teacher.degree == 2 " class="">
                                <p class="form-control-static">فوق دیپلم</p>
                            </div>
                            <div v-if="teacher.degree == 'BsC'" class="">
                                <p class="form-control-static">کارشناسی</p>
                            </div>
                            <div v-if="teacher.degree == 3 " class="">
                                <p class="form-control-static">کارشناسی</p>
                            </div>
                            <div v-if="teacher.degree == 'MsC'  " class="">
                                <p class="form-control-static">کارشناسی ارشد</p>
                            </div>
                            <div v-if="teacher.degree == 4 " class="">
                                <p class="form-control-static">کارشناسی ارشد</p>
                            </div>
                            <div v-if="teacher.degree == 5 " class="">
                                <p class="form-control-static">دکتری</p>
                            </div>
                            <div v-if="teacher.degree == 'PhD'  " class="">
                                <p class="form-control-static">دکتری</p>
                            </div>
                            <div v-if="teacher.degree == 'Other' " class="">
                                <p class="form-control-static">موارد دیگر</p>
                            </div>
                            <div v-if="teacher.degree == 6 " class="">
                                <p class="form-control-static">موارد دیگر</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {

        props: ['teacher'],

        data() {
            return {
                url: {
                    show: route('staff.teacher.show', {teacher: this.teacher.id}),
                }
            }
        },
        computed: {
            profile_picture: function () {
                if (this.teacher && this.teacher.profile_picture) {
                    return window.default_values.storage_base_url + this.teacher.user.profile_picture;
                } else {
                    return window.default_values.defaults.dp;
                }
            }
        },
    }
</script>

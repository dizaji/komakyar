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

                    <img style="max-width: 100%; max-height: 140px;"
                         :src="profile_picture"
                         class="img-circle">
                </div>
                <div class="form-horizontal col-sm-9 col-xs-6">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="col-md-4 col-sm-3 col-xs-4 control-label">ایمیل</label>
                            <div class="col-md-8 col-sm-9 col-xs-8">
                                <p class="form-control-static">{{ teacher.user.email }}</p>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">

                            <label class="col-md-4 col-sm-3 col-xs-4 control-label">کد ملی</label>
                            <div class="col-md-8 col-sm-9 col-xs-8">
                                <p class="form-control-static">{{ teacher.user.national_code }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="col-md-4 col-sm-3 col-xs-4 control-label">موبایل</label>
                            <div class="col-md-8 col-sm-9 col-xs-8">
                                <p class="form-control-static">{{ teacher.mobile }}</p>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="col-xs-6 control-label">سطح تحصیلات</label>
                            <div class="col-xs-6">
                                <degree-level-paragraph v-model="teacher.degree"></degree-level-paragraph>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
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
            }
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
            },
            url: function () {
                return {
                    show: route('staff.teacher.show', {teacher: this.teacher.id}),
                };
            }
        },
    }
</script>

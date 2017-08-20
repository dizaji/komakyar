<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-sm-3 col-xs-4 text-center">

                    <img width="140" height="140"
                         :src="profile_picture"
                         class="img-circle">

                    <h4>احمد حسن زاده</h4>
                    <div>
                        <a :href="url.show"
                           class="test-actual"
                           data-toggle="tooltip"
                           data-placement="bottom"
                           title="مشاهده">
                            <span class="glyphicon glyphicon-eye-open text-info"></span>
                        </a>
                        <!--<a href="#"
                           class="test-actual"
                           data-toggle="tooltip"
                           data-placement="bottom"
                           title="ویرایش">
                            <span class="glyphicon glyphicon-pencil text-pimary"></span>
                        </a>
                        <a href="#"
                           class="test-actual"
                           data-toggle="tooltip"
                           data-placement="bottom"
                           title="حدف">
                            <span class="glyphicon glyphicon-remove text-danger"></span>
                        </a>-->
                    </div>
                </div>
                <div class="form-horizontal col-sm-9 col-xs-6">
                    <div class="form-group col-md-6">
                        <label class="col-md-4 col-sm-3 col-xs-4 control-label">ایمیل</label>
                        <div class="col-md-8 col-sm-9 col-xs-8">
                            <p class="form-control-static">{{ student.user.email }}</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4 col-sm-3 col-xs-4 control-label"
                               data-toggle="tooltip"
                               data-placement="bottom"
                               title="شماره دانش آموزی">شماره د.آ</label>
                        <div class="col-md-8 col-sm-9 col-xs-8">
                            <p class="form-control-static">{{ student.student_code }}</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4 col-sm-3 col-xs-4 control-label">کد ملی</label>
                        <div class="col-md-8 col-sm-9 col-xs-8">
                            <p class="form-control-static">{{ student.user.national_code }}</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4 col-sm-3 col-xs-4 control-label">تلفن</label>
                        <div class="col-md-8 col-sm-9 col-xs-8">
                            <p class="form-control-static">{{ student.phone }}</p>
                        </div>
                    </div>
                    <div class="form-group hidden-sm hidden-xs">
                        <div class="col-md-2 col-sm-3 col-xs-4 control-label">آدرس</div>
                        <div class="col-md-10 col-sm-9 col-xs-8">
                            <p class="form-control-static">
                                {{ student.address }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {

        props: ['student'],

        data() {
            return {
                url: {
                    show: route('staff.student.show', {student: this.student.id}),
                }
            }
        },
        computed: {
            profile_picture: function () {
                if (this.student && this.student.user.profile_picture) {
                    return window.default_values.storage_base_url + this.student.user.profile_picture;
                } else {
                    return window.default_values.defaults.dp;
                }
            }
        },
        methods: {
            test: function () {
                console.log("mounted");
            }
        }
    }


</script>

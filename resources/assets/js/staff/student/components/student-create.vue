<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <span>دانش آموز جدید</span>
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-name" class="col-sm-2 col-md-4 control-label">نام</label>
                            <div class="col-sm-10 col-md-8">
                                <input class="form-control" id="input-name" placeholder="محمد">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-surname" class="col-sm-2 col-md-4 control-label">نام خانوادگی</label>
                            <div class="col-sm-10 col-md-8">
                                <input class="form-control" id="input-surname" placeholder="احمدی">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-national-code" class="col-sm-2 col-md-4 control-label">کد ملی</label>
                            <div class="col-sm-10 col-md-8">
                                <input type="number" class="form-control" id="input-national-code" placeholder="0012345678">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-email" class="col-sm-2 col-md-4 control-label">ایمیل</label>
                            <div class="col-sm-10 col-md-8">
                                <input type="email" class="form-control" id="input-email" placeholder="m.ahmadi@school.com">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-password" class="col-sm-2 col-md-4 control-label">رمز عبور</label>
                            <div class="col-sm-10 col-md-8">
                                <input type="password" class="form-control" id="input-password" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-password-confirm" class="col-sm-2 col-md-4 control-label">تکرار رمز عبور</label>
                            <div class="col-sm-10 col-md-8">
                                <input type="password" class="form-control" id="input-password-confirm" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-student-code" class="col-sm-2 col-md-4 control-label">کد دانش آموزی</label>
                            <div class="col-sm-10 col-md-8">
                                <input type="number" class="form-control" id="input-student-code" placeholder="14567829734234">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-date-of-birth" class="col-sm-2 col-md-4 control-label">تاریخ تولد</label>
                            <div class="col-sm-10 col-md-8">
                                <input class="form-control" id="input-date-of-birth" placeholder="1380/05/06" style="direction: ltr">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-phone-number" class="col-sm-2 col-md-4 control-label">تلفن تماس</label>
                            <div class="col-sm-10 col-md-8">
                                <input type="number" class="form-control" id="input-phone-number" placeholder="88229231">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-mobile" class="col-sm-2 col-md-4 control-label">موبایل دانش آموز</label>
                            <div class="col-sm-10 col-md-8">
                                <input type="number" class="form-control" id="input-mobile" placeholder="09121234567">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="input-address" class="col-sm-2 control-label">آدرس</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-address" placeholder="تهران خیبان شریعتی ...">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="input-description" class="col-sm-2 control-label">توضیحات</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="input-description" placeholder="توضیحات تکمیلی در مورد دانش آموز مثل اینکه ایشان در سال گذشته شاگرد ممتاز بوده اند">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Sign in</button>
                        </div>
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
                student: null,
            }
        },

        created: function() {
            $(document).ready(function() {
                $('#input-date-of-birth').pDatepicker({
                    format : "YYYY-MM-DD",
                    viewMode : "year"
                });
            });
        },

        methods: {
            test: function () {
                console.log("mounted");
            }
        }
    }


</script>

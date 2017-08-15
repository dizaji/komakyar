<template>
    <div class="form-horizontal">
        <validation-errors-alert :errors="errors"></validation-errors-alert>
        <div class="col-md-6">
            <div class="form-group">
                <label for="input-name" class="col-sm-2 col-md-4 control-label">نام</label>
                <div class="col-sm-10 col-md-8">
                    <input class="form-control" id="input-name" placeholder="محمد" v-model="student.user.first_name">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="input-surname" class="col-sm-2 col-md-4 control-label">نام خانوادگی</label>
                <div class="col-sm-10 col-md-8">
                    <input class="form-control" id="input-surname" placeholder="احمدی" v-model="student.user.surname">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="input-national-code" class="col-sm-2 col-md-4 control-label">کد ملی</label>
                <div class="col-sm-10 col-md-8">
                    <input type="number" class="form-control" id="input-national-code" placeholder="0012345678" v-model="student.user.national_code">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="input-email" class="col-sm-2 col-md-4 control-label">ایمیل</label>
                <div class="col-sm-10 col-md-8">
                    <input type="email" class="form-control" id="input-email" placeholder="m.ahmadi@school.com" v-model="student.user.email">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="input-student-code" class="col-sm-2 col-md-4 control-label">کد دانش آموزی</label>
                <div class="col-sm-10 col-md-8">
                    <input type="number" class="form-control" id="input-student-code" placeholder="14567829734234" v-model="student.student_code">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="input-date-of-birth" class="col-sm-2 col-md-4 control-label">تاریخ تولد</label>
                <div class="col-sm-10 col-md-8">
                    <input class="form-control" id="input-date-of-birth" placeholder="1380/05/06" style="direction: ltr" v-model="student.date_of_birth_per">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="input-phone-number" class="col-sm-2 col-md-4 control-label">تلفن تماس</label>
                <div class="col-sm-10 col-md-8">
                    <input type="number" class="form-control" id="input-phone-number" placeholder="88229231" v-model="student.phone">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="input-mobile" class="col-sm-2 col-md-4 control-label">موبایل دانش آموز</label>
                <div class="col-sm-10 col-md-8">
                    <input type="number" class="form-control" id="input-mobile" placeholder="09121234567" v-model="student.mobile">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="input-address" class="col-sm-2 control-label">آدرس</label>
                <div class="col-sm-10">
                    <input class="form-control" id="input-address" placeholder="تهران خیبان شریعتی ..." v-model="student.address">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="input-description" class="col-sm-2 control-label">توضیحات</label>
                <div class="col-sm-10">
                    <input class="form-control" id="input-description" placeholder="توضیحات تکمیلی در مورد دانش آموز مثل اینکه ایشان در سال گذشته شاگرد ممتاز بوده اند" v-model="student.user.description">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success" v-on:click="btnSaveClicked()">ذخیره</button>
                <button class="btn btn-default">انصراف</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['student'],
        data() {
            return {
                errors: {},
            }
        },
        methods: {
            btnSaveClicked: function(){
                axios.put(route('staff.student.update', {student: this.student.id}), this.student)
                    .then(this.onUpdateSuccess)
                    .catch(this.onError)
            },

            onUpdateSuccess: function (response) {
                console.log(response);
                this.$Progress.finish();
            },

            onError(error) {
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
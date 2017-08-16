<template>
    <div class="form-horizontal">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">نام</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" class="form-control" id="input-name" placeholder="محمد" v-model="student.user.first_name">
                        <p v-else="" class="form-control-static">{{ student.user.first_name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">نام خانوادگی</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" class="form-control" id="input-surname" placeholder="احمدی" v-model="student.user.surname">
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
                        <input v-if="mode === 'edit'" type="number" class="form-control" id="input-national-code" placeholder="0012345678" v-model="student.user.national_code">
                        <p v-else="" class="form-control-static">{{ student.user.national_code }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">ایمیل</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" type="email" class="form-control" id="input-email" placeholder="m.ahmadi@school.com" v-model="student.user.email">
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
                        <input v-if="mode === 'edit'" type="number" class="form-control" id="input-student-code" placeholder="14567829734234" v-model="student.student_code">
                        <p v-else="" class="form-control-static">{{ student.student_code }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">تاریخ تولد</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" class="form-control" id="input-date-of-birth" placeholder="1380/05/06" style="direction: ltr" v-model="student.date_of_birth_per">
                        <p v-else="" class="form-control-static">{{ student.date_of_birth_per }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">تلفن تماس</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" type="number" class="form-control" id="input-phone-number" placeholder="88229231" v-model="student.phone">
                        <p v-else="" class="form-control-static">{{ student.phone }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">موبایل دانش آموز</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" type="number" class="form-control" id="input-mobile" placeholder="09121234567" v-model="student.mobile">
                        <p v-else="" class="form-control-static">{{ student.mobile }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-sm-2 control-label">آدرس</label>
                <div class="col-sm-10">
                    <input v-if="mode === 'edit'" class="form-control" id="input-address" placeholder="تهران خیبان شریعتی ..." v-model="student.address">
                    <p v-else="" class="form-control-static">{{ student.address }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-sm-2 control-label">توضیحات</label>
                <div class="col-sm-10">
                    <input v-if="mode === 'edit'" class="form-control" id="input-description" placeholder="توضیحات تکمیلی در مورد دانش آموز مثل اینکه ایشان در سال گذشته شاگرد ممتاز بوده اند" v-model="student.user.description">
                    <p v-else="" class="form-control-static">{{ student.user.description }}</p>
                </div>
            </div>
        </div>
        <div class="form-group" v-if="mode === 'edit'">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success" v-on:click="btnSaveClicked()">ذخیره</button>
                <button class="btn btn-default">انصراف</button>
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
            mode: {
                default: 'show',
                type: String,
            }
        },
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
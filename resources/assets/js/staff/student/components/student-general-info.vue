<template>
    <div class="form-horizontal">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">نام</label>
                    <div class="col-sm-10 col-md-8">
                        <p class="form-control-static">{{ student.user.first_name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">نام خانوادگی</label>
                    <div class="col-sm-10 col-md-8">
                        <p class="form-control-static">{{ student.user.surname }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">کد ملی</label>
                    <div class="col-sm-10 col-md-8">
                        <p class="form-control-static">{{ student.user.national_code }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">ایمیل</label>
                    <div class="col-sm-10 col-md-8">
                        <p class="form-control-static">{{ student.user.email }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">کد دانش آموزی</label>
                    <div class="col-sm-10 col-md-8">
                        <p class="form-control-static">{{ student.student_code }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">تاریخ تولد</label>
                    <div class="col-sm-10 col-md-8">
                        <p class="form-control-static">{{ student.date_of_birth_per }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">تلفن تماس</label>
                    <div class="col-sm-10 col-md-8">
                        <p class="form-control-static">{{ student.phone }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">موبایل دانش آموز</label>
                    <div class="col-sm-10 col-md-8">
                        <p class="form-control-static">{{ student.mobile }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-sm-2 control-label">آدرس</label>
                <div class="col-sm-10">
                    <p class="form-control-static">{{ student.address }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-sm-2 control-label">توضیحات</label>
                <div class="col-sm-10">
                    <p class="form-control-static">{{ student.user.description }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['student'],
    }
</script>
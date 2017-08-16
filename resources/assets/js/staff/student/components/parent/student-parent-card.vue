<template>
    <div class="panel panel-info">
        <div class="panel-heading">
            احمد حسینی (پدر)
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-2 col-md-4 control-label">نام</label>
                        <div class="col-sm-10 col-md-8">
                            <input v-if="mode === 'edit'" class="form-control" id="input-name" placeholder="حسن">
                            <p v-else="" class="form-control-static">احمد</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-2 col-md-4 control-label">نام خانوادگی</label>
                        <div class="col-sm-10 col-md-8">
                            <input v-if="mode === 'edit'" class="form-control" id="input-surname"
                                   placeholder="شیرازی">
                            <p v-else="" class="form-control-static">حسینی</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-2 col-md-4 control-label">نام کاربری</label>
                        <div class="col-sm-10 col-md-8">
                            <input v-if="mode === 'edit'" class="form-control" id="input-username" placeholder="حسن">
                            <p v-else="" class="form-control-static">a.hosseini</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-2 col-md-4 control-label">ایمیل</label>
                        <div class="col-sm-10 col-md-8">
                            <input v-if="mode === 'edit'" class="form-control" id="input-email"
                                   placeholder="شیرازی">
                            <p v-else="" class="form-control-static">a.hosseini@inpin.co</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" v-if="mode === 'edit'">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-2 col-md-4 control-label">گذرواژه</label>
                        <div class="col-sm-10 col-md-8">
                            <input type="password"
                                   v-if="mode === 'edit'"
                                   class="form-control"
                                   id="input-password"
                                   placeholder="XXXXXX">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-2 col-md-4 control-label">تکرار گذرواژه</label>
                        <div class="col-sm-10 col-md-8">
                            <input type="password"
                                   v-if="mode === 'edit'"
                                   class="form-control"
                                   id="input-password-confirm"
                                   placeholder="XXXXXX">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="input-relative" class="col-sm-2 col-md-4 control-label">نسبت</label>
                        <div class="col-sm-10 col-md-8">
                            <select v-if="mode === 'edit'" class="form-control" id="input-relative">
                                <option value="father">پدر</option>
                                <option value="mother">مادر</option>
                                <option value="other">سایر</option>
                            </select>
                            <p v-else="" class="form-control-static">پدر</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-2 col-md-4 control-label">موبایل 1</label>
                        <div class="col-sm-10 col-md-8">
                            <input v-if="mode === 'edit'" class="form-control" id="input-mobile1"
                                   placeholder="0912XXXXXXX">
                            <p v-else="" class="form-control-static">09121234123</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-2 col-md-4 control-label">موبایل 2</label>
                        <div class="col-sm-10 col-md-8">
                            <input v-if="mode === 'edit'"
                                   class="form-control"
                                   id="input-mobile2"
                                   placeholder="0912XXXXXXX"
                                   v-model="paren.mobile_2">
                            <p v-else="" class="form-control-static">{{ parent.mobile_2 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['parent'],
        data () {
            return {
                mode: 'show',
            }
        }
    }
</script>
<template>
    <div>

        <validation-errors-alert :errors="errors"></validation-errors-alert>
        <div class="form-horizontal">
            <div class="form-group">
                <label for="input-password" class="col-sm-2 control-label">گذرواژه</label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" id="input-password" placeholder="XXXXXX"
                           v-model="user.password">
                </div>
            </div>
            <div class="form-group">
                <label for="input-password-confirm" class="col-sm-2 control-label">تکرار گذرواژه</label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" id="input-password-confirm" placeholder="XXXXXX"
                           v-model="user.password_confirm">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-success" v-on:click="btnSaveClicked()">ذخیره</button>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    export default {
        props: ['student'],
        data: function () {
            return {
                errors: {},
                user: {
                    password: null,
                    password_confirm: null,
                }
            }
        },
        methods: {
            btnSaveClicked: function () {
                this.$Progress.start();
                axios.post(route('staff.student.change-password', {student: this.student.id}), this.user)
                    .then(this.onSuccess)
                    .catch(this.onLoadError);

            },
            onSuccess: function (response) {
                this.$Progress.finish();
                this.reset();
            },

            onLoadError(error) {
                this.$Progress.fail();
                if (error.response.status === 422) {
                    this.errors = error.response.data;
                } else {
                    alert("Oops, Something went wrong!!!");
                }
                console.log(error.response);
            },

            reset: function () {
                this.user.password_confirm = this.user.password = null;
                this.errors = {};
            }
        }
    }
</script>
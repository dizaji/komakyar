<template>
    <div class="panel panel-info" v-if="!deleted">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-10">
                    {{ parent.user.first_name }} {{ parent.user.surname }} ( {{ parent.relative | relative }} )
                </div>
                <div class="col-xs-2 text-left">
                    <template v-if="mode === 'show'">
                        <button class="btn btn-sm btn-primary" v-on:click="toggleMode">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                        <button class="btn btn-sm btn-danger" v-on:click="$refs.confirm_delete_modal.show()">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                        <confirm-delete-modal ref="confirm_delete_modal"
                                              v-on:confirm="btnDeleteClicked"></confirm-delete-modal>
                    </template>
                    <template v-else="">
                        <button class="btn btn-sm btn-success" v-on:click="btnUpdateClicked">
                            <span class="glyphicon glyphicon-ok"></span>
                        </button>
                        <button class="btn btn-sm btn-default" v-on:click="toggleMode">
                            <span class="glyphicon glyphicon-remove"></span>
                        </button>
                    </template>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <validation-errors-alert :errors="errors"></validation-errors-alert>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-2 col-md-4 control-label">نام</label>
                        <div class="col-sm-10 col-md-8">
                            <input v-if="mode === 'edit'"
                                   class="form-control"
                                   id="input-name"
                                   placeholder="حسن"
                                   v-model="editable_parent.user.first_name">
                            <p v-else="" class="form-control-static">{{ parent.user.first_name }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-2 col-md-4 control-label">نام خانوادگی</label>
                        <div class="col-sm-10 col-md-8">
                            <input v-if="mode === 'edit'"
                                   class="form-control"
                                   id="input-surname"
                                   placeholder="شیرازی"
                                   v-model="editable_parent.user.surname">
                            <p v-else="" class="form-control-static">{{ parent.user.surname }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-2 col-md-4 control-label">کد ملی</label>
                        <div class="col-sm-10 col-md-8">
                            <input v-if="mode === 'edit'"
                                   class="form-control"
                                   id="input-username"
                                   placeholder="حسن"
                                   v-model="editable_parent.user.national_code">
                            <p v-else="" class="form-control-static">{{ parent.user.national_code }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-2 col-md-4 control-label">ایمیل</label>
                        <div class="col-sm-10 col-md-8">
                            <input v-if="mode === 'edit'"
                                   class="form-control"
                                   id="input-email"
                                   placeholder="شیرازی"
                                   v-model="editable_parent.user.email">
                            <p v-else="" class="form-control-static">{{ parent.user.email }}</p>
                        </div>
                        <div class="clearfix"></div>
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
                                   placeholder="XXXXXX"
                                   v-model="editable_parent.user.password">
                        </div>
                        <div class="clearfix"></div>
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
                                   placeholder="XXXXXX"
                                   v-model="editable_parent.user.password_confirm">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="input-relative" class="col-sm-2 col-md-4 control-label">نسبت</label>
                        <div class="col-sm-10 col-md-8">
                            <select v-if="mode === 'edit'"
                                    class="form-control"
                                    id="input-relative"
                                    v-model="editable_parent.relative">
                                <option value="father">پدر</option>
                                <option value="mother">مادر</option>
                                <option value="other">سایر</option>
                            </select>
                            <p v-else="" class="form-control-static">{{ parent.relative | relative }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-2 col-md-4 control-label">موبایل 1</label>
                        <div class="col-sm-10 col-md-8">
                            <input v-if="mode === 'edit'"
                                   class="form-control"
                                   id="input-mobile1"
                                   placeholder="0912XXXXXXX"
                                   v-model="editable_parent.mobile_1">
                            <p v-else="" class="form-control-static">{{ parent.mobile_1 }}</p>
                        </div>
                        <div class="clearfix"></div>
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
                                   v-model="editable_parent.mobile_2">
                            <p v-else="" class="form-control-static">{{ parent.mobile_2 }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['student', 'parent'],
        data() {
            return {
                mode: 'show',
                errors: {},
                editable_parent: $.extend(true, {}, this.parent),
                deleted: false,
            }
        },
        filters: {
            relative: function (value) {
                switch (value) {
                    case 'father':
                        return 'پدر';
                    case 'mother':
                        return 'مادر';
                    default:
                        return 'سایر';
                }
            }
        },
        watch: {
            mode: function (newMode) {
                $.extend(true, this.editable_parent, this.parent);
                this.editable_parent.user.password = null;
                this.editable_parent.user.password_confirm = null;
            }
        },
        methods: {
            toggleMode: function () {
                this.mode = (this.mode === 'show' ? 'edit' : 'show');
            },
            btnUpdateClicked: function () {
                this.$Progress.start();
                this.errors = {};

                if(this.editable_parent.user.password === '') delete this.editable_parent.user.password;
                if(this.editable_parent.user.password_confirm === '') delete this.editable_parent.user.password_confirm;

                axios.put(route('staff.student.parent.update', {
                    student: this.student.id,
                    parent: this.parent.id
                }), window.removeNulls(this.editable_parent))
                    .then(this.onUpdateSuccess)
                    .catch(this.onUpdateError);
            },
            onUpdateSuccess: function (response) {
                $.extend(true, this.parent, response.data);
                this.toggleMode();
                this.$Progress.finish();
            },
            onUpdateError: function (error) {
                this.$Progress.fail();
                if (error.response.status === 422) {
                    this.errors = error.response.data;
                } else {
                    alert("Oops, Something went wrong!!!");
                }
                console.log(error.response);
            },
            btnDeleteClicked() {
                this.$Progress.start();
                this.errors = {};

                axios.delete(route('staff.student.parent.destroy', {student: this.student.id, parent: this.parent.id}))
                    .then(this.onDeleteSuccess)
                    .catch(this.onLoadError);
            },
            onDeleteSuccess: function (response) {
                this.$Progress.finish();
                this.deleted = true;
                this.$emit('delete');
            },
            onLoadError(error) {
                this.$Progress.fail();
                alert("Oops, Something went wrong!!!");
                console.log(error.response);
            }
        }
    }
</script>
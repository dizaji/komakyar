<template>
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    {{ presentation.course.title }}
                </div>
                <div class="col-xs-6 text-left">
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
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 col-md-3 control-label">درس</label>
                        <div class="col-sm-8 col-md-9">
                            <p class="form-control-static">{{ presentation.course.title }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 col-md-3 control-label">ضریب</label>
                        <div class="col-sm-8 col-md-9">
                            <p class="form-control-static">{{ presentation.course.multiplier }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 col-md-3 control-label">نام منبع</label>
                        <div class="col-sm-8 col-md-9">
                            <p class="form-control-static">{{ presentation.course.reference_name }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 col-md-3 control-label">کد منبع</label>
                        <div class="col-sm-8 col-md-9">
                            <p class="form-control-static">{{ presentation.course.reference_code }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-description">توضیحات</label>
                        <div class="col-sm-10">
                            <input v-if="mode === 'edit'"
                                   class="form-control"
                                   id="input-description"
                                   placeholder="توضیحاتی در مورد این ارائه درس"
                                   v-model="editable_presentation.description">
                            <p v-else="" class="form-control-static">{{ presentation.description }}</p>
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
        props: ['teacher', 'presentation'],
        data() {
            return {
                mode: 'show',
                errors: {},
                editable_presentation: $.extend(true, {}, this.presentation),
                deleted: false,
            }
        },
        watch: {
            mode: function (newMode) {
                $.extend(true, this.editable_presentation, this.presentation);
            }
        },
        methods: {
            toggleMode: function () {
                this.mode = (this.mode === 'show' ? 'edit' : 'show');
            },
            btnUpdateClicked: function () {
                this.$Progress.start();
                this.errors = {};

                axios.put(route('staff.teacher.presentation.update', {
                    teacher: this.teacher.id,
                    presentation: this.presentation.id
                }), window.removeNulls(this.editable_presentation))
                    .then(this.onUpdateSuccess)
                    .catch(this.onUpdateError);
            },
            onUpdateSuccess: function (response) {
                $.extend(true, this.presentation, response.data);
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

                axios.delete(route('staff.teacher.presentation.destroy', {teacher: this.teacher.id, presentation: this.presentation.id}))
                    .then(this.onDeleteSuccess)
                    .catch(this.onError);
            },
            onDeleteSuccess: function (response) {
                this.$Progress.finish();
                this.deleted = true;
                this.$emit('delete');
            },
            onError(error) {
                this.$Progress.fail();
                alert("Oops, Something went wrong!!!");
                console.log(error.response);
            }
        }
    }
</script>
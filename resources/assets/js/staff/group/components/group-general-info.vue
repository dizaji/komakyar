<template>
    <div class="form-horizontal">
        <div class="row">
            <div class="col-xs-12 text-left margin-10">
                <edit-update-delete-buttons v-model="mode"
                                            v-on:update="btnUpdateClicked"
                                            v-on:delete="btnDeleteClicked"></edit-update-delete-buttons>
            </div>
        </div>
        <validation-errors-alert :errors="errors"></validation-errors-alert>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label" for="input-title">عنوان</label>
                    <div class="col-sm-10 col-md-8">
                        <input v-if="mode === 'edit'" class="form-control" id="input-title" placeholder="گروه 101"
                               v-model="editable_group.title">
                        <p v-else="" class="form-control-static">{{ group.title }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label" for="input-academic-year">سال تحصیلی</label>
                    <div class="col-sm-10 col-md-8">
                        <select v-if="mode === 'edit'"
                                class="form-control"
                                id="input-academic-year"
                                v-model="editable_group.academic_year_id">
                            <option v-for="academic_year in academic_years" :value="academic_year.id">
                                {{ academic_year.title }}
                            </option>
                        </select>
                        <p v-else="" class="form-control-static">{{ group.academic_year.title }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="mode === 'edit'">
            <div class="col-xs-12">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-level-field">پایه / رشته</label>
                    <div class="col-sm-10">
                        <select class="form-control"
                                id="input-level-field"
                                v-model="editable_group.level_field_id">
                            <option v-for="level_field in level_fields" :value="level_field.id">
                                {{ level_field.level.title }} / {{ level_field.field.title }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-else="">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">پایه</label>
                    <div class="col-sm-10 col-md-8">
                        <p class="form-control-static">{{ group.level_field.level.title }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-md-4 control-label">رشته</label>
                    <div class="col-sm-10 col-md-8">
                        <p class="form-control-static">{{ group.level_field.field.title }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import AcademicYear from '../../../mixins/lookups/academic-years.vue';
    import LevelField from '../../../mixins/lookups/level-fields.vue';

    export default {
        props: ['group'],
        data: function () {
            return {
                editable_group: $.extend(true, {}, this.group),
                mode: 'show',
                errors: [],
            }
        },
        mixins: [LevelField, AcademicYear],
        watch: {
            mode: function (newMode) {
                $.extend(true, this.editable_group, this.group);
            }
        },
        methods: {
            btnUpdateClicked: function () {
                this.$Progress.start();
                axios.put(route('staff.group.update', {group: this.group.id}), this.editable_group)
                    .then(this.onUpdateSuccess)
                    .catch(this.onUpdateError)
            },
            onUpdateSuccess: function (response) {
                this.errors = {};
                this.mode = 'show';
                $.extend(true, this.group, response.data);
                this.$Progress.finish();
            },
            onUpdateError(error) {
                this.$Progress.fail();
                if (error.response.status === 422) {
                    this.errors = error.response.data;
                } else {
                    alert("Oops, Something went wrong!!!");
                }
                console.log(error.response);
            },

            btnDeleteClicked: function () {
                axios.delete(route('staff.group.delete', {group: this.group.id}))
                    .then(this.onDeleteSuccess)
                    .catch(this.onDeleteError);
            },
            onDeleteSuccess: function (response) {
                //
            },
            onDeleteError: function (error) {

            },
        }

    }
</script>
<template>
    <tr>
        <td>
            <span v-if="mode === 'show'">
                {{ course.title }}
            </span>
            <input v-else=""
                   class="form-control input-sm"
                   placeholder="فیزیک 1"
                   v-model="editable_course.title"/>
        </td>
        <td>
            <span v-if="mode === 'show'">
                {{ course.multiplier }}
            </span>
            <input v-else=""
                   class="form-control input-sm"
                   placeholder="3"
                   v-model="editable_course.multiplier"/>
        </td>
        <td>
            <span v-if="mode === 'show'">
                {{ course.reference_name }}
            </span>
            <input v-else=""
                   class="form-control input-sm"
                   placeholder="فیزیک 1 و آزمایشگاه"
                   v-model="editable_course.reference_name"/>
        </td>
        <td>
            <span v-if="mode === 'show'">
                {{ course.reference_code }}
            </span>
            <input v-else=""
                   class="form-control input-sm"
                   placeholder="134/98"
                   v-model="editable_course.reference_code"/>
        </td>
        <td>
            <edit-update-delete-buttons v-model="mode"
                                        v-on:update="btnUpdateClicked"
                                        v-on:delete="btnDeleteClicked"></edit-update-delete-buttons>
        </td>
    </tr>
</template>
<script>
    export default {
        props: ['course'],
        data: function () {
            return {
                editable_course: $.extend(true, {}, this.course),
                mode: 'show',
                errors: [],
            }
        },
        watch: {
            mode: function (newMode) {
                $.extend(true, this.editable_course, this.course);
            }
        },
        methods: {
            btnUpdateClicked: function () {
                this.$Progress.start();
                axios.put(route('staff.lookup.course.update', {course: this.course.id}), this.editable_course)
                    .then(this.onUpdateSuccess)
                    .catch(this.onUpdateError)
            },
            onUpdateSuccess: function (response) {
                this.errors = {};
                this.mode = 'show';
                $.extend(true, this.course, response.data);
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
                this.$Progress.start();
                axios.delete(route('staff.lookup.course.destroy', {course: this.course.id}))
                    .then(this.onDeleteSuccess)
                    .catch(this.onDeleteError);
            },
            onDeleteSuccess: function (response) {
                this.$Progress.finish();
                this.$emit('deleted');
            },
            onDeleteError: function (error) {
                this.$Progress.fail();
                alert("Oops, Something went wrong!!!");
                console.log(error.response);
            },
        }
    }
</script>

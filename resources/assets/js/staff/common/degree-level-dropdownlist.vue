<template>
    <select class="form-control"
            v-model="selected_value"
            :id="id">
        <option value="below diploma">
            <div>زیر دیپلم</div>
        </option>
        <option value="diploma">
            <div>دیپلم</div>
        </option>
        <option value="above diploma">
            <div>فوق دیپلم</div>
        </option>
        <option value="bsc">
            <div>کارشناسی</div>
        </option>
        <option value="msc">
            <div>کارشناسی ارشد</div>
        </option>
        <option value="phd">
            <div>دکتری</div>
        </option>
        <option value="">
            <div>موارد دیگر</div>
        </option>
    </select>
</template>
<script>
    export default {
        props: ['id', 'value'],
        data: function () {
            return {
                selected_value: this.value,
            }
        },
        watch: {
            selected_value: function (newSelectedValue) {
                this.$emit('input', newSelectedValue);
            }
        }
    }
</script>
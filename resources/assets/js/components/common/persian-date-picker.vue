<template>
    <div class="col-xs-12">
        <div class="col-xs-3">
            <select v-model="date.day" class="form-control" style="width: initial; padding: 0 2px; height: 25px">
                <option v-for="day in daysRanges[date.month - 1]">
                    {{ day }}
                </option>
            </select>
        </div>
        <div class="col-xs-1"><span class="glyphicon glyphicon-minus"></span></div>
        <div class="col-xs-3">
            <select v-model="date.month" class="form-control" style="width: initial; padding: 0 2px; height: 25px">
                <option v-for="month in 12" :value="month">
                    {{ month }}
                </option>
            </select>
        </div>
        <div class="col-xs-1"><span class="glyphicon glyphicon-minus"></span></div>
        <div class="col-xs-3">
            <select v-model="date.year" class="form-control" style="width: initial; padding: 0 2px; height: 25px">
                <option v-for="year in 80" :value="year+1320">
                    {{ year + 1320 }}
                </option>
            </select>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['value'],
        data: function () {
            return {
                date: {
                    year: (this.value ? jmoment(this.value, 'YYYY-M-D') : jmoment()).jYear(),
                    month: (this.value ? jmoment(this.value, 'YYYY-M-D') : jmoment()).jMonth() + 1,
                    day: (this.value ? jmoment(this.value, 'YYYY-M-D') : jmoment()).jDate(),
                },
                daysRanges: [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29],
            }
        },
        mounted: function () {
            this.$emit('input', jmoment(this.date.year + ' ' + this.date.month + ' ' + this.date.day, 'jYYYY jM jD').format('YYYY-M-D'));
        },
        watch: {
            date: {
                handler(newDate) {
                    this.daysRanges[11] = (jmoment.jIsLeapYear(newDate.year)) ? 30 : 29;
                    this.$emit('input', jmoment(newDate.year + ' ' + newDate.month + ' ' + newDate.day, 'jYYYY jM jD').format('YYYY-M-D'));
                },
                deep: true
            }
        },
    }
</script>
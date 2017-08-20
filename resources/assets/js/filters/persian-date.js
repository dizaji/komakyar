
    module.exports = (function (value) {
        try {
            return jmoment(value, "YYYY-M-D").format("jYYYY-jM-jD");
        } catch (e) {
            return "";
        }
    })
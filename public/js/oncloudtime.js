/** Custom Javascript functions */

$(document).ready(function() {
    // This is copied as is from the paper-dashboard.js library as part of trying to remove its functionality
    // We put modals out of wrapper to working properly
    $('.modal').appendTo("body");

    jQuery.validator.addMethod("lettersandnumbersonly", function(value, element) {
        return this.optional(element) || /^[a-z0-9]+$/i.test(value);
    }, "The field must contain only letters and numbers.");

    jQuery.validator.addMethod("lettersnumbersspacesanddashes", function(value, element) {
        return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
    }, "The field must contain only letters, numbers, spaces and dashes.");
    jQuery.validator.addMethod("lettersnumbersspacesdashesdotandcommas", function(value, element) {
        return this.optional(element) || /^[a-z0-9\,\-\s]+$/i.test(value);
    }, "The field must contain only letters, numbers, spaces, commas, dot and dashes.");
    jQuery.validator.addMethod("roles", function(value, elem, param) {
        return $(".roles:checkbox:checked").length > 0;
    },"You must select at least one role!");

    jQuery.validator.addMethod("enddate", function(value, element) {
        var startdatevalue = $(".startdate").val().trim();
        if (startdatevalue.length == 0) {
            // basically do not validate
            return true;
        }
        return Date.parse(startdatevalue) <= Date.parse(value);
    }, "End Date should be greater than Start Date");

    jQuery.validator.addMethod("strongpassword", function (value, element) {
        return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}$/i.test(value);
    }, "Passwords must be between 8-32 characters with uppercase letters, lowercase letters and at least one number.");


    // initialize the date picker
    initDatePicker();
});

/**
 * Initialize the date picker
 */
function initDatePicker() {
    $('.datepicker').datetimepicker({
        format: 'yyyy-mm-dd',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
    });
}
/**
 * Clear a form - sourced from https://www.sitepoint.com/jquery-function-clear-form-data/
 *
 * usage:
 * $('#flightsSearchForm').clearForm();
 */
$.fn.clearForm = function() {
    return this.each(function() {
        var type = this.type, tag = this.tagName.toLowerCase();
        if (tag == 'form')
            return $(':input',this).clearForm();
        if (type == 'text' || type == 'password' || tag == 'textarea' || type == 'hidden')
            this.value = '';
        else if (type == 'checkbox' || type == 'radio')
            this.checked = false;
        else if (tag == 'select')
            this.selectedIndex = -1;
    });
};
/**
 * Source: https://css-tricks.com/snippets/jquery/serialize-form-to-json/
 * 
 * Serialize an object to JSON
 */
$.fn.serializeObjectToJSON = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

/**
 * Change the form data to a comma delimited list
 * @param data
 * @returns {*}
 */
function getSerializedFormDataAsCommaDelimitedString(data) {
    return toTitleCase(data.replace(/&/g, ", "));
}

/**
 * Change the first letter of every word to title case
 *
 * @param str The string
 * @returns str with the first letter of every word capitalized
 */
function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt){
        return txt.charAt(0).toUpperCase() + txt.substr(1);
    });
}

function generateTemplateMappingTable(data) {
    var html = '';

    var header = data[0];
    var sample_row = data[1];

    if (header && header.constructor === Array && header.length === 0) {
        return 'Error there is no sample data to process'
    }
    if (sample_row && sample_row.constructor === Array && sample_row.length === 0) {
        return 'Error at least two rows have to be provided for the mapping '
    }

    for(var item in header) {
        html += '<tr>';
        html +=   '<td>';
        html +=  header[item];
        // add a hidden field for the column name while:
        // 1. removing any whitespace at the ends
        // 2. removing any characters that are not numbers or letters with  in the column name as column definitions do not allow special characters
        // 3. turning the column names to lower case as this is done silently in Athena but fails in Spark
        html += '<input type="hidden" class="columnname" id="columnname_'+ item +'" name="columnname_'+ item +'" value="' + header[item].trim().replace(/[^A-Za-z0-9]+/g,'').toLowerCase() + '" />'
        html += '</td>';

        html +=   '<td>' + sample_row[item] + '</td>';
        html +=   '<td class="datatype text-nowrap" data-id="' + item + '"></td>';
        html +=   '<td class="processing text-nowrap" data-id="' + item + '"></td>';
        html +=   '<td class="parameters text-nowrap" data-id="' + item + '"></td>';
        html +=   '<td class="target text-nowrap" data-id="' + item + '"></td>';
        html +=   '<td class="ordering text-nowrap" data-id="' + item + '"><div class="col-xs-2 ordering-div"></div></td>';
        html += '</tr>';
    }

    return html;
}

/**
 * Hide the submit button and show the working animation
 */
function hideSubmitButtonShowWorking() {
    jQuery(".btn-primary.submit, .btn-primary.create, .btn-finish").addClass("hide");
    jQuery("#working").removeClass("hide");
}

/**
 * After the AJAX is executed hide the working animation and show the submit button
 */
function showSubmitButtonHideWorking() {
    jQuery(".btn-primary.submit, .btn-primary.create, .btn-finish").removeClass("hide");
    jQuery("#working").addClass("hide");
}




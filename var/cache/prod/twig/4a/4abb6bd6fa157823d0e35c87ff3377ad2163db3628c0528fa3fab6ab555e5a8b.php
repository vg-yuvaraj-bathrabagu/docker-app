<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* footer.twig */
class __TwigTemplate_c14ae149391f5630df885cd257821420a64ce631082b1ec5752d07e053cd5141 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "footer.twig"));

        // line 1
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("IS_AUTHENTICATED_FULLY")) {
        } else {
            // line 3
            echo "<footer class=\"footer\">
    <div class=\"row\">
        <div class=\"copyright center-block\">
            &copy; ";
            // line 6
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, (isset($context["company_name"]) || array_key_exists("company_name", $context) ? $context["company_name"] : (function () { throw new RuntimeError('Variable "company_name" does not exist.', 6, $this->source); })()), "html", null, true);
            echo ". All Rights Reserved
        </div>
    </div>
</footer>
";
        }
        // line 11
        echo "    <!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
    <script src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery-3.1.1.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery-ui.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/perfect-scrollbar.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/bootstrap.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>

    <!--  Forms Validations Plugin -->
    <script src=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery.validate.min.js"), "html", null, true);
        echo "\"></script>

    <!-- Promise Library for SweetAlert2 working on IE -->
    <script src=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/es6-promise-auto.min.js"), "html", null, true);
        echo "\"></script>

    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/moment.min.js"), "html", null, true);
        echo "\"></script>

    <!--  Date Time Picker Plugin is included in this js file -->
    <script src=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/bootstrap-datetimepicker.js"), "html", null, true);
        echo "\"></script>

    <!--  Select Picker Plugin -->
    <script src=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/bootstrap-selectpicker.js"), "html", null, true);
        echo "\"></script>

    <!--  Checkbox, Radio, Switch and Tags Input Plugins -->
    <script src=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/bootstrap-switch-tags.js"), "html", null, true);
        echo "\"></script>

    <!--  Notifications Plugin    -->
    <script src=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/bootstrap-notify.js"), "html", null, true);
        echo "\"></script>

    <!-- Sweet Alert 2 plugin -->
    <script src=\"";
        // line 39
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/sweetalert2.js"), "html", null, true);
        echo "\"></script>

    <!-- Wizard Plugin    -->
    <script src=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery.bootstrap.wizard.min.js"), "html", null, true);
        echo "\"></script>

    <!--  Plugin for DataTables.net  -->
    <script src=\"";
        // line 45
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery.datatables.js"), "html", null, true);
        echo "\"></script>

    <!-- Calendar display library -->
    <script src=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/fullcalendar.min.js"), "html", null, true);
        echo "\"></script>

    <script src=\"";
        // line 50
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/paper-dashboard.js?v=1.2.1"), "html", null, true);
        echo "\"></script>


    <!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
    <script src=\"";
        // line 54
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/demo.js"), "html", null, true);
        echo "\"></script>

    <!--   Sharrre Library    -->
    <script src=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery.sharrre.js"), "html", null, true);
        echo "\"></script>

    <!--   JQuery CSV reading library    -->
    <script src=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery.csv.min.js"), "html", null, true);
        echo "\"></script>

    <!--   JQuery File Download library    -->
    <script src=\"";
        // line 63
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery.file.download.js"), "html", null, true);
        echo "\"></script>

    <!-- Custom Project specific javascript -->
    <script src=\"";
        // line 66
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/oncloudtime.js"), "html", null, true);
        echo "\"></script>

<script type=\"text/javascript\">
    \$(document).ready(function () {
        \$('li').removeClass('active');
        \$('div').removeClass('in').removeClass('active');
        var activeClass = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
        \$('.' + activeClass).parents('li').addClass('active');
        if (\$('.' + activeClass).parent('li').closest('div')) {
            \$('.' + activeClass).parent('li').closest('div').addClass('in').addClass('active');
        }

        /* hide all inactive collapsed sections, but not the current one */
        \$('.sidebar-wrapper a').click( function(e) {
            \$('.collapse:not(.active)').collapse('hide');
        });
        // Setup the DataTables where used
        setupDataTable();

        // setup all links in containers with the new-window-link class to open in a new window
        \$('.new-window-link a').attr('target', '_blank');

        ";
        // line 88
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("IS_AUTHENTICATED_FULLY")) {
            // line 89
            echo "            // show notificaitons only when the user is logged in
            \$.ajax({
                url: \"notifications\",
                // the formData function is available in almost all new browsers.
                type: \"GET\",
                dataType: \"json\",
                error: function (err) {
                    error = true;
                },
                success: function (data) {

                },
                complete: function (data) {
                    showNotifications(data);
                }
            });
        ";
        }
        // line 106
        echo "    });

    // close button on forms and the x closing modals should clear when clicked
    \$(document).on('click', '.btn-secondary, .btn-secondary.cls, .close', function() {
        \$('.btn-secondary').closest(\"form\").clearForm();
        \$(\".create\").html('Create');
        // empty the error contents too
        \$('#error_contents').html(\"\");
    });

    // mark a notification as read
    \$(document).on('click', '.notification-row', function () {
        var readUrl = \$(this).attr('data-location');

        var isread = \$(this).attr('data-isread');
        if (isread === '0') {
            error = false;
            \$.ajax({
                url: readUrl,
                type: \"get\",
                error: function (err) {
                    console.error(err);
                    error = true;
                },
                success: function (data) {
                    var read_count = \$('#notification-count').data('count');
                    // reduce the count of read notifications
                    changeNotificationCount(read_count -1);
                }
            });
            if (!error) {
                // no error has occured
                \$(this).attr('data-isread', 1);
                \$(this).find(\"i\").removeClass(\"fa-envelope\").addClass(\"fa-envelope-open-o\");
            }
        }
    });

    /**
     * Setup Datatables configuration since tables are reloaded via AJAX
     */
    function setupDataTable(selector = '.table:not(.no-datatable)') {
        /* Data Table plugin integration - the no-datatable class stops this styling from being applied*/
        var table = \$(selector).DataTable({
            'dom': '<\"top\">tp',
            \"pagingType\" : \"simple_numbers\",
            \"pageLength\": ";
        // line 152
        echo twig_escape_filter($this->env, (isset($context["tables_rows_per_page"]) || array_key_exists("tables_rows_per_page", $context) ? $context["tables_rows_per_page"] : (function () { throw new RuntimeError('Variable "tables_rows_per_page" does not exist.', 152, $this->source); })()), "html", null, true);
        echo ",
            \"order\": [],
            language: {
                paginate: {
                    next: '&gt;', // or '>'
                    previous: '&lt;' // or '<'
                }
            }
        });

        \$('.search').on('keyup', function(){
            table.search(this.value).draw();
        });
        // This is copied as is from the paper-dashboard.js library as part of trying to remove its functionality
        // We put modals out of wrapper to working properly
        \$('.modal').appendTo(\"body\");
        // setup all links in containers with the new-window-link class to open in a new window
        \$('.new-window-link a').attr('target', '_blank');
    }

    /**
     * Setup Datatables configuration for the Upload page which includes a filter on the folder column
     */
    function setupUploadDataTable(selector = '.table:not(.no-datatable)') {
        /* Data Table plugin integration - the no-datatable class stops this styling from being applied*/
        var table = \$(selector).DataTable({
            'dom': '<\"top\">tp',
            \"pagingType\" : \"simple_numbers\",
            \"pageLength\": ";
        // line 180
        echo twig_escape_filter($this->env, (isset($context["tables_rows_per_page"]) || array_key_exists("tables_rows_per_page", $context) ? $context["tables_rows_per_page"] : (function () { throw new RuntimeError('Variable "tables_rows_per_page" does not exist.', 180, $this->source); })()), "html", null, true);
        echo ",
            \"order\": [],
            language: {
                paginate: {
                    next: '&gt;', // or '>'
                    previous: '&lt;' // or '<'
                }
            },
            initComplete: function () {
                // columns use a 0 based column index
                this.api().columns(2).every( function () {
                    var column = this;
                    var select = \$('<select id=\"folder-filter\" class=\"form-control\"><option value=\"\">Filter by Folder</option></select>')
                        .on( 'change', function () {
                            var val = \$.fn.dataTable.util.escapeRegex(
                                \$(this).val()
                            );

                            column
                                .search( val ? '^'+val+'\$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value=\"'+d+'\">'+d+'</option>' )
                    } );
                    // add the select to the span
                    \$('#folder-filter-container').html(select);
                } );
            }
        });

        \$('.search').on('keyup', function(){
            table.search(this.value).draw();
        });
        // This is copied as is from the paper-dashboard.js library as part of trying to remove its functionality
        // We put modals out of wrapper to working properly
        \$('.modal').appendTo(\"body\");
        // setup all links in containers with the new-window-link class to open in a new window
        \$('.new-window-link a').attr('target', '_blank');
    }

    function pushNotification(message, notification, notifyType, stage) {
        \$.notify({
            icon: 'ti-bell',
            message: message

        }, {
            type: notifyType,
            timer: 5000
        });
        var cls = \"success\";
        var color = \"";
        // line 232
        echo twig_escape_filter($this->env, (isset($context["notification_success_color"]) || array_key_exists("notification_success_color", $context) ? $context["notification_success_color"] : (function () { throw new RuntimeError('Variable "notification_success_color" does not exist.', 232, $this->source); })()), "html", null, true);
        echo "\";
        if (notifyType === \"info\") {
            color = \"";
        // line 234
        echo twig_escape_filter($this->env, (isset($context["notification_info_color"]) || array_key_exists("notification_info_color", $context) ? $context["notification_info_color"] : (function () { throw new RuntimeError('Variable "notification_info_color" does not exist.', 234, $this->source); })()), "html", null, true);
        echo "\";
        }
        if (notification.indexOf('failed') >= 0) {
            cls = \"danger\";
            color = \"";
        // line 238
        echo twig_escape_filter($this->env, (isset($context["notification_failed_color"]) || array_key_exists("notification_failed_color", $context) ? $context["notification_failed_color"] : (function () { throw new RuntimeError('Variable "notification_failed_color" does not exist.', 238, $this->source); })()), "html", null, true);
        echo "\";
        }
        \$.ajax({
            url: \"pushnotification\",
            type: \"POST\",
            dataType: \"json\",
            data: {'message': message, \"category\": notifyType, \"color\": color},
            error: function (err) {
                error = true;
            },
            success: function (data) {

            },
            complete: function (data) {
                showNotifications(data);
            }
        });
    }

    function showNotifications(data) {
        var unread_count = 0;
        var content = \"\";
        for (i in data.responseJSON) {
            content += \"<li data-isread='\"+data.responseJSON[i].isread +\"' data-location='markread?id=\" + data.responseJSON[i].id + \"' style='background-color: \" + data.responseJSON[i].color + \"' class='bg-\" + data.responseJSON[i].category + \" notification-row'> <a href='javascript:void(0);'>\";
                if (data.responseJSON[i].isread === 0) {
                    unread_count++;
                    // add open envelope icon
                    content += '<i class=\"fa fa-envelope\"></i>&nbsp;';
                } else {
                    // add closed envelope icon
                    content += '<i class=\"fa fa-envelope-open-o\"></i>&nbsp;';
                }
            content += data.responseJSON[i].action + \"</a></li>\";
        }
        \$(\".notify\").html(content);
        // change the notification value by leveraging the after property
        changeNotificationCount(unread_count);
    }

    /**
     *
     *  Update the notification cout
     * @param unread_count Number of undread notifications
     */
    function changeNotificationCount(unread_count) {
        \$('head').append('<style>i.notification-icon:after{ content: \"' + unread_count + '\"} </style>');
        \$('#notification-count').data('count', unread_count);
    }

    /**
     * Initialize the date picker in popup windows
     */
    function initDatePicker() {
        \$('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD',    //use this format if you want the 12hours timpiecker with AM/PM toggle
            icons: {
                time: \"fa fa-clock-o\",
                date: \"fa fa-calendar\",
                up: \"fa fa-chevron-up\",
                down: \"fa fa-chevron-down\",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });

    }


</script>";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  367 => 238,  360 => 234,  355 => 232,  300 => 180,  269 => 152,  221 => 106,  202 => 89,  200 => 88,  175 => 66,  169 => 63,  163 => 60,  157 => 57,  151 => 54,  144 => 50,  139 => 48,  133 => 45,  127 => 42,  121 => 39,  115 => 36,  109 => 33,  103 => 30,  97 => 27,  91 => 24,  85 => 21,  79 => 18,  73 => 15,  69 => 14,  65 => 13,  61 => 12,  58 => 11,  48 => 6,  43 => 3,  40 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% if is_granted('IS_AUTHENTICATED_FULLY') %}
{% else %}
<footer class=\"footer\">
    <div class=\"row\">
        <div class=\"copyright center-block\">
            &copy; {{ \"now\" | date(\"Y\") }} {{ company_name }}. All Rights Reserved
        </div>
    </div>
</footer>
{% endif %}
    <!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
    <script src=\"{{ asset('js/jquery-3.1.1.min.js') }}\" type=\"text/javascript\"></script>
    <script src=\"{{ asset('js/jquery-ui.min.js') }}\" type=\"text/javascript\"></script>
    <script src=\"{{ asset('js/perfect-scrollbar.min.js') }}\" type=\"text/javascript\"></script>
    <script src=\"{{ asset('js/bootstrap.min.js') }}\" type=\"text/javascript\"></script>

    <!--  Forms Validations Plugin -->
    <script src=\"{{ asset('js/jquery.validate.min.js') }}\"></script>

    <!-- Promise Library for SweetAlert2 working on IE -->
    <script src=\"{{ asset('js/es6-promise-auto.min.js') }}\"></script>

    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src=\"{{ asset('js/moment.min.js') }}\"></script>

    <!--  Date Time Picker Plugin is included in this js file -->
    <script src=\"{{ asset('js/bootstrap-datetimepicker.js') }}\"></script>

    <!--  Select Picker Plugin -->
    <script src=\"{{ asset('js/bootstrap-selectpicker.js') }}\"></script>

    <!--  Checkbox, Radio, Switch and Tags Input Plugins -->
    <script src=\"{{ asset('js/bootstrap-switch-tags.js') }}\"></script>

    <!--  Notifications Plugin    -->
    <script src=\"{{ asset('js/bootstrap-notify.js') }}\"></script>

    <!-- Sweet Alert 2 plugin -->
    <script src=\"{{ asset('js/sweetalert2.js') }}\"></script>

    <!-- Wizard Plugin    -->
    <script src=\"{{ asset('js/jquery.bootstrap.wizard.min.js') }}\"></script>

    <!--  Plugin for DataTables.net  -->
    <script src=\"{{ asset('js/jquery.datatables.js') }}\"></script>

    <!-- Calendar display library -->
    <script src=\"{{ asset('js/fullcalendar.min.js') }}\"></script>

    <script src=\"{{ asset('js/paper-dashboard.js?v=1.2.1') }}\"></script>


    <!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
    <script src=\"{{ asset('js/demo.js')}}\"></script>

    <!--   Sharrre Library    -->
    <script src=\"{{ asset('js/jquery.sharrre.js') }}\"></script>

    <!--   JQuery CSV reading library    -->
    <script src=\"{{ asset('js/jquery.csv.min.js') }}\"></script>

    <!--   JQuery File Download library    -->
    <script src=\"{{ asset('js/jquery.file.download.js') }}\"></script>

    <!-- Custom Project specific javascript -->
    <script src=\"{{ asset('js/oncloudtime.js') }}\"></script>

<script type=\"text/javascript\">
    \$(document).ready(function () {
        \$('li').removeClass('active');
        \$('div').removeClass('in').removeClass('active');
        var activeClass = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
        \$('.' + activeClass).parents('li').addClass('active');
        if (\$('.' + activeClass).parent('li').closest('div')) {
            \$('.' + activeClass).parent('li').closest('div').addClass('in').addClass('active');
        }

        /* hide all inactive collapsed sections, but not the current one */
        \$('.sidebar-wrapper a').click( function(e) {
            \$('.collapse:not(.active)').collapse('hide');
        });
        // Setup the DataTables where used
        setupDataTable();

        // setup all links in containers with the new-window-link class to open in a new window
        \$('.new-window-link a').attr('target', '_blank');

        {% if is_granted('IS_AUTHENTICATED_FULLY') %}
            // show notificaitons only when the user is logged in
            \$.ajax({
                url: \"notifications\",
                // the formData function is available in almost all new browsers.
                type: \"GET\",
                dataType: \"json\",
                error: function (err) {
                    error = true;
                },
                success: function (data) {

                },
                complete: function (data) {
                    showNotifications(data);
                }
            });
        {% endif %}
    });

    // close button on forms and the x closing modals should clear when clicked
    \$(document).on('click', '.btn-secondary, .btn-secondary.cls, .close', function() {
        \$('.btn-secondary').closest(\"form\").clearForm();
        \$(\".create\").html('Create');
        // empty the error contents too
        \$('#error_contents').html(\"\");
    });

    // mark a notification as read
    \$(document).on('click', '.notification-row', function () {
        var readUrl = \$(this).attr('data-location');

        var isread = \$(this).attr('data-isread');
        if (isread === '0') {
            error = false;
            \$.ajax({
                url: readUrl,
                type: \"get\",
                error: function (err) {
                    console.error(err);
                    error = true;
                },
                success: function (data) {
                    var read_count = \$('#notification-count').data('count');
                    // reduce the count of read notifications
                    changeNotificationCount(read_count -1);
                }
            });
            if (!error) {
                // no error has occured
                \$(this).attr('data-isread', 1);
                \$(this).find(\"i\").removeClass(\"fa-envelope\").addClass(\"fa-envelope-open-o\");
            }
        }
    });

    /**
     * Setup Datatables configuration since tables are reloaded via AJAX
     */
    function setupDataTable(selector = '.table:not(.no-datatable)') {
        /* Data Table plugin integration - the no-datatable class stops this styling from being applied*/
        var table = \$(selector).DataTable({
            'dom': '<\"top\">tp',
            \"pagingType\" : \"simple_numbers\",
            \"pageLength\": {{ tables_rows_per_page }},
            \"order\": [],
            language: {
                paginate: {
                    next: '&gt;', // or '>'
                    previous: '&lt;' // or '<'
                }
            }
        });

        \$('.search').on('keyup', function(){
            table.search(this.value).draw();
        });
        // This is copied as is from the paper-dashboard.js library as part of trying to remove its functionality
        // We put modals out of wrapper to working properly
        \$('.modal').appendTo(\"body\");
        // setup all links in containers with the new-window-link class to open in a new window
        \$('.new-window-link a').attr('target', '_blank');
    }

    /**
     * Setup Datatables configuration for the Upload page which includes a filter on the folder column
     */
    function setupUploadDataTable(selector = '.table:not(.no-datatable)') {
        /* Data Table plugin integration - the no-datatable class stops this styling from being applied*/
        var table = \$(selector).DataTable({
            'dom': '<\"top\">tp',
            \"pagingType\" : \"simple_numbers\",
            \"pageLength\": {{ tables_rows_per_page }},
            \"order\": [],
            language: {
                paginate: {
                    next: '&gt;', // or '>'
                    previous: '&lt;' // or '<'
                }
            },
            initComplete: function () {
                // columns use a 0 based column index
                this.api().columns(2).every( function () {
                    var column = this;
                    var select = \$('<select id=\"folder-filter\" class=\"form-control\"><option value=\"\">Filter by Folder</option></select>')
                        .on( 'change', function () {
                            var val = \$.fn.dataTable.util.escapeRegex(
                                \$(this).val()
                            );

                            column
                                .search( val ? '^'+val+'\$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value=\"'+d+'\">'+d+'</option>' )
                    } );
                    // add the select to the span
                    \$('#folder-filter-container').html(select);
                } );
            }
        });

        \$('.search').on('keyup', function(){
            table.search(this.value).draw();
        });
        // This is copied as is from the paper-dashboard.js library as part of trying to remove its functionality
        // We put modals out of wrapper to working properly
        \$('.modal').appendTo(\"body\");
        // setup all links in containers with the new-window-link class to open in a new window
        \$('.new-window-link a').attr('target', '_blank');
    }

    function pushNotification(message, notification, notifyType, stage) {
        \$.notify({
            icon: 'ti-bell',
            message: message

        }, {
            type: notifyType,
            timer: 5000
        });
        var cls = \"success\";
        var color = \"{{ notification_success_color }}\";
        if (notifyType === \"info\") {
            color = \"{{ notification_info_color }}\";
        }
        if (notification.indexOf('failed') >= 0) {
            cls = \"danger\";
            color = \"{{ notification_failed_color }}\";
        }
        \$.ajax({
            url: \"pushnotification\",
            type: \"POST\",
            dataType: \"json\",
            data: {'message': message, \"category\": notifyType, \"color\": color},
            error: function (err) {
                error = true;
            },
            success: function (data) {

            },
            complete: function (data) {
                showNotifications(data);
            }
        });
    }

    function showNotifications(data) {
        var unread_count = 0;
        var content = \"\";
        for (i in data.responseJSON) {
            content += \"<li data-isread='\"+data.responseJSON[i].isread +\"' data-location='markread?id=\" + data.responseJSON[i].id + \"' style='background-color: \" + data.responseJSON[i].color + \"' class='bg-\" + data.responseJSON[i].category + \" notification-row'> <a href='javascript:void(0);'>\";
                if (data.responseJSON[i].isread === 0) {
                    unread_count++;
                    // add open envelope icon
                    content += '<i class=\"fa fa-envelope\"></i>&nbsp;';
                } else {
                    // add closed envelope icon
                    content += '<i class=\"fa fa-envelope-open-o\"></i>&nbsp;';
                }
            content += data.responseJSON[i].action + \"</a></li>\";
        }
        \$(\".notify\").html(content);
        // change the notification value by leveraging the after property
        changeNotificationCount(unread_count);
    }

    /**
     *
     *  Update the notification cout
     * @param unread_count Number of undread notifications
     */
    function changeNotificationCount(unread_count) {
        \$('head').append('<style>i.notification-icon:after{ content: \"' + unread_count + '\"} </style>');
        \$('#notification-count').data('count', unread_count);
    }

    /**
     * Initialize the date picker in popup windows
     */
    function initDatePicker() {
        \$('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD',    //use this format if you want the 12hours timpiecker with AM/PM toggle
            icons: {
                time: \"fa fa-clock-o\",
                date: \"fa fa-calendar\",
                up: \"fa fa-chevron-up\",
                down: \"fa fa-chevron-down\",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });

    }


</script>", "footer.twig", "/data/personal/docker-app/templates/footer.twig");
    }
}

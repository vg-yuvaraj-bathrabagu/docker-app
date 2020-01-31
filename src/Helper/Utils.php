<?php

/**
 * Utility functions to be used within the app
 *
 */

namespace App\Helper;


use App\Entity\User\AppUser;
use Aws\Athena\AthenaClient;
use Aws\S3\S3Client;
use DateTime;
use Parsedown;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Process\Process;

trait Utils
{
    /**
     * Build the absolute path of the script which is the shell directory within the app, leveraging the kernel.project_dir global variable
     *
     * @param string $script
     * @return string
     */
    public function getShellAbsolutePath(string $script) {
        return join(DIRECTORY_SEPARATOR, [$this->getShellWorkingDirectory(), $script]);
    }

    /**
     * Get the shell working directoty which is the shell directory within the app, leveraging the kernel.project_dir global variable
     *
     * @return string
     */
    public function getShellWorkingDirectory() {
        return join(DIRECTORY_SEPARATOR, [$this->getParameter('kernel.project_dir'), "shell"]);
    }

    /**
     * Get the S3 temporary upload directory
     *
     * @return string
     */
    public function getTemporaryUploadDirectoryForS3() {
        return join(DIRECTORY_SEPARATOR, [$this->getParameter('kernel.project_dir'), "var", "data"]);
    }

    /**
     * Get the log file name
     *
     * @return string
     */
    public function getShellScriptLogFileAbsolutePath($filename) {
        return join(DIRECTORY_SEPARATOR, [$this->getParameter('kernel.project_dir'), "var", "log", $filename]);
    }

    /**
     * Get the log file contents
     *
     * @param $filename The name of the log file
     *
     * @return string
     */
    public function getShellScriptLogFileContents(string $filename) {
        $parsedown = new Parsedown();
        $absoulte_file_path =  join(DIRECTORY_SEPARATOR, [$this->getParameter('kernel.project_dir'), "var", "log", $filename]);
        return $parsedown->text(nl2br(file_get_contents($absoulte_file_path)));
    }

    /**
     * Get a process instance to execute a database shell script by default all executions are not in the background
     * @param string $script
     * @param array $params
     * @param string $logfilename The name of the file to log to, if not provided then the output is redirected to /dev/null
     * @return Process
     */
    public function getDatabaseShellScriptProcess(string $script, array $params, string $logfilename = "", $background = false) {
        $log_file_path = '/dev/null';
        $background_process = "";
        if (!empty($logfilename)) {
            $log_file_path = $this->getShellScriptLogFileAbsolutePath($logfilename);
        }
        if ($background) {
            $background_process = "&";
        }
        return new Process($this->buildDatabaseShellScript($script, $params)." > ".$log_file_path." 2>&1 ".$background_process, $this->getShellWorkingDirectory(), null, null, null);
    }


    /**
     * Get a process instance to execute a  shell script
     *
     * @param string $script the name of the script file
     * @param array $params The script parameters
     * @return Process
     */
    public function getShellScriptProcess(string $script, array $params = null, string $logfilename = "", $background = false) {
        $file_path = '/dev/null';
        $background_process = "";
        if (!empty($logfilename)) {
            $file_path = $this->getShellScriptLogFileAbsolutePath($logfilename);
        }
        if ($background) {
            $background_process = "&";
        }
        // break up the parameters into a space delimited as expected by the shell
        $other_params = '';
        foreach ($params as $value) {
            $other_params .= escapeshellarg($value)." ";
        }
        return new Process($this->getShellAbsolutePath($script)." $other_params"." > ".$file_path." 2>&1 ".$background_process, $this->getShellWorkingDirectory(), null, null, null);
    }

    /**
     * Build a database connection shell script with the defined parameters.
     *
     * The first 4 parameters are database connection parameters in the following order
     *
     * - host
     * - username
     * - password
     * - database
     *
     * The order of the parameters is the order in which they are added to the params array
     *
     * @param $shell The absolute path of the shell script
     * @param $params An array of the parameters for the script which will be passed in the order they were added to the array
     *
     * @return string The shell script to be executed
     **/
    public function buildDatabaseShellScript($shell, $params) {
        $dbuser = escapeshellarg($this->getParameter('rdbms_user'));
        $dbpwd = escapeshellarg($this->getParameter('rdbms_password'));
        $dbname = escapeshellarg($this->getParameter('rdbms_dbname'));
        $dbhost = escapeshellarg($this->getParameter('rdbms_host'));
        // break up the parameters into a space delimited as expected by the shell
        $other_params = '';
        foreach ($params as $value) {
            $other_params .= escapeshellarg($value)." ";
        }

        return $this->getShellAbsolutePath($shell)." $dbhost $dbuser $dbpwd $dbname $other_params";
    }

    /**
     *
     * Build an array containing the message format for sending data to an SQS queue
     *
     * @param string $module The module sending the data
     * @param string $messageBody Array of the contents of the message body
     * @param AppUser $user The logged in use
     * @param string $uuid The uuid of the entity being processed
     * @param string $template optional template to transform the data
     * @return array The contents of the SQS message
     */
    public function buildQueueData($module, $messageBody, $user, $uuid = '', $template = '') {
        $user_profile_repository = $this->getDoctrine()->getRepository(AppUser::class);
        $profile = $user_profile_repository->find($user->getUsername()); // the username for the SecurityUser is the userid
        $action_info = [];
        if (!empty($template)) {
            $action_info['template'] = $template;
        }

        return [
            'MessageAttributes' => [
                'Account' => [
                    'DataType' => 'String', // REQUIRED
                    'StringValue' => $profile->getAccount()->getUuid() // TODO: Replace this with a unique ID from the account
                ],
                'User' => [
                    'DataType' => 'String', // REQUIRED
                    'StringValue' => $profile->getNickname()
                ],
                'Module' => [
                    'DataType' => 'String', // REQUIRED
                    'StringValue' => $module
                ],
                'Action' => [
                    'DataType' => 'String', // REQUIRED
                    'StringValue' => json_encode($action_info)
                ],
                'Key' => [
                    'DataType' => 'String', // REQUIRED
                    'StringValue' => $uuid
                ],
                'Timestamp' => [
                    'DataType' => 'String', // REQUIRED
                    'StringValue' => $this->getFormattedTimeStamp()
                ],
                // ...
            ],
            'MessageBody' => $messageBody, // REQUIRED
            'QueueUrl' => $this->getParameter('sqs_notificationQueue'), // REQUIRED
        ];
    }

    /**
     * Return the current time formatted to a date
     *
     * @return string
     */
    function getFormattedTimeStamp() {
        $t = microtime(true);
        $micro = sprintf("%06d",($t - floor($t)) * 1000000);
        $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
        return $d->format("Y-m-d H:i:s.u");  // note at point on "u"

    }

    /**
     *
     * Get the numeric account primary key for the account for the current logged in user
     *
     * @param $user
     * @return mixed
     */
    public function getAccountIdForLoggedInUser($user) {
        return $this->getAccountForLoggedInUser($user)->getId();
    }

    /**
     *
     * Get the name of the account for the current logged in user
     *
     * @param $user
     * @return mixed
     */
    public function getAccountNameForLoggedInUser($user) {
        return $this->getAccountForLoggedInUser($user)->getName();
    }

    /**
     * Get the account entity instance for the logged in user
     *
     * @param $user
     * @return mixed
     */
    public function getAccountForLoggedInUser($user) {
        $repository = $this->getDoctrine()->getRepository(AppUser::class);
        return $repository->find($user->getUsername())->getAccount();
    }

    /**
     * Get the AppUser entity instance for the logged in user
     *
     * @param $user
     * @return mixed
     */
    public function getAppUserInstance($user) {
        $repository = $this->getDoctrine()->getRepository(AppUser::class);
        return $repository->find($user->getUsername());
    }

    /**
     * Get the username of the logged in user
     *
     * @param $user
     * @return mixed
     */
    public function getLoggedInUsername($user) {
        $user_profile_repository = $this->getDoctrine()->getRepository(AppUser::class);
        $profile = $user_profile_repository->find($user->getUsername()); // the username for the SecurityUser is the userid
        return trim($profile->getNickname());
    }

    /**
     *
     * Get the location of the log files for user actions
     *
     * @param $user
     * @param $logfilename
     * @return string
     */
    public function getPathToS3UploadFolderForUserAction($user) {
        return join ("/", [$this->getParameter('s3_bucket'), "data",$this->getAccountS3FolderName($this->getAccountNameForLoggedInUser($user)), "home", $this->getLoggedInUsername($user), ""]); // last empty entry to add a trailing /
    }

    /**
     *
     * Compute the percentage of file upload progress
     * @param $value
     * @param $total
     * @return string
     */
    public function getPercentage($value, $total) {
        $percentage = number_format(($value / $total) * 100, 2);

        return $percentage;
    }

    /**
     * Get the S3 bucket defined by the s3.bucket parameter
     *
     * @return String the S3 bucket
     */
    public function getS3Bucket(){
        return $this->getParameter('s3_bucket');
    }

    public function processAthenaQuery(AthenaClient $athena, string $query) {
        $promise = $athena->startQueryExecutionAsync([
            'QueryExecutionContext' => [
                'Database' => $this->getParameter('athena_database'),
            ],
            'QueryString' => $query, // REQUIRED
            'ResultConfiguration' => [ // REQUIRED
                'EncryptionConfiguration' => [
                    'EncryptionOption' => 'SSE_S3', // REQUIRED
                ],
                'OutputLocation' => $this->getParameter('athena_output'), // REQUIRED
            ],
        ]);

        $result = $promise->wait();
        $executionId = $result->getPath('QueryExecutionId');
        $this->waitForQuerySuccess($athena, $executionId);

        $resultPromise = $athena->getQueryResultsAsync(['QueryExecutionId' => $executionId]);

        return $resultPromise->wait();
    }

    private function waitForQuerySuccess(AthenaClient $athena, $executionId) {
        $isQueryStillRunning = true;
        while($isQueryStillRunning) {
            $state = $this->getQueryExecutionSatus($athena, $executionId);
            switch ($state) {
                case 'FAILED':
                    throw new \Exception ("Athena Query FAILED");
                    break;
                case 'CANCELLED':
                    throw new \Exception ("Athena Query Cancelled");
                    break;
                case 'SUCCEEDED':
                    $isQueryStillRunning = false;
                    break;
                default:
                    sleep(10);
                    break;
            }
        }

        return $state;
    }

    private function getQueryExecutionSatus(AthenaClient $athena, $executionId){
        $result = $athena->getQueryExecution([
            'QueryExecutionId' => "$executionId", // REQUIRED
        ]);
        $execution = $result->getPath('QueryExecution');

        return $execution['Status']['State'];
    }

    /**
     * Get an S3 client from the provided configuration
     *
     * @return S3Client
     */
    public function getS3Client() {
        // TODO: Get the S3 client instance from the container instead of recreating it here
        $s3Client = new S3Client([
            'version' =>  $this->getParameter('s3.version'),
            'region' =>  $this->getParameter('s3.region'), // choose your favorite region
            'credentials' => [
                // use your aws credentials
                'key' =>  $this->getParameter('aws_credentials_key'),
                'secret' => $this->getParameter('aws_credentials_secret'),
            ],
        ]);

        return $s3Client;
    }

    /**
     * Get the HTTPS url to an object from its s3 path
     *
     * @param String $path
     * @return String The HTTP url to the object
     */
    public function getObjectUrlFromS3Path(String $path) {
        // remove the bucket and s3:// to get the key
        $key = str_replace(str_replace($path, "s3://", ""), $this->getS3Bucket(), "");

        return $this->getS3Client()->getObjectUrl($this->getS3Bucket(), $key);

    }

    /**
     * Get an Athena client from the provided configuration
     *
     * @return AthenaClient
     */
    public function getAthenaClient() {
        $athenaClient = new AthenaClient([
            'version' =>  $this->getParameter('aws.version'),
            'region' =>  $this->getParameter('aws.region'), // choose your favorite region
            'credentials' => [
                // use your aws credentials
                'key' =>  $this->getParameter('aws_credentials_key'),
                'secret' => $this->getParameter('aws_credentials_secret'),
            ],
        ]);

        return $athenaClient;
    }

    /**
     * Generate a UUID 4 compliant string
     *
     * @return string
     */
    public function getUuid() {
        return Uuid::uuid4();
    }

    /**
     * Slightly modified version of http://www.geekality.net/2011/05/28/php-tail-tackling-large-files/
     * @author Torleif Berger, Lorenzo Stanco
     * @link http://stackoverflow.com/a/15025877/995958
     * @license http://creativecommons.org/licenses/by/3.0/
     */
    function readFileContents($filepath, $lines = 1, $adaptive = true) {
        ini_set("auto_detect_line_endings", true);
        // Open file
        $f = @fopen($filepath, "rb");
        if ($f === false) return false;

        // Sets buffer size
        if (!$adaptive) $buffer = 4096;
        else $buffer = ($lines < 2 ? 64 : ($lines < 10 ? 512 : 4096));

        // Start reading
        $output = '';
        while(($line = fgets($f,$buffer)) !== false) {
            if (feof($f)) break;
            $output .= $line;
        }

        // Close file and return
        fclose($f);
        return trim($output);
    }

    /**
     * Transform the field values from the form data into valid JSON for
     *  the database webservice to read
     *
     * Unmapped fields are set as follows:
     * - processing set to 1 (None)
     * - datatype set to String
     *
     * @param String $rules_field_values
     * @return string
     */
    public function transformTemplateFieldValuesToJSON($template, $tablename, ?String $rules_field_values){
        if (empty($rules_field_values)) {
            return $rules_field_values;
        }
        $rules_json_array = [];
        $rules_value_array = json_decode($rules_field_values);
        // loop through the array
        foreach($rules_value_array as $key => $value) {
            $key_values = explode("_", $key);
            if ($key_values[0] == 'columnname') {
                // change the value columnname to name
                $key_values[0] = "name";
            }
            // unmapped processing is set to 1 - None
            if ($key_values[0] == 'processing') {
                if (empty($value )) {
                    $value = "1";
                }
            }
            // unmapped datatype is set to String
            if ($key_values[0] == 'datatype') {
                if (empty($value)) {
                    $value = "String";
                }
            }
            $rules_json_array[$key_values[1]][$key_values[0]] = $value;
        }
        $mapping_values = array("template" => $template, "table" => $tablename, "columns" => $rules_json_array);
        return json_encode($mapping_values);
    }

    /**
     * Transform the rules JSON into the relevant form field values
     *
     * @param String $rules_json
     * @return string
     */
    public function transformJSONToTemplateFieldValues(?String $rules_json) {
        if (empty($rules_json)) {
            return $rules_json;
        }
        $rules_fields_array = [];
        $rules_value_array = json_decode($rules_json)->columns;

        foreach($rules_value_array as $key => $value) {
            foreach ($value as $field_key => $field_value) {
                if ($field_key == "name") {
                    $field_key = "columnname";
                }
                $rules_fields_array[$field_key."_".$key] = $field_value;
            }
        }

        return json_encode($rules_fields_array);
    }

    /**
     * Generate a string containing the column definitions in a comma delimited list
     *
     * @param String $rules_json
     * @return string
     */
    public function getCommaDelimitedColumnDefinition(?String $rules_json) {
        if (empty($rules_json)) {
            return $rules_json;
        }
        $column_definition = [];
        $column_values_array = json_decode($rules_json)->columns;

        foreach($column_values_array as $key => $value) {
            $column_definition[$key] = $value->name." ".strtolower($value->datatype);
        }
        ksort($column_definition);
        return join(", ", $column_definition);
    }

    /**
     * Converts CSV to multi dimensional array
     */
    function csv_to_multidimension_array($filename='', $delimiter=',')
    {
        if(!file_exists($filename) || !is_readable($filename)) {
            return false;
        }
        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 0, $delimiter)) !== false ) {
                $data[] = $row;
            }
            fclose($handle);
        }
        return $data;
    }

    /**
     * Removes all non alphanumberic characters from a string only leaves numbers, letters and dashes
     *
     * based on the example at https://stackoverflow.com/a/6442240/200120
     *
     * @param $text
     *
     * @return String with only alphanumeric characters and a dash
     */
    function removeAllNonAlphanumericCharacters($text) {
        return strtolower(preg_replace('/[^0-9a-zA-Z-]/', '', $text));
    }
    /**
     * Removes all non alphanumberic characters from a string only leaves numbers, letters and dashes
     *
     * based on the example at https://stackoverflow.com/a/6442240/200120
     *
     * @param $text
     *
     * @return String with only alphanumeric characters and a dash
     */
    function removeAllNonAlphanumericFromFileNameCharacters($text) {
        return strtolower(preg_replace('/[^0-9a-zA-Z-.]/', '', $text));
    }

    /**
     * Removes all non alphanumberic characters from a string only leaves numbers, letters and dashes from the account name leaving only valid characters that are used by other services like Athena
     *
     * based on the example at https://stackoverflow.com/a/6442240/200120
     *
     * @param $text
     *
     * @return String with only alphanumeric characters and a dash
     */
    function getAccountS3FolderName($text) {
        return (preg_replace('/[^0-9a-zA-Z]/', '', $text));
    }

    /**
     * Removes all array keys which are numeric - keeping those with string keys. This is used for creating an SQS message for only the values that are described by string keys
     *
     * @param $arr
     *
     * @return Array with only string keys
     */
    function getArrayWithoutNumericKeys($arr) {
        foreach ($arr as $key => $value) {
            if (is_int($key)) {
                unset($arr[$key]);
            }
        }

        return $arr;
    }

    public function formatDateValue($value) {
        if (empty($value)) {
            return 'NULL';
        }
        return "'".$value."''";
    }

    /**
     * The cache key is a string with the account id since each account will have its own key
     */
    public function getNexusDateListCacheKey() {
        return "nexus_date_cache_key".$this->getAccountId();
    }

    /**
     * Return the first day of the Week/Month/Quarter/Year that the
     * current/provided date falls within
     *
     * @param string   $period The period to find the first day of. ('year', 'quarter', 'month', 'week')
     * @param DateTime $date   The date to use instead of the current date
     *
     * @return DateTime
     * @throws InvalidArgumentException
     */
    function firstDayOf($period, DateTime $date = null)
    {
        $period = strtolower($period);
        $validPeriods = array('year', 'quarter', 'month', 'week');

        if ( ! in_array($period, $validPeriods))
            throw new InvalidArgumentException('Period must be one of: ' . implode(', ', $validPeriods));

        $newDate = ($date === null) ? new DateTime() : clone $date;

        switch ($period) {
            case 'year':
                $newDate->modify('first day of january ' . $newDate->format('Y'));
                break;
            case 'quarter':
                $month = $newDate->format('n') ;

                if ($month < 4) {
                    $newDate->modify('first day of january ' . $newDate->format('Y'));
                } elseif ($month > 3 && $month < 7) {
                    $newDate->modify('first day of april ' . $newDate->format('Y'));
                } elseif ($month > 6 && $month < 10) {
                    $newDate->modify('first day of july ' . $newDate->format('Y'));
                } elseif ($month > 9) {
                    $newDate->modify('first day of october ' . $newDate->format('Y'));
                }
                break;
            case 'month':
                $newDate->modify('first day of this month');
                break;
            case 'week':
                $newDate->modify(($newDate->format('w') === '0') ? 'monday last week' : 'monday this week');
                break;
        }

        return $newDate;
    }

    /**
     * Return the last day of the Week/Month/Quarter/Year that the
     * current/provided date falls within
     *
     * @param string   $period The period to find the last day of. ('year', 'quarter', 'month', 'week')
     * @param DateTime $date   The date to use instead of the current date
     *
     * @return DateTime
     * @throws InvalidArgumentException
     */
    function lastDayOf($period, DateTime $date = null)
    {
        $period = strtolower($period);
        $validPeriods = array('year', 'quarter', 'month', 'week');

        if ( ! in_array($period, $validPeriods))
            throw new InvalidArgumentException('Period must be one of: ' . implode(', ', $validPeriods));

        $newDate = ($date === null) ? new DateTime() : clone $date;

        switch ($period)
        {
            case 'year':
                $newDate->modify('last day of december ' . $newDate->format('Y'));
                break;
            case 'quarter':
                $month = $newDate->format('n') ;

                if ($month < 4) {
                    $newDate->modify('last day of march ' . $newDate->format('Y'));
                } elseif ($month > 3 && $month < 7) {
                    $newDate->modify('last day of june ' . $newDate->format('Y'));
                } elseif ($month > 6 && $month < 10) {
                    $newDate->modify('last day of september ' . $newDate->format('Y'));
                } elseif ($month > 9) {
                    $newDate->modify('last day of december ' . $newDate->format('Y'));
                }
                break;
            case 'month':
                $newDate->modify('last day of this month');
                break;
            case 'week':
                $newDate->modify(($newDate->format('w') === '0') ? 'now' : 'sunday this week');
                break;
        }

        return $newDate;
    }
}
<?php
/**
 * Custom project twig extensions 
 */

namespace App\Twig;


use GuzzleHttp\Client;
use ParseCsv\Csv;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class OncloudTimeTwigExtension extends AbstractExtension
{
    public function getFilters() {
        return array(
            new TwigFilter('reads3filecontents', array($this, 'readS3FileContents')),
            new TwigFilter('human_filesize', array($this, 'human_filesize')),
            new TwigFilter('json_decode', array($this, 'json_decode')),
            new TwigFilter('markdowntohtml', array($this, 'markdownToHTMLFilter')),
            new TwigFilter('iframecontent', array($this, 'getExternalContentInIframe')),
            new TwigFilter('csvtohtml', array($this, 'convertCSVStringToHTMLTable')),
            new TwigFilter('booleantoyesno', array($this, 'convertBooleanValueToYesNo')),
        );
    }

    /**
     *
     * Read the contents of the file in the provided url
     *
     * @param $url The url from which the contents are to be read
     * @return \Psr\Http\Message\StreamInterface|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function readS3FileContents($url) {
        if (empty($url)) {
            return "";
        }
        // Create a client and provide a base URL
        $client = new Client();
        try {
            return $client->request('GET', $url)->getBody()->getContents();
        } catch (\Exception $e) {
            return "Error loading the contents of the url ".$url." ".$e->getMessage();
        }
    }

    /**
     *
     * Generate a human readable file size
     * @param $bytes
     * @param int $decimals
     * @return string
     */
    function human_filesize($bytes, $decimals = 1)
    {
        if ($bytes < 1024) {
            return $bytes . ' B';
        }

        $factor = floor(log($bytes, 1024));
        return sprintf("%.{$decimals}f ", $bytes / pow(1024, $factor)) . ['B', 'KB', 'MB', 'GB', 'TB', 'PB'][$factor];
    }

    public function json_decode($string)
    {
        return json_decode($string, true);
    }

    /**
     *
     * Change markdown text to HTML
     * @param $text
     * @return string
     */
    public function markdownToHTMLFilter($text) {
        $parsedown = new \Parsedown();
        return $parsedown->text($text);
    }

    /**
     * @param $text
     *
     * @return string Iframe with external content
     */
    public function getExternalContentInIframe($text) {
        return '<iframe id="powerbi_dashboard" width="800" height="600" src="'.$text.'" frameborder="0" allowFullScreen="true"></iframe>';
    }

    /**
     * Convert a CSV string to an HTML table assumes the first row is the header row
     *
     * @param $text The CSV string with a header row
     *
     * @return string The HTML code for the table
     */
    public function convertCSVStringToHTMLTable($text) {
        $html = '';
        $csv = new Csv($text);

        $html.= '<table class="table no-datatable table-responsive">';
        $html.= "<thead>";
        $html.= "<tr>";

        foreach ($csv->titles as $value) {
            $html.= "<th>".$value."</th>";
        }

        $html.="</tr>";
        $html.="</thead>";
        $html.="<tbody>";

        foreach ($csv->data as $key => $row) {
            if ($key == 0) {
                # do nothing
            } else {
                $html.= "<tr>";

                foreach ($row as $value) {
                    $html.= "<td>".$value."</td>";
                }
                $html.="</tr>";
            }

        }
        $html.= "</tbody>";

        $html.= '</table>';

        return $html;

    }

    public function convertBooleanValueToYesNo($text) {
        if ($text) {
            return "Yes";
        } else {
            return "No";
        }
    }

}
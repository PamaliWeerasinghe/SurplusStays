<?php
class Sorter {
    private static $instance = null;
    private $currentSort;
    private $currentOrder;
    private $baseUrl;

    private function __construct() {
        $this->currentSort = isset($_GET['sort']) ? $_GET['sort'] : "";
        $this->currentOrder = isset($_GET['order']) ? $_GET['order'] : "ASC";
        $this->baseUrl = $this->generateBaseUrl();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function generateBaseUrl() {
        $url = $_SERVER['REQUEST_URI'];
        $parsedUrl = parse_url($url);
        $queryParams = [];

        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
        }

        unset($queryParams['sort']);
        unset($queryParams['order']);

        $base = $parsedUrl['path'];
        $queryString = http_build_query($queryParams);

        return $base . ($queryString ? "?$queryString" : "");
    }

    public function renderSorter($columns) {
        $html = '<div class="order"><div>';
        // Add onchange handler that saves scroll position
        $html .= '<select class="filter" onchange="saveScrollAndSort(this)">';
        $html .= '<option value="">Sort By</option>';
    
        foreach ($columns as $key => $label) {
            // ASC Option
            $ascUrl = $this->baseUrl . (str_contains($this->baseUrl, '?') ? '&' : '?') . "sort=$key&order=ASC";
            $selectedAsc = ($this->currentSort === $key && $this->currentOrder === "ASC") ? "selected" : "";
            $html .= "<option value='$ascUrl' $selectedAsc>$label ASC</option>";
    
            // DESC Option
            $descUrl = $this->baseUrl . (str_contains($this->baseUrl, '?') ? '&' : '?') . "sort=$key&order=DESC";
            $selectedDesc = ($this->currentSort === $key && $this->currentOrder === "DESC") ? "selected" : "";
            $html .= "<option value='$descUrl' $selectedDesc>$label DESC</option>";
        }
    
        $html .= '</select></div></div>';
        return $html;
    }
}

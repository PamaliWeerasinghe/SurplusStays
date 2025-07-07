<?php 
class Pager{
    public $links=array();
    public $offset=0;
    public $page_num=1;
    public $start=1;
    public $end=1;

    
    private static $instance=[];

    private function __construct($key,$noOfPages,$limit,$extras=1)
    {
        
        // $query_params=$_GET;
        $page_num=isset($_GET[$key.'_page'])? (int) $_GET[$key.'_page']:1;
        $page_num=max(1,$page_num);
       
        $this->end=$noOfPages;
        $this->page_num=$page_num-1;
        $this->offset=($page_num-1)*$limit;
        
        $current_link= ROOT."/".str_replace("url=","",$_SERVER['QUERY_STRING']);
        // unset($query_params[$key.'_page']);
        $current_link=!strstr($current_link,"{$key}_page=") ? $current_link."&{$key}_page=1":$current_link;
        
        // Add scroll preservation to all links
    // $scroll_js = "onclick=\"localStorage.setItem('pagerScrollPos', window.scrollY);\"";
        
        ($page_num-1 <=0 )?
        $first_link= preg_replace("/{$key}_page=[0-9]+/","{$key}_page=1",$current_link):
        $first_link= preg_replace("/{$key}_page=[0-9]+/","{$key}_page=".($page_num-1),$current_link);

        ($page_num+1>$this->end )?
        $next_link= preg_replace("/{$key}_page=[0-9]+/","{$key}_page=".($page_num),$current_link):
        $next_link= preg_replace("/{$key}_page=[0-9]+/","{$key}_page=".($page_num+1),$current_link);
       
       
        $this->links['prev']=$first_link;
        $this->links['current']=$current_link;
        $this->links['next']=$next_link;

  
    }

    public static function getInstance($key,$noOfPages,$limit,$extras=1){
        if(!isset(self::$instance[$key])){
            self::$instance[$key]=new Pager($key,$noOfPages,$limit,$extras=1);
        }
        return self::$instance[$key];
    }
    
    public function display()
    {
        ?>
        <style>
            .pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 12px;
    margin: 2rem 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    
}

.pagination-button {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background-color: #f5f5f5;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.pagination-button:hover {
    background-color: #e0e0e0;
    transform: scale(1.05);
}

.pagination-button.active {
    background-color: #289043;
    color: white;
}

.pagination-button a {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    text-decoration: none;
    color: inherit;
}

.pagination-button img {
    width: 24px;
    height: 24px;
    transition: transform 0.3s ease;
}

.pagination-button:hover img {
    transform: scale(1.1);
}

.pagination-number {
    min-width: 40px;
    padding: 0 5px;
    text-align: center;
    color: #555;
    font-weight: 500;
}

.pagination-arrow {
    background-color: transparent;
    border: 2px solid #289043;
}

.pagination-arrow:hover {
    background-color: #289043;
}

.pagination-arrow:hover img {
    filter: brightness(0) invert(1);
}
        </style>
        <div class="pagination">
    <button class="pagination-button pagination-arrow">
        <a href="<?=$this->links['prev']?>">
            <img src="<?=ASSETS?>/images/Arrow right-circle.png" alt="Previous"/>
        </a>
    </button>
    
    
    
    <button class="pagination-button pagination-arrow">
        <a href="<?=$this->links['next']?>">
            <img src="<?=ASSETS?>/images/Arrow right-circle-bold.png" alt="Next"/>
        </a>
    </button>
</div>
        <?php
    }
}




?>
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
        <div style="display:flex;flex-direction:row;justify-content:center;gap: 8px;">
           
                    <button 
                    style="border-radius: 100%;border:none;"
                    >
                        <a href="<?=$this->links['prev']?>" style="text-decoration:none">
                            <img src="<?=ASSETS?>/images/Arrow right-circle.png" id="prevBtn"/>
                        </a>
                    </button>
                    
                    <!-- <?php for($x=$this->start;$x<=$this->end;$x++):?>
                        <button style="width: 3%;"><a href="<?=$this->links['current']?>"style="text-decoration:none"><?=$x?></a></button>
                    <?php endfor; ?> -->

                    <button 
                    style="border-radius: 100%;border:none;"
                    >
                        <a href="<?=$this->links['next']?>" style="text-decoration:none">
                        <img src="<?=ASSETS?>/images/Arrow right-circle-bold.png" id="nextBtn"/>
                        </a>
                    </button>
                   
             
        </div>
        <?php
    }
}




?>
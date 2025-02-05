<?php 
class Pager{
    public $links=array();
    public $offset=0;
    public $page_num=1;
    public $start=1;
    public $end=1;

    public function __construct($noOfPages,$limit=10,$extras=1,)
    {
        
        $page_num=isset($_GET['page'])? (int) $_GET['page']:1;
        $page_num=$page_num < 1 ? 1 : $page_num;
        
        $this->end=$noOfPages;
        $this->page_num=$page_num;
        $this->offset=($page_num-1)*$limit;

        $current_link= ROOT."/".str_replace("url=","",$_SERVER['QUERY_STRING']);
        $current_link=!strstr($current_link,"page=") ? $current_link."&page=1":$current_link;
        $first_link= preg_replace('/page=[0-9]+/',"page=".($page_num-1),$current_link);
        $next_link= preg_replace('/page=[0-9]+/',"page=".($page_num+1),$current_link);
       
        $this->links['prev']=$first_link;
        $this->links['current']=$current_link;
        $this->links['next']=$next_link;

  
    }
    
    public function display()
    {
        ?>
        <div>
            <nav>
                <ul>
                    <li><a href="<?=$this->links['prev']?>">Previous</a></li>
                    
                    <?php for($x=$this->start;$x<=$this->end;$x++):?>
                    <li><a href="<?=$this->links['current']?>"><?=$x?></a></li>
                    <?php endfor; ?>

                    <li><a href="<?=$this->links['next']?>">Next</a></li>
                   
                </ul>
            </nav>
        </div>
        <?php
    }
}




?>
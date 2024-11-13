<?php
class Business extends Controller
{

    function index()
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $this->view('businessWelcomePage');
    }

    function dashboard()
    {
        $this->view('businessWelcomePage');
    }

    function myproducts()
    {
        
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $product = new Products();
        $business_id = Auth::getUserId();
        $data = $product->where('business_id', $business_id);
        $currentDateTime = date('Y-m-d H:i:s');
        if (!empty($data)) {
            foreach ($data as $row) {
                if ($currentDateTime > $row->expiration_date_time) {
                    $product->delete($row->id);
                }
            }
        }
        $data = $product->where('business_id', $business_id);
        $this->view('businessMyProducts', ['rows' => $data]);
    }

    function orders()
    {
        $this->view('businessOrders');
    }

    function requests()
    {
        $this->view('businessRequests');
    }

    function complains()
    {
        $this->view('businessComplains');
    }
    function reports()
    {
        $this->view('businessReport');
    }
    function profile()
    {
        $this->view('businessProfile');
    }
    function addproduct()
    {
        
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        $errors = array();
        if(count($_POST)>0)
        {
            $product = new Products();
            if ($product->validate($_POST)) 
            {
                
                $arr['business_id'] = Auth::getUserId();
                $arr['name'] = $_POST['product-name'];
                $arr['category'] = $_POST['category'];
                $arr['description'] = $_POST['description'];
                $arr['qty'] = $_POST['quantity'];                
                $arr['price_per_unit'] = $_POST['price-per-unit'];
                $arr['expiration_date_time'] = $_POST['expiration'];
                $arr['discount_price'] = $_POST['discount'];
                $product->insert($arr);
                $this->redirect('business/myproducts');  
            }else
            {
                $errors = $product->errors;
            }
        }
        $this->view('businessAddProduct',[
            'errors' => $errors
        ]);
    }

    function editproduct($id=null)
    {
        
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $product = new Products();
        $errors = array();
        if(count($_POST)>0)
        {
           
            if ($product->validate($_POST)) 
            {
                
                
                $product->update($id,$_POST);
                $this->redirect('business/myproducts');  
            }else
            {
                $errors = $product->errors;
            }
        }
        $row=$product->where('id',$id);
        $row = $row ? $row[0] : null;
        
        $this->view('businessEditProduct',[
            'row'=>$row,
            'errors' => $errors
        ]);
    }

    function deleteproduct($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product = new Products(); // Ensure you have an Event model
            if ($product->delete($id)) {
                // Optionally, set a success message
                $_SESSION['message'] = 'Event deleted successfully';
            } else {
                // Optionally, set an error message
                $_SESSION['message'] = 'Failed to delete event';
            }
    
            $this->redirect('business/myproducts'); // Redirect back to the manage events page
        }
    }
    

    function test($name)
    {
        $data = [
            "username" => $name
        ];
        $this->view('aboutView', $data);
    }
}

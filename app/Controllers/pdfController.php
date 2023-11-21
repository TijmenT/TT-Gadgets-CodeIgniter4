<?php 
namespace App\Controllers;
use App\Models\ProductModel;
use CodeIgniter\Controller;

class PdfController extends Controller
{
    public function index() 
	{
        $db = \Config\Database::connect();
        $productModel = new ProductModel();
    
        $categories = $db->query('SELECT * FROM categories');
        $data['categories'] = $categories->getResultArray();
		$data['products'] = $productModel->findAll();
        return view('pdf_view', $data);
    }
    public function htmlToPDF(){
        $db = \Config\Database::connect();
        $productModel = new \App\Models\ProductModel(); // make sure to use the correct namespace
    
        $categories = $db->query('SELECT * FROM categories')->getResultArray();
        $products = $productModel->findAll();
    
        $data = [
            'categories' => $categories,
            'products' => $products,
        ];
    
        $dompdf = new \Dompdf\Dompdf(); 
        // Load the view and pass the data array to it
        $dompdf->loadHtml(view('pdf_view', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("products.pdf", array("Attachment" => true)); // Use "Attachment" => false to preview in browser
    }
    
}
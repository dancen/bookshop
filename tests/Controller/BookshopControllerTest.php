<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Factory\AppFixturesFactory;

class BookshopControllerTest extends WebTestCase
{
    
    private $client;
    
    protected function setUp() {
        $this->client = static::createClient();
        $container = $this->client->getContainer();
        $doctrine = $container->get('doctrine');
        $entityManager = $doctrine->getManager();
        $fixture = AppFixturesFactory::create();
        $fixture->load($entityManager);
    }
    
    
    public function testFilterByAuthor1() {
        
        $params = array(
            "author" => "Robin Nixon"
        );
        $client = $this->client;
        $client->request('POST', '/api/1.0/books/author/get', $params, array(), array("Content-type" => "application/json"));
        $response = $client->getResponse();
        $content_array = json_decode($response->getContent());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals(2, count($content_array));
        $this->assertRegexp('/978-1491918661/', $response->getContent());
        $this->assertRegexp('/978-0596804848/', $response->getContent());
    }
    
    
    
     public function testFilterByAuthor2() {
         
        $param = array(
            "author" => "Christopher Negus"
        );
        $client = $this->client;
        $client->request('POST', '/api/1.0/books/author/get', $param, array(), array("Content-type" => "application/json"));
        $response = $client->getResponse();
        $content_array = json_decode($response->getContent());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals(1, count($content_array));
        $this->assertRegexp('/978-1118999875/', $response->getContent());
    }
    
    
    
    
    public function testListOfCategories() {
        
        $param = array();
        $client = $this->client;
        $client->request('POST', '/api/1.0/categories/get', $param, array(), array("Content-type" => "application/json"));
        $response = $client->getResponse();
        $content_array = json_decode($response->getContent());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals(3, count($content_array));
        $this->assertRegexp('/PHP/', $response->getContent());
        $this->assertRegexp('/Javascript/', $response->getContent());
        $this->assertRegexp('/Linux/', $response->getContent());
    }
    
    
    
    
    public function testFilterByCategory1() {
        
        $param = array(
            "category_name" => "Linux"
        );
        $client = $this->client;
        $client->request('POST', '/api/1.0/books/category/get', $param, array(), array("Content-type" => "application/json"));
         $response = $client->getResponse();
        $content_array = json_decode($response->getContent());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals(2, count($content_array));
        $this->assertRegexp('/978-0596804848/', $response->getContent());
        $this->assertRegexp('/978-1118999875/', $response->getContent());
    }
    
    
    
    
    public function testFilterByCategory2() {
        
        $param = array(
            "category_name" => "PHP"
        );
        $client = $this->client;
        $client->request('POST', '/api/1.0/books/category/get', $param, array(), array("Content-type" => "application/json"));
         $response = $client->getResponse();
        $content_array = json_decode($response->getContent());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals(1, count($content_array));
        $this->assertRegexp('/978-1491918661/', $response->getContent());
    }
    
    
   
    
    public function testFilterByAuthor3() {
        
        $param = array(
            "author" => "Robin Nixon",
            "category_name" => "Linux"
        );
        $client = $this->client;
        $client->request('POST', '/api/1.0/books/author/category/get', $param, array(), array("Content-type" => "application/json"));
        $response = $client->getResponse();
        $content_array = json_decode($response->getContent());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals(1, count($content_array));
        $this->assertRegexp('/978-0596804848/', $response->getContent());
    }
    
    
    
     
    
    public function testCreateBook1() {
        
        $param = array(
            "isbn" => "978-1491905012",
            "title" => "Modern PHP: New Features and Good Practices",
            "author" => "Josh Lockhart",
            "category_name" => "PHP",
            "price" => "18.99"
        );
        $client = $this->client;
        $client->request('POST', '/api/1.0/book/create', $param, array(), array("Content-type" => "application/json"));
        $response = $client->getResponse();
        $this->assertSame(201, $response->getStatusCode());
        $this->assertRegexp('/978-1491905012/', $response->getContent());
        $this->assertRegexp('/Modern PHP: New Features and Good Practices/', $response->getContent());
        $this->assertRegexp('/Josh Lockhart/', $response->getContent());
        $this->assertRegexp('/PHP/', $response->getContent());
        $this->assertRegexp('/18.99/', $response->getContent());
    }
    
  
    
    public function testCreateBook2() {
        
        $param = array(
            "isbn" => "978-INVALID-ISBN-1491905012",
            "title" => "Modern PHP: New Features and Good Practices",
            "author" => "Josh Lockhart",
            "category_name" => "PHP",
            "price" => "18.99"
        );
        $client = $this->client;
        $client->request('POST', '/api/1.0/book/create', $param, array(), array("Content-type" => "application/json"));
        $response = $client->getResponse();
        $this->assertSame(400, $response->getStatusCode());
        $this->assertRegexp('/Invalid ISBN/', $response->getContent());        
    }
    
    
    
}
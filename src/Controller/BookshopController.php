<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Model\AppInterface;
use App\Manager\BookshopManager;
use App\Validator\GetBooksByAuthorValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Validator\GetCategoriesValidator;
use App\Validator\GetBooksByCategoryValidator;
use App\Validator\CreateBookValidator;
use App\Validator\GetBooksByAuthorAndCategoryValidator;

class BookshopController extends AbstractController implements AppInterface {

    /**
     * Lists Books by Author.
     *
     * @return json
     */
    public function getBooksByAuthor(Request $request, BookshopManager $manager, GetBooksByAuthorValidator $actionvalidator, ValidatorInterface $validator) {

        
        $req = $this->getRequestBag($request);
        $params_data = [AppInterface::AUTHOR => $req->get('author')];

        // validate payload
        $actionvalidator->setValidator($validator);
        $validated = $actionvalidator->validate($params_data);
        $errors = $validated->getErrors();

        
        if (count($errors) > 0) {

            $response = new JsonResponse(array("error" => $errors));
            $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            return $response;
        } else {

            $response = $manager->getBooksByAuthor($params_data);

            if ($response) {
                $response = new JsonResponse($response);
                $response->setStatusCode(JsonResponse::HTTP_OK);
                return $response;
            } else {
                $response = new JsonResponse(array("error" => array("code" => "error_no_book_found", "message" => "no book found with this author")));
                $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
                return $response;
            }
        }
    }

    /**
     * Lists Books by category.
     *
     * @return json
     */
    public function getBooksByCategory(Request $request, BookshopManager $manager, GetBooksByCategoryValidator $actionvalidator, ValidatorInterface $validator) {


        
        $req = $this->getRequestBag($request);
        $params_data = [AppInterface::CATEGORY_NAME => $req->get('category_name')];

        // validate payload
        $actionvalidator->setValidator($validator);
        $validated = $actionvalidator->validate($params_data);
        $errors = $validated->getErrors();
        
        if (count($errors) > 0) {

            $response = new JsonResponse(array("error" => $errors));
            $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            return $response;
        } else {

            $response = $manager->getBooksByCategory($params_data);

            if ($response) {

                $response = new JsonResponse($response);
                $response->setStatusCode(JsonResponse::HTTP_OK);
                return $response;
            } else {
                $response = new JsonResponse(array("error" => array("code" => "error_no_book_found", "message" => "no book found in this category")));
                $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
                return $response;
            }
        }
    }

    /**
     * Lists Books by Author.
     *
     * @return json
     */
    public function getBooksByAuthorAndCategory(Request $request, BookshopManager $manager, GetBooksByAuthorAndCategoryValidator $actionvalidator, ValidatorInterface $validator) {

        
        $req = $this->getRequestBag($request);
        $params_data = [AppInterface::AUTHOR => $req->get('author'),
            AppInterface::CATEGORY_NAME => $req->get('category_name')];

        // validate payload
        $actionvalidator->setValidator($validator);
        $validated = $actionvalidator->validate($params_data);
        $errors = $validated->getErrors();
       
        if (count($errors) > 0) {

            $response = new JsonResponse(array("error" => $errors));
            $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            return $response;
        } else {

            $response = $manager->getBooksByAuthorAndCategory($params_data);

            if ($response) {

                $response = new JsonResponse($response);
                $response->setStatusCode(JsonResponse::HTTP_OK);
                return $response;
            } else {

                $response = new JsonResponse(array("error" => array("code" => "error_no_book_found", "message" => "no book found with this author in this category")));
                $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
                return $response;
            }
        }
    }

    /**
     * create a new Book.
     *
     * @return json
     */
    public function createBook(Request $request, BookshopManager $manager, CreateBookValidator $actionvalidator, ValidatorInterface $validator) {


        
        $req = $this->getRequestBag($request);
        $params_data = [AppInterface::CATEGORY_NAME => $req->get('category_name'),
            AppInterface::ISBN => $req->get('isbn'),
            AppInterface::TITLE => $req->get('title'),
            AppInterface::AUTHOR => $req->get('author'),
            AppInterface::PRICE => $req->get('price')];

        // validate payload
        $actionvalidator->setValidator($validator);
        $validated = $actionvalidator->validate($params_data);
        $errors = $validated->getErrors();

       
        if (count($errors) > 0) {

            $response = new JsonResponse(array("error" => $errors));
            $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            return $response;
        } else {


            $response = $manager->createBook($params_data);

            if ($response) {

                $response = new JsonResponse($response);
                $response->setStatusCode(JsonResponse::HTTP_CREATED);
                return $response;
            } else {
                $response = new JsonResponse(array("error" => array("code" => "error_no_book_created", "message" => "no book has been created")));
                $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
                return $response;
            }
        }
    }

    /**
     * getCategories
     *
     * @return json
     */
    public function getCategories(Request $request, BookshopManager $manager, GetCategoriesValidator $actionvalidator, ValidatorInterface $validator) {

        
        $req = $this->getRequestBag($request);
        $params_data = [];

        // validate payload
        $actionvalidator->setValidator($validator);
        $validated = $actionvalidator->validate($params_data);
        $errors = $validated->getErrors();

        if (count($errors) > 0) {

            $response = new JsonResponse(array("error" => $errors));
            $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            return $response;
        } else {


            $response = $manager->getCategories($params_data);

            if ($response) {

                $response = new JsonResponse($response);
                $response->setStatusCode(JsonResponse::HTTP_OK);
                return $response;
            } else {
                $response = new JsonResponse(array("error" => array("code" => "error_no_category_found", "message" => "no category found")));
                $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
                return $response;
            }
        }
    }

    private function getRequestBag(Request $request) {
        if (strlen($request->getContent()) == 0) {
            return $request->request;
        } else {
            $data = json_decode($request->getContent(), true);
            $request->request->replace(is_array($data) ? $data : array());
            return $request;
        }
    }

}

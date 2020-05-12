<?php

class HomeController {
    public function contact(IRequest $request, Router $router) {
        return $router->render_template('contact',[
            'errors' => [],
            'data' => []
        ], true);
    }
    public function postContact(IRequest $request, Router $router) {
        $data = $request->getBody();
        $email = $data['email'];
        $errors = [];
        if (!$email){
            $errors['email'] = 'გთხოვთ შეავსოთ ველი';
        }

        return $router->render_template('contact',['errors' => $errors,'data' => $data], true);
    }
}
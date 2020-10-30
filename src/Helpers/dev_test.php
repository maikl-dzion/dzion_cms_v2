<?php


//$eValidate = $container->get('email-validate');
//$email = 'dzion67@mail.ru';
//$r = $eValidate->validate($email);
//print_r($r); die;

//$route = $router->init();
//print_r([$router, $route]);

print_r($db);


$movTest = array(

    "rear" => array(
        "title" => "Rear Window",
        "director" => "Alfred Hitchcock",
        "year" => 1954
    ),

    'jacket' => array(
        "title" => "Full Metal Jacket",
        "director" => "Stanley Kubrick",
        "year" => 1987,
        'f1' =>  array(
                "title" => "f1",
                "director" => "Stanley Kubrick",
                "year" => 1987
        ),
    ),

    'mean' => array(
        "title" => "Mean Streets",
        "director" => "Martin Scorsese",
        "year" => 1973,

        'f22' =>  array(
            "title" => "f2",
            "director" => "Stanley Kubrick",
            "year" => 1987,
            'f33' => array(
                "title" => "f33",
                "director" => "Stanley Kubrick",
                "year" => 1987
            ),
        ),
    ),
);

$request->postData = (array)json_decode(json_encode($movTest));
$reg1 = $request->postSlice('f22', $request->postData);
//lg([$reg1]);
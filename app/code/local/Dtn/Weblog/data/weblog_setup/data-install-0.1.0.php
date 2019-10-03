<?php
$registryType = array(
    array(
        'title'=>'code post1',
        'post'=>'This is a blog post1',
        'data'=>'2010-07-02',
        'timestamp'=>'2010-07-02 23:12:30'
    ),
    array(
        'title'=>'code post2',
        'post'=>'This is a blog post2',
        'data'=>'2010-07-03',
        'timestamp'=>'2010-07-02 23:12:31'
    ),
    array(
        'title'=>'code post13',
        'post'=>'This is a blog post3',
        'data'=>'2010-07-04',
        'timestamp'=>'2010-07-02 23:12:32'
    )
);

foreach ($registryType as $data){
    Mage::getModel('weblog/blogpost')
        ->setData($data)
        ->save();
}
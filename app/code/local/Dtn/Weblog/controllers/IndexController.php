<?php
class Dtn_Weblog_IndexController extends Mage_Core_Controller_Front_Action{
    /**
     * create method testModel để get data ra
     */
    public function testModelAction(){
//        $blogpost = Mage::getModel('weblog/blogpost');
//        echo get_class($blogpost);
        $param = $this->getRequest()->getParams();
        $blogpost = Mage::getModel('weblog/blogpost');
        //url......../index/id/params
        echo ("loading the blogpost with an ID of ".$param['id']);
        $blogpost->load($param['id']);
        $data = $blogpost->getData();
        var_dump($data);
    }

    /**
     * @throws Exception
     * create a post add input database
     */
    public function createNewPostAction(){
        $blogpost = Mage::getModel('weblog/blogpost');//Triệu gọi model chính là file blogpost.php
        $blogpost->setTitle('Code Post2!');
        $blogpost->setPost('This post was created from code2!');
        $blogpost->save();
        echo 'post with ID ' . $blogpost->getId() . ' created';

    }

    /**
     * @throws Exception
     * edit post
     */
    public function editPostAction(){
        $blogpost = Mage::getModel('weblog/blogpost');
        $blogpost->load(1);
        $blogpost->setTitle('The First Post!!!');
        $blogpost->save();
        echo 'post edited sussesfully';
    }

    /**
     * @throws Exception
     * delete post
     */
    public function deletePostAction(){
        $blogpost = Mage::getModel('weblog/blogpost');
        $blogpost->load(4);
        $blogpost->delete();
        $blogpost->save();
        $name = $blogpost->getTitle();
        echo "delete " .$name." sussesfuly";
    }

    /**
     * show all use collection
     */
    public function showAllBlogPostsAction() {
        $posts = Mage::getModel('weblog/blogpost')->getCollection();
        foreach($posts as $blogposttt){
            echo '<h3>'.$blogposttt->getTitle().'</h3>';
            echo nl2br($blogposttt->getPost());
        }
    }

}
<?php
class Dtn_Weblog_Block_Adminhtml_Blogpost_Grid extends Mage_Adminhtml_Block_Widget_Grid{
    /**
     * Dtn_Weblog_Block_Adminhtml_Blogpost_Grid constructor.
     */
    public function __construct()
    {

        parent::__construct();
        $this->setId('blogpostGrid');// là id của bảng nếu nhiều grid thì nó là duy nhất
        $this->setDefaultSort('id');//thứ tự tăng dần giảm dần ở cột nào
        $this->setDefaultDir('ASC');// tăng dần hay giảm dần
        $this->setSaveParametersInSession(true);// cái này là cái gì đếch biết
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('weblog/blogpost')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection(); // TODO: Change the autogenerated stub
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     * @throws Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn('blogpost_id',array(
            'header'=>Mage::helper('weblog')->__('Blogpost_ID'),
            'align'=>'right',
            'width'=>'10px',
            'index'=>'blogpost_id'
        ));
        $this->addColumn('title',array(
            'header'=>Mage::helper('weblog')->__('Title'),
            'align'=>'right',
            'width'=>'10px',
            'index'=>'title'
        ));
        $this->addColumn('post',array(
            'header'=>Mage::helper('weblog')->__('Post'),
            'align'=>'right',
            'width'=>'10px',
            'index'=>'post'
        ));
        /**
         * drop down in grid
         */
        $this->addColumn('dropdown1',
            array(
                'header'    => Mage::helper('weblog')->__('Blogpost Type'),
                'align'     =>'left',
                'width'     => '10px',
                'index'     => 'type',
                'type'      => 'options',
                'options'    => array('1' => 'Normal','2' => 'Admin' , '3' => 'Guest')
            )
        );
        $this->addColumn('data',array(
            'header'=>Mage::helper('weblog')->__('Data'),
            'align'=>'right',
            'width'=>'10px',
            'index'=>'data'
        ));
        $this->addColumn('timestamp',array(
            'header'=>Mage::helper('weblog')->__('Timestamp'),
            'align'=>'right',
            'width'=>'10px',
            'index'=>'timestamp'
        ));
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('weblog')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('weblog')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),//link url ở hàm cuối cùng
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
            ));
        /**
         * export grid sang CSV goij sang controller
         */
        $this->addExportType('*/*/exportCsv',Mage::helper('weblog')->__('CSV'));//export phair xu ly trong controller
        $this->addExportType('*/*/exportXml',Mage::helper('weblog')->__('XML'));


        return parent::_prepareColumns(); // TODO: Change the autogenerated stub
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     * create nut action co the chon xoa hay the nao cung duoc
     */
    protected function _prepareMassaction()
    {
//        return parent::_prepareMassaction(); // TODO: Change the autogenerated stub
        $this->setMassactionIdField('blogpost_id');
        $this->getMassactionBlock()->setFormFieldName('blogpost');

        $this->getMassactionBlock()->addItem('delete',array(
            'label' => Mage::helper('weblog')->__('Delete'),
            'url'      => $this->getUrl('*/*/delete'),//trỏ đến hàm deleteAction trong controller
            'confirm'  => Mage::helper('weblog')->__('Are you sure?')
        ));

        return $this;
    }

    /**
     * @param $item
     * @return string
     * Khi click vào bất kỳ hàng nào cụ thể nó sẽ chỉ định đến hàng đó và lấy ID trên url
     */
    public function getRowUrl($row)
    {
//        return parent::getRowUrl($item); // TODO: Change the autogenerated stub
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));// router chính là tạo ra 1 file edit cùng cấp với file grid này
    }
}
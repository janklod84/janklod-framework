<?php 
namespace JK\Template;


/**
 * @package JK\Template\ViewAdapter 
*/ 
class ViewAdapter 
{
      
    /**
     * @var \JK\Template\ViewInterface
    */
    private $view;


    /**
     * Constructor
     * @param \JK\Template\ViewInterface $view 
     * @return void
    */
	  public function __construct(ViewInterface $view)
	  {
           $this->view = $view;
	  }

    
    /**
     * Render view
     * @param \JK\Template\ViewInterface $view 
     * @return 
    */
	  public function render()
	  {
        return $this->view->output();
	  }
}
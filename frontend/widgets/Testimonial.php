<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Testimonials;
use common\models\Menu;

/**
 * Alert widget renders a message from session flash. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * ```php
 * \Yii::$app->getSession()->setFlash('error', 'This is the message');
 * \Yii::$app->getSession()->setFlash('success', 'This is the message');
 * \Yii::$app->getSession()->setFlash('info', 'This is the message');
 * ```
 *
 * Multiple messages could be set as follows:
 *
 * ```php
 * \Yii::$app->getSession()->setFlash('error', ['Error 1', 'Error 2']);
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @author Alexander Makarov <sam@rmcreative.ru>
 */
class Testimonial extends Widget
{
	
		public $testimonials; 
	
		public $count; 
	
	
	 public function init(){

        parent::init();
		$testimonialmodel=new Testimonials();
		$this->testimonials = $testimonialmodel->find()
						  ->where(['is_featured'=>1 , 'status'=>1])
						  ->orderBy(['sort_order'=>'DESC', 'id'=>'DESC'])
						  ->asArray()
						  ->all();
		
		$this->count = $testimonialmodel->find()
						  ->where(['is_featured'=>1 , 'status'=>1])
						  ->orderBy(['sort_order'=>'DESC', 'id'=>'DESC'])
						  ->count();
	//	print_r($this->count); die;
		
	   }

	     

	    public function run(){
			$str = ' <!-- Testimonial section Start -->
  <section class="clearfix top-prp">
    <div class="container">
    <h2 class="title-txt">Testimonial</h2>
  <div class="row">
            <div>
                
                <div class="carousel slide top-prp2" data-ride="carousel" id="quote-carousel2">
                    <!-- Bottom Carousel Indicators -->
                    <ol class="carousel-indicators">';
                    for($i=0; $i< $this->count; $i++)
                    {
						$cls = '';
						if($i == 0)
						{
								$cls = 'active'; 
						}
						$str .= '<li data-target="#quote-carousel2" data-slide-to="'.$i.'" class="'.$cls.'"></li>'; 
					}
                    
                    
                    
                       
                  $str.='</ol>
                    

                    <!-- Carousel Slides / Quotes -->
                    <div class="carousel-inner testi-txt">';
                    $i=0;
                       foreach($this->testimonials as $k=>$testimonial)
							{
								$cls = '';
								if($i == 0)
								{
										$cls = 'active'; 
								}
								$str .= '<!-- Quote '.($i+1).' -->
								
                        <div class="item '.$cls.' container">
                           <div class="row top-prp">
                              <div class="col-lg-12">
                                       
                                        <p>“'.$testimonial["testimonials"].'”</p>
                                       
                                    </div>
                                    <div class="row-centered">
                                    <div class="col-lg-6 col-centered">
                                       <div  class="col-lg-2 col-centered">
                                          <img class="img-circle" src="'.Yii::$app->getUrlManager()->createUrl("uploads/".$testimonial["profile_image"]).'" style="width: 70px; height: 70px;">
                                       </div>
                                       <div class="col-lg-4 col-centered testi-name">
                                       '.$testimonial["author"].'
                                       <span>'.$testimonial["tagline"].'</span>
                                       </div>
                                    </div>
                                    </div>
                                </div>
                          
                            <br><br><br>
                        </div>';
								$i++;
							}
                
                     
                  $str .= '  </div>

                </div>
            </div>
        </div>
         
  </div>
  </section>
  <!-- Testimonial section Ends -->';


	        return $str;

	    }
	    
	    }

<?php
namespace app\widgets;

use Yii;


class Wowslider extends \yii\bootstrap\Widget
{


    /**
     * {@inheritdoc}
     */
    public function run()
    {

    $baner[] = ['id' => 1,
                'url' => '/event/1',
                'naim' => 'Все на лыжи',
                'sid_cat' => 0,
        ];

    $baner[] = ['id' => 2,
                'url' => '/event/2',
                'naim' => 'Веселые старты',
                'sid_cat' => 0,
    ];

    $baner[] = ['id' => 3,
                'url' => '/event/3',
                'naim' => 'IT конференция',
                'sid_cat' => 0,
    ];


$bb = 'var banerss= [';
foreach($baner as $bn){


		$bb .= '"/images/baner/baner_'.$bn['id'].'.jpg",';

}
$bb .= '];';



echo '<script>';

echo $bb;


echo '</script>';


?>



        <!-- Start WOWSlider.com HEAD section -->
        <link rel="stylesheet" type="text/css" href="/css/wowslider/style.css" />
        <!-- End WOWSlider.com HEAD section -->


        <!-- Start WOWSlider.com BODY section -->
        <div id="wowslider-container1">
            <div class="ws_images"><ul>
                    <?php
                    $iw = 0;
                    foreach($baner as $bn){

                        if($bn['sid_cat']==0){
                            $fil = '/images/baner/baner_'.$bn['id'].'.jpg';
                            echo '<li><a href="'.$bn['url'].'"><img src="'.$fil.'" alt="'.$bn['naim'].'" title="'.$bn['naim'].'" id="wows1_'.$iw.'"/></a></li>'."\n";
                            $iw++;
                        }
                    }
                    ?>


                </ul></div>
            <div class="ws_bullets"><div>
                    <?php
                    $iw = 0;
                    foreach($baner as $bn){

                        if($bn['sid_cat']==0){
                            $fil = '/images/baner/tooltips/baner_'.$bn['id'].'.jpg';
                            echo '<a href="#" title="'.$bn['naim'].'"><span><img src="'.$fil.'" alt="'.$bn['naim'].'"></span></a>'."\n";
                            $iw++;
                        }
                    }
                    ?>


                </div></div>
            <div class="ws_shadow"></div>
        </div wowslider-container1>




        <script type="text/javascript" src="/js/wowslider/wowslider.js"></script>
        <script type="text/javascript" src="/js/wowslider/script.js"></script>
        <!-- End WOWSlider.com BODY section -->

        <br>
<?php
    }
}
